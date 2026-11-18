<?php
/**
 * =============================================================
 *  FlovaMedia — Generador de sitemaps
 *  Ubicación: public_html/sitemap.php
 * =============================================================
 *
 *  Sirve tres documentos según el parámetro ?s=
 *    (sin parámetro) -> índice que apunta a los otros dos
 *    ?s=paginas      -> home, servicios, ebooks, blog (las legales van con noindex y no se listan)
 *    ?s=blog         -> todos los artículos, leídos del blog
 *
 *  Las URLs públicas son /sitemap.xml, /sitemap-paginas.xml y
 *  /sitemap-blog.xml — el .htaccess se encarga del mapeo.
 *
 *  El blog se lee con la misma función que usa el índice, así que
 *  publicar un artículo lo agrega aquí automáticamente y ambos
 *  comparten el archivo de caché.
 * =============================================================
 */

const FLOVA_HOST = 'https://flovamedia.com';

/* -------------------------------------------------------------
   PÁGINAS ESTÁTICAS
   Clave = URL limpia (la que quieres indexada)
   Valor = archivo en disco, solo para sacar la fecha real de
           modificación. Si el archivo no existe, se omite la
           URL en vez de publicar un enlace roto.
------------------------------------------------------------- */
$FLOVA_PAGINAS = [
    '/'                                    => 'index.html',
    '/facebook'                            => 'facebook.html',
    '/google-ads'                          => 'google-ads.html',
    '/seo'                                 => 'seo.html',
    '/paginas-de-aterrizaje'               => 'ads.html',
    '/sobre-nosotros'                      => 'sobre-nosotros.html',
    '/agenda'                              => 'agenda.html',
    '/contactoform'                        => 'contacto.html',
    '/ebook-facebook'                      => 'Ebook-facebook.html',
    '/ebook-google-ads'                    => 'Ebook-googleads.html',
    '/ebook-seo'                           => 'Ebook-seo.html',
    '/ebook-paginas-de-aterrizaje'         => 'Ebook-aterrizaje.html',
    '/blog/'                               => 'blog/index.php',
];

/* -------------------------------------------------------------
   UTILIDADES
------------------------------------------------------------- */

function flova_url($ruta)
{
    return FLOVA_HOST . $ruta;
}

/** Escapa lo que va dentro de <loc>. Los & sin escapar rompen el XML. */
function flova_xml($texto)
{
    return htmlspecialchars($texto, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

function flova_lastmod($rutaArchivo)
{
    return file_exists($rutaArchivo) ? date('Y-m-d', filemtime($rutaArchivo)) : null;
}

function flova_encabezado()
{
    header('Content-Type: application/xml; charset=UTF-8');
    header('X-Robots-Tag: noindex');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
}

/** Imprime un bloque <url> con lastmod opcional. */
function flova_entrada($url, $lastmod = null)
{
    echo "  <url>\n";
    echo '    <loc>' . flova_xml($url) . "</loc>\n";
    if ($lastmod) {
        echo '    <lastmod>' . $lastmod . "</lastmod>\n";
    }
    echo "  </url>\n";
}


/* -------------------------------------------------------------
   CARGA DE ARTÍCULOS
------------------------------------------------------------- */

function flova_articulos_sitemap()
{
    $lector = __DIR__ . '/blog/_articulos.php';
    if (!is_readable($lector)) {
        return [];
    }

    // El lector se autoprotege contra acceso directo con esta constante.
    if (!defined('FLOVA_BLOG')) {
        define('FLOVA_BLOG', true);
    }
    require_once $lector;

    if (!function_exists('flova_leer_articulos')) {
        return [];
    }

    $overrides = isset($FLOVA_OVERRIDES) && is_array($FLOVA_OVERRIDES) ? $FLOVA_OVERRIDES : [];
    return flova_leer_articulos(__DIR__ . '/blog', $overrides);
}


/* -------------------------------------------------------------
   SALIDA
------------------------------------------------------------- */

$seccion = isset($_GET['s']) ? $_GET['s'] : '';
$raiz    = rtrim(__DIR__, '/');

flova_encabezado();

if ($seccion === 'paginas') {

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($FLOVA_PAGINAS as $url => $archivo) {
        $enDisco = $raiz . '/' . $archivo;
        if (!file_exists($enDisco)) {
            continue;
        }
        flova_entrada(flova_url($url), flova_lastmod($enDisco));
    }
    echo '</urlset>';

} elseif ($seccion === 'blog') {

    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach (flova_articulos_sitemap() as $art) {
        // $art['url'] ya viene como /blog/slug (URL limpia, sin .php)
        $enDisco = $raiz . '/blog/' . $art['slug'] . '.php';
        flova_entrada(flova_url($art['url']), flova_lastmod($enDisco));
    }
    echo '</urlset>';

} else {

    // Índice. El lastmod de cada sitemap hijo es la fecha más reciente
    // que contiene, para que Google sepa cuál vale la pena volver a leer.
    $lastPaginas = null;
    foreach ($FLOVA_PAGINAS as $archivo) {
        $f = flova_lastmod($raiz . '/' . $archivo);
        if ($f && (!$lastPaginas || $f > $lastPaginas)) {
            $lastPaginas = $f;
        }
    }

    $lastBlog = null;
    foreach (flova_articulos_sitemap() as $art) {
        $f = flova_lastmod($raiz . '/blog/' . $art['slug'] . '.php');
        if ($f && (!$lastBlog || $f > $lastBlog)) {
            $lastBlog = $f;
        }
    }

    echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ([
        ['/sitemap-paginas.xml', $lastPaginas],
        ['/sitemap-blog.xml',    $lastBlog],
    ] as $hijo) {
        echo "  <sitemap>\n";
        echo '    <loc>' . flova_xml(flova_url($hijo[0])) . "</loc>\n";
        if ($hijo[1]) {
            echo '    <lastmod>' . $hijo[1] . "</lastmod>\n";
        }
        echo "  </sitemap>\n";
    }
    echo '</sitemapindex>';
}
