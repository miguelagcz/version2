<?php

define('FLOVA_BLOG', true);
require __DIR__ . '/_articulos.php';

$todos = flova_leer_articulos(__DIR__, $FLOVA_OVERRIDES);

// Se separan los pilares del resto
$hubs = [];
foreach ($FLOVA_HUBS as $slugHub) {
    if (isset($todos[$slugHub])) {
        $hubs[$slugHub] = $todos[$slugHub];
        unset($todos[$slugHub]);
    }
}
$articulos = array_values($todos);

// Conteo por servicio para los chips
$conteo = array_fill_keys($FLOVA_SERVICIOS, 0);
foreach ($articulos as $a) {
    if ($a['pilar'] !== '' && isset($conteo[$a['pilar']])) {
        $conteo[$a['pilar']]++;
    }
}

// Orden del listado para el schema: los pilares primero, luego el resto.
$lista           = array_merge(array_values($hubs), $articulos);
$totalPublicados = count($lista);

$itemList = [];
foreach ($lista as $i => $a) {
    $itemList[] = [
        '@type'    => 'ListItem',
        'position' => $i + 1,
        'url'      => 'https://flovamedia.com' . $a['url'],
        'name'     => $a['titulo'],
    ];
}

// Mes en curso para el texto de urgencia del CTA (se actualiza solo).
$MESES_LARGOS = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$mesActual = $MESES_LARGOS[(int) date('n')];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TKVRW96N');</script>
<!-- End Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y8234Q56HJ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Y8234Q56HJ');
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blog de Marketing Digital | Flova Media</title>
    <meta name="description" content="Guías prácticas de Google Ads, Facebook Ads, SEO y embudos de venta para inmobiliarias, empresas de energía solar y negocios de alto ticket en México.">

    <link rel="icon" href="/img/1.png" type="image/png">
    <link rel="shortcut icon" href="/img/1.png" type="image/png">

    <link rel="stylesheet" href="/css/blog-flova.css?v1">
    <link rel="stylesheet" href="/css/blog-indice.css?v1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="canonical" href="https://flovamedia.com/blog/">

    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog de Marketing Digital | Flova Media">
    <meta property="og:description" content="Guías prácticas de Google Ads, Facebook Ads, SEO y embudos de venta para inmobiliarias, empresas de energía solar y negocios de alto ticket.">
    <meta property="og:url" content="https://flovamedia.com/blog/">

    <script type="application/ld+json">
    <?= json_encode([
        '@context' => 'https://schema.org',
        '@type'    => 'CollectionPage',
        'name'     => 'Blog de Marketing Digital de Flova Media',
        'url'      => 'https://flovamedia.com/blog',
        'description' => 'Guías prácticas de Google Ads, Facebook Ads, SEO y embudos de venta para inmobiliarias, empresas de energía solar y negocios de alto ticket en México.',
        'publisher' => [
            '@type' => 'Organization',
            'name'  => 'Flova Media',
            'url'   => 'https://flovamedia.com',
            'logo'  => 'https://flovamedia.com/img/logob.png',
        ],
        'mainEntity' => [
            '@type' => 'ItemList',
            'numberOfItems'   => $totalPublicados,
            'itemListElement' => $itemList,
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKVRW96N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/componentes/header-blog.php'; ?>

    <main class="blog-indice">

        <!-- HERO -->
        <div class="bi-hero">
            <div class="bi-hero-inner">
                <span class="bi-hero-eyebrow">Blog · Flova Media</span>
                <h1>Guías de marketing digital</h1>
                <p class="bi-hero-subtitulo">
                    Google Ads, Facebook Ads, SEO y embudos de venta, explicados sin humo y aterrizados
                    a inmobiliarias, empresas de energía solar y negocios de alto ticket.
                </p>
            </div>
        </div>

        <div class="bi-contenedor">

            <?php if ($hubs): ?>
            <!-- EMPIEZA AQUÍ -->
            <div class="bi-bloque">
                <div class="bi-titulo-bloque">
                    <h2>Empieza aquí</h2>
                    <p>Si es tu primera vez, estas tres guías cubren las bases de cada canal.</p>
                </div>

                <div class="bi-hubs">
                    <?php foreach ($hubs as $h): ?>
                    <a class="bi-hub" href="<?= htmlspecialchars($h['url']) ?>">
                        <?php if ($h['imagen'] !== ''): ?>
                        <div class="bi-hub-img">
                            <img src="<?= htmlspecialchars($h['imagen']) ?>"
                                 alt="" width="400" height="225"
                                 loading="lazy" decoding="async">
                        </div>
                        <?php endif; ?>
                        <div class="bi-hub-cuerpo">
                            <span class="bi-etiqueta"><?= htmlspecialchars($h['pilar'] ?: 'Guía') ?></span>
                            <h3><?= htmlspecialchars($h['titulo']) ?></h3>
                            <span class="bi-hub-meta">
                                <?= htmlspecialchars($h['fecha']) ?>
                                <?= $h['lectura'] ? ' · ' . htmlspecialchars($h['lectura']) : '' ?>
                            </span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>


            <!-- FILTROS + LISTA -->
            <div class="bi-bloque">
                <div class="bi-titulo-bloque">
                    <h2>Todos los artículos</h2>
                    <p>Filtra por el servicio que te interesa.</p>
                </div>

                <div class="bi-filtros" id="biFiltros" role="group" aria-label="Filtrar artículos por servicio">
                    <button class="bi-chip bi-chip-activo" data-filtro="todos" type="button">
                        Todos <span class="bi-chip-num"><?= count($articulos) ?></span>
                    </button>
                    <?php foreach ($FLOVA_SERVICIOS as $servicio):
                        $n = $conteo[$servicio];
                        $off = $n === 0 ? ' bi-chip-vacio' : ''; ?>
                    <button class="bi-chip<?= $off ?>"
                            data-filtro="<?= htmlspecialchars($servicio) ?>"
                            type="button"
                            <?= $n === 0 ? 'disabled aria-disabled="true" title="Próximamente"' : '' ?>>
                        <?= htmlspecialchars($servicio) ?> <span class="bi-chip-num"><?= $n ?></span>
                    </button>
                    <?php endforeach; ?>
                </div>

                <div class="bi-lista" id="biLista">
                    <?php foreach ($articulos as $a): ?>
                    <article class="bi-card<?= $a['imagen'] === '' ? ' bi-card--sin-img' : '' ?>" data-pilar="<?= htmlspecialchars($a['pilar']) ?>">
                        <?php if ($a['imagen'] !== ''): ?>
                        <a class="bi-card-img" href="<?= htmlspecialchars($a['url']) ?>" tabindex="-1" aria-hidden="true">
                            <img src="<?= htmlspecialchars($a['imagen']) ?>"
                                 alt="" width="240" height="180"
                                 loading="lazy" decoding="async">
                        </a>
                        <?php endif; ?>
                        <div class="bi-card-cuerpo">
                            <span class="bi-etiqueta">
                                <?= htmlspecialchars($a['formato']) ?>
                                <?= $a['pilar'] ? ' · ' . htmlspecialchars($a['pilar']) : '' ?>
                                <?= $a['vertical'] ? ' · ' . htmlspecialchars($a['vertical']) : '' ?>
                            </span>
                            <h3 class="bi-card-titulo">
                                <a href="<?= htmlspecialchars($a['url']) ?>"><?= htmlspecialchars($a['titulo']) ?></a>
                            </h3>
                            <?php if ($a['resumen']): ?>
                            <p class="bi-card-resumen"><?= htmlspecialchars($a['resumen']) ?></p>
                            <?php endif; ?>
                            <div class="bi-card-pie">
                                <span class="bi-card-meta">
                                    <time datetime="<?= htmlspecialchars($a['fecha_iso']) ?>"><?= htmlspecialchars($a['fecha']) ?></time>
                                    <?= $a['lectura'] ? ' · ' . htmlspecialchars($a['lectura']) : '' ?>
                                </span>
                                <a class="bi-card-btn" href="<?= htmlspecialchars($a['url']) ?>">Leer artículo</a>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>

                <p class="bi-vacio" id="biVacio" hidden>
                    Todavía no hay artículos publicados en esta categoría. Estamos trabajando en ellos.
                </p>
            </div>

        </div>

        <!-- CTA FINAL -->
        <div class="post-flova-cta-final">
            <div class="post-flova-cta-final-inner">
                <h2>Leer está bien. Aplicarlo es lo que vende</h2>
                <p>Agenda una sesión gratuita de 20 minutos y te decimos, sin compromiso,<br>qué de todo esto le falta a tu negocio hoy.</p>

                <div class="botonAgenda">
                    <button onclick="
                        document.cookie = 'preferred_language=es; path=/; max-age=31536000;';
                        window.location.href = '/agenda';">
                        <strong>AGENDA TU SESIÓN GRATUITA DE 20 MINUTOS</strong>
                    </button>
                </div>
                <p class="textoAgenda">
                    ¡Date prisa! ¡Quedan pocas sesiones GRATIS de estrategia para <?= $mesActual ?>!
                </p>
            </div>
        </div>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/componentes/footer-blog.php'; ?>

    <script>
    (function () {
        var filtros = document.getElementById('biFiltros');
        var lista   = document.getElementById('biLista');
        var vacio   = document.getElementById('biVacio');
        if (!filtros || !lista) return;

        var cards = Array.prototype.slice.call(lista.querySelectorAll('.bi-card'));

        filtros.addEventListener('click', function (e) {
            var chip = e.target.closest('.bi-chip');
            if (!chip || chip.disabled) return;

            filtros.querySelectorAll('.bi-chip').forEach(function (c) {
                c.classList.remove('bi-chip-activo');
            });
            chip.classList.add('bi-chip-activo');

            var filtro = chip.getAttribute('data-filtro');
            var visibles = 0;

            cards.forEach(function (card) {
                var mostrar = (filtro === 'todos') || (card.getAttribute('data-pilar') === filtro);
                card.hidden = !mostrar;
                if (mostrar) visibles++;
            });

            if (vacio) vacio.hidden = visibles > 0;
        });
    })();
    </script>

</body>

</html>
