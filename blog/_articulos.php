<?php
/**
 * =============================================================
 *  FlovaMedia — Lector de artículos del blog
 *  Ubicación: public_html/blog/_articulos.php
 * =============================================================
 *
 *  Lee cada archivo .php de esta carpeta y extrae su metadata.
 *
 *  Dos formatos soportados a la vez:
 *   1) Artículos nuevos: declaran un array $post al inicio y usan
 *      el componente /componentes/head-blog.php. La metadata se
 *      lee de ese array.
 *   2) Artículos antiguos: traen el <head> escrito a mano. La
 *      metadata se lee del HTML como siempre.
 *
 *  Puedes migrar los artículos de uno en uno sin romper el índice.
 *
 *  No hay que registrar nada a mano: publicas un artículo nuevo
 *  en /blog/ y aparece solo en el índice.
 *
 *  Requisito: que el artículo mantenga la estructura estándar
 *  (post-flova-hero, post-flova-eyebrow, post-flova-meta-texto)
 *  o bien declare el array $post. Si no cumple ninguna, se omite
 *  en silencio en vez de romper la página.
 * =============================================================
 */

// Evita que se acceda directo por URL
if (!defined('FLOVA_BLOG')) {
    http_response_code(404);
    exit;
}

/* -------------------------------------------------------------
   CONFIGURACIÓN
------------------------------------------------------------- */

// Artículos pilar: se muestran arriba en "Empieza aquí" y se
// excluyen de la lista principal. Para cambiarlos, edita esta lista.
$FLOVA_HUBS = [
    'que-es-facebook-ads-como-funciona',
    'que-es-google-ads-y-como-funciona',
    'que-es-el-seo-y-por-que-usarlo',
];

// Servicios de la agencia. Definen los filtros y su orden.
// Los que todavía no tienen artículos aparecen desactivados.
$FLOVA_SERVICIOS = [
    'Facebook Ads',
    'Google Ads',
    'SEO',
    'Páginas de Aterrizaje',
    'Embudos de Venta',
    'Diseño Web',
];

// Correcciones manuales (opcional). Si algún artículo queda mal
// clasificado, fuérzalo aquí sin tocar el archivo del artículo:
//   'slug-del-articulo' => ['pilar' => 'SEO', 'vertical' => 'Solar'],
$FLOVA_OVERRIDES = [];

// Imagen que se usa cuando un artículo no declara hero o el archivo
// de imagen no existe en el servidor.
define('FLOVA_IMG_RESPALDO', '/img/blog/que-es-google-ads.jpg');


/* -------------------------------------------------------------
   UTILIDADES
------------------------------------------------------------- */

function flova_meses()
{
    return [
        'enero' => 1, 'febrero' => 2, 'marzo' => 3, 'abril' => 4,
        'mayo' => 5, 'junio' => 6, 'julio' => 7, 'agosto' => 8,
        'septiembre' => 9, 'octubre' => 10, 'noviembre' => 11, 'diciembre' => 12,
    ];
}

function flova_meses_cortos()
{
    return [1 => 'ene', 'feb', 'mar', 'abr', 'may', 'jun',
                 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
}

/** "1 de septiembre, 2026" -> timestamp */
function flova_parsear_fecha($texto)
{
    if (!preg_match('/(\d{1,2})\s+de\s+([a-záéíóúñ]+)[,\s]+(\d{4})/iu', $texto, $m)) {
        return 0;
    }
    $meses = flova_meses();
    $mes = mb_strtolower($m[2], 'UTF-8');
    if (!isset($meses[$mes])) {
        return 0;
    }
    return mktime(0, 0, 0, $meses[$mes], (int) $m[1], (int) $m[3]);
}

/** timestamp -> "1 sep 2026" */
function flova_fecha_corta($ts)
{
    if (!$ts) {
        return '';
    }
    $cortos = flova_meses_cortos();
    return date('j', $ts) . ' ' . $cortos[(int) date('n', $ts)] . ' ' . date('Y', $ts);
}

/**
 * NUEVO — Lee el array $post que declaran los artículos migrados.
 *
 * No ejecuta el archivo: solo busca los pares 'clave' => 'valor'
 * dentro del bloque $post = [ ... ]; con una expresión regular.
 * Si el artículo no declara $post, devuelve un array vacío y el
 * escáner sigue leyendo el HTML como antes.
 */
function flova_leer_post_array($html)
{
    if (!preg_match('/\$post\s*=\s*\[(.*?)\n\s*\];/s', $html, $bloque)) {
        return [];
    }
    $cuerpo = $bloque[1];
    $datos  = [];

    $claves = ['slug', 'title', 'description', 'h1', 'imagen',
               'servicio', 'publicado', 'modificado', 'lectura'];

    foreach ($claves as $clave) {
        // Acepta comillas simples o dobles y escapes internos
        $patron = '/[\'"]' . $clave . '[\'"]\s*=>\s*'
                . '(?:\'((?:[^\'\\\\]|\\\\.)*)\'|"((?:[^"\\\\]|\\\\.)*)")/s';
        if (preg_match($patron, $cuerpo, $m)) {
            $valor = $m[1] !== '' ? $m[1] : ($m[2] ?? '');
            if ($valor === '' && isset($m[2])) {
                $valor = $m[2];
            }
            $datos[$clave] = trim(stripcslashes($valor));
        }
    }

    return $datos;
}

/**
 * Deduce el servicio (pilar) y el nicho a partir del eyebrow.
 * Soporta las dos formas que usan los artículos actuales:
 *   "Guía · Google Ads · Inmobiliarias"
 *   "Guía · Facebook Ads para Energía Solar"
 */
function flova_clasificar($eyebrow)
{
    $partes  = array_map('trim', preg_split('/\s*·\s*/u', $eyebrow));
    $formato = $partes[0] ?? 'Guía';
    $resto   = implode(' ', array_slice($partes, 1));

    // Servicio — el orden importa: lo más específico primero.
    $pilar = '';
    $mapa = [
        'Google Ads'           => ['google ads', 'adwords'],
        'Facebook Ads'         => ['facebook ads', 'meta ads', 'instagram'],
        'SEO'                  => ['seo', 'posicionamiento'],
        'Páginas de Aterrizaje'=> ['aterrizaje', 'landing'],
        'Embudos de Venta'     => ['embudo', 'funnel', 'cro'],
        'Diseño Web'           => ['diseño web', 'página web', 'sitio web'],
    ];
    $busca = mb_strtolower($resto, 'UTF-8');
    foreach ($mapa as $servicio => $claves) {
        foreach ($claves as $clave) {
            if (mb_strpos($busca, $clave) !== false) {
                $pilar = $servicio;
                break 2;
            }
        }
    }

    // Nicho — informativo, ya no se usa como filtro.
    $vertical = '';
    $nichos = [
        'Inmobiliarias' => ['inmobiliaria', 'desarrollo inmobiliario', 'bienes raíces'],
        'Energía Solar' => ['solar', 'fotovoltaic'],
        'Alto Ticket'   => ['alto ticket', 'high-ticket', 'high ticket'],
    ];
    foreach ($nichos as $nicho => $claves) {
        foreach ($claves as $clave) {
            if (mb_strpos($busca, $clave) !== false) {
                $vertical = $nicho;
                break 2;
            }
        }
    }

    return [$formato, $pilar, $vertical];
}


/* -------------------------------------------------------------
   ESCANEO
------------------------------------------------------------- */

/**
 * Capa de caché. Sin esto, cada visita al índice abriría los 23 archivos
 * (y los 133 que vienen). El caché se invalida solo cuando cambia la fecha
 * de modificación de cualquier artículo, así que publicar uno nuevo lo
 * refresca sin intervención.
 *
 * El archivo empieza con punto, así que el .htaccess bloquea su acceso
 * público. Si la carpeta no tuviera permiso de escritura, simplemente
 * recalcula cada vez en lugar de fallar.
 */
function flova_leer_articulos($carpeta, array $overrides = [])
{
    $cache = $carpeta . '/.indice-cache.json';

    $huellaPartes = [];
    foreach (glob($carpeta . '/*.php') as $r) {
        $huellaPartes[] = basename($r) . ':' . filemtime($r);
    }
    $huella = md5(implode('|', $huellaPartes) . '|' . json_encode($overrides));

    if (is_readable($cache)) {
        $guardado = json_decode(file_get_contents($cache), true);
        if (is_array($guardado) && ($guardado['huella'] ?? '') === $huella) {
            return $guardado['articulos'];
        }
    }

    $articulos = flova_escanear_articulos($carpeta, $overrides);

    @file_put_contents($cache, json_encode(
        ['huella' => $huella, 'articulos' => $articulos],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ));

    return $articulos;
}

function flova_escanear_articulos($carpeta, array $overrides = [])
{
    $articulos = [];

    // Ruta pública de esta carpeta, deducida de dónde está realmente.
    // Así los enlaces salen correctos se llame /blog, /blogs o como sea,
    // sin tener que tocar el código.
    $rDoc     = rtrim(str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'])), '/');
    $rCarpeta = rtrim(str_replace('\\', '/', (string) realpath($carpeta)), '/');
    $baseUrl  = '/' . trim(substr($rCarpeta, strlen($rDoc)), '/');
    if ($baseUrl === '/') {
        $baseUrl = '';
    }

    foreach (glob($carpeta . '/*.php') as $ruta) {
        $slug = basename($ruta, '.php');

        // Se omiten el propio índice y los archivos internos
        if ($slug === 'index' || substr($slug, 0, 1) === '_') {
            continue;
        }

        // Nunca incluirse a sí mismo, sin importar cómo se llame el archivo
        // ni en qué carpeta esté.
        if (isset($_SERVER['SCRIPT_FILENAME'])
            && realpath($ruta) === realpath($_SERVER['SCRIPT_FILENAME'])) {
            continue;
        }

        // Solo hace falta la cabecera y el hero
        $html = file_get_contents($ruta, false, null, 0, 60000);
        if ($html === false) {
            continue;
        }

        // NUEVO — metadata declarada en el array $post (artículos migrados)
        $meta = flova_leer_post_array($html);

        // Un artículo real usa la plantilla de post o declara $post.
        // Sin ninguna de las dos marcas es otra cosa (un índice, una
        // landing, un include) y no entra al listado.
        if (strpos($html, 'post-flova-hero') === false && empty($meta['title'])) {
            continue;
        }

        // Imagen del hero: primero el array $post, luego el CSS del hero.
        // Si falta, o si el archivo no existe en el servidor, se usa una
        // de respaldo en vez de omitir el artículo: es preferible una
        // tarjeta con imagen genérica a un artículo que desaparece del
        // índice sin avisar.
        $imagen = $meta['imagen'] ?? '';
        if ($imagen === ''
            && preg_match('/--post-hero-img:\s*url\(\s*[\'"]?([^\'")]+)[\'"]?\s*\)/i', $html, $mImg)) {
            $imagen = trim($mImg[1]);
        }
        $raizDoc = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
        if ($imagen === '' || !file_exists($raizDoc . $imagen)) {
            $imagen = FLOVA_IMG_RESPALDO;
        }

        // Título: H1 del hero, luego el 'h1' o 'title' del array $post,
        // y al final el <title> del HTML.
        $titulo = '';
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $html, $mH1)) {
            $titulo = trim(strip_tags($mH1[1]));
        }
        if ($titulo === '') {
            $titulo = $meta['h1'] ?? ($meta['title'] ?? '');
        }
        if ($titulo === '' && preg_match('/<title>(.*?)<\/title>/is', $html, $mT)) {
            $titulo = trim(preg_replace('/\s*\|\s*Flova Media\s*$/iu', '', $mT[1]));
        }
        if ($titulo === '') {
            continue;
        }

        // Resumen: 'description' del array $post o la meta description
        $resumen = $meta['description'] ?? '';
        if ($resumen === ''
            && preg_match('/<meta\s+name=[\'"]description[\'"]\s+content=[\'"](.*?)[\'"]\s*\/?>/is', $html, $mD)) {
            $resumen = trim(html_entity_decode($mD[1], ENT_QUOTES, 'UTF-8'));
        }

        // Eyebrow -> formato, servicio, nicho
        $eyebrow = '';
        if (preg_match('/class=[\'"]post-flova-eyebrow[\'"][^>]*>(.*?)<\/span>/is', $html, $mE)) {
            $eyebrow = trim(strip_tags($mE[1]));
        }
        list($formato, $pilar, $vertical) = flova_clasificar($eyebrow);

        // El 'servicio' del array $post manda sobre lo deducido del eyebrow
        if (!empty($meta['servicio'])) {
            $pilar = $meta['servicio'];
        }
        // Si no hubo eyebrow, el nicho se deduce del título
        if ($vertical === '') {
            list(, , $vertical) = flova_clasificar('Guía · ' . $titulo);
        }

        // Fecha y tiempo de lectura
        $fechaTs = 0;
        $lectura = $meta['lectura'] ?? '';
        if (preg_match('/post-flova-meta-texto[\'"][^>]*>.*?<\/strong>\s*([^<]+)/is', $html, $mM)) {
            $linea = trim($mM[1]);
            $fechaTs = flova_parsear_fecha($linea);
            if ($lectura === '' && preg_match('/(\d+)\s*min/i', $linea, $mL)) {
                $lectura = $mL[1] . ' min';
            }
        }
        // Respaldo 1: la fecha 'publicado' del array $post (formato Y-m-d)
        if (!$fechaTs && !empty($meta['publicado'])) {
            $fechaTs = (int) strtotime($meta['publicado']);
        }
        // Respaldo 2: si el artículo no trae fecha, se usa la del archivo
        if (!$fechaTs) {
            $fechaTs = filemtime($ruta);
        }

        // Correcciones manuales
        if (isset($overrides[$slug])) {
            $pilar    = $overrides[$slug]['pilar']    ?? $pilar;
            $vertical = $overrides[$slug]['vertical'] ?? $vertical;
        }

        $articulos[$slug] = [
            'slug'     => $slug,
            'url'      => $baseUrl . '/' . $slug,
            'titulo'   => $titulo,
            'resumen'  => $resumen,
            'imagen'   => $imagen,
            'formato'  => $formato,
            'pilar'    => $pilar,
            'vertical' => $vertical,
            'fecha_ts' => $fechaTs,
            'fecha'    => flova_fecha_corta($fechaTs),
            'fecha_iso'=> date('Y-m-d', $fechaTs),
            'lectura'  => $lectura,
        ];
    }

    // Más recientes primero
    uasort($articulos, function ($a, $b) {
        return $b['fecha_ts'] <=> $a['fecha_ts'];
    });

    return $articulos;
}