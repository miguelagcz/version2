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

    <title>Core Web Vitals: qué son y cómo mejorarlos | Flova Media</title>
    <meta name="description" content="Qué son las Core Web Vitals, los umbrales de LCP, INP y CLS, y cómo saber si tu sitio las pasa. Guía práctica para dueños de negocio en México.">

    <link rel="icon" href="/img/1.png" type="image/png">
    <link rel="shortcut icon" href="/img/1.png" type="image/png">

    <link rel="stylesheet" href="/css/blog-flova.css?v202609302">
    <!-- Bloque "Servicio relacionado": estilos temporales, mover a /css/blog-flova.css -->
    <style>
        .post-flova-servicio {
            margin: 3rem 0;
            padding: 1.5rem 1.7rem;
            background: var(--post-tint);
            border: 1px solid var(--post-tint-strong);
            border-left: 4px solid var(--post-azul);
            border-radius: 0 0.8rem 0.8rem 0;
        }
        .post-flova-cuerpo .post-flova-servicio-etiqueta {
            margin: 0 0 0.6rem;
            font-size: 0.75rem;
            font-weight: 700;
            line-height: 1.4;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--post-azul);
        }
        .post-flova-cuerpo .post-flova-servicio p:last-child {
            margin-bottom: 0;
        }
        .post-flova-servicio a {
            color: var(--post-azul);
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .post-flova-servicio a:hover {
            text-decoration-thickness: 2px;
        }
        @media (max-width: 400px) {
            .post-flova-servicio {
                padding: 1.2rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="canonical" href="https://flovamedia.com/blog/core-web-vitals">
    
    <link rel="alternate" hreflang="es-MX" href="https://flovamedia.com/blog/core-web-vitals">
    <link rel="alternate" hreflang="x-default" href="https://flovamedia.com/blog/core-web-vitals">
    <meta name="geo.region" content="MX-CMX">
    <meta name="geo.placename" content="Ciudad de México">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="Flova Media">
    <meta property="og:title" content="Core Web Vitals: qué son y cómo mejorarlos | Flova Media">
    <meta property="og:description" content="Qué son las Core Web Vitals, los umbrales de LCP, INP y CLS, y cómo saber si tu sitio las pasa. Guía práctica para dueños de negocio en México.">
    <meta property="og:url" content="https://flovamedia.com/blog/core-web-vitals">
    <meta property="og:image" content="https://flovamedia.com/img/blog/core-web-vitals.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BlogPosting",
      "@id": "https://flovamedia.com/blog/core-web-vitals#articulo",
      "headline": "Core Web Vitals: qué son y cómo mejorarlos",
      "description": "Qué son las Core Web Vitals, los umbrales de LCP, INP y CLS, y cómo saber si tu sitio las pasa. Guía práctica para dueños de negocio en México.",
      "inLanguage": "es-MX",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://flovamedia.com/blog/core-web-vitals"
      },
      "author": {
        "@type": "Organization",
        "name": "Flova Media",
        "url": "https://flovamedia.com/"
      },
      "publisher": {
        "@id": "https://flovamedia.com/#organizacion"
      },
      "image": "https://flovamedia.com/img/blog/core-web-vitals.jpg",
      "datePublished": "2026-09-18",
      "dateModified": "2026-09-18",
      "articleSection": "Google SEO"
    },
    {
      "@type": "Organization",
      "@id": "https://flovamedia.com/#organizacion",
      "name": "Flova Media",
      "url": "https://flovamedia.com/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://flovamedia.com/img/logob.png"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Inicio",
          "item": "https://flovamedia.com/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Blog",
          "item": "https://flovamedia.com/blog/"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "Core Web Vitals: qué son y cómo mejorarlos",
          "item": "https://flovamedia.com/blog/core-web-vitals"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "inLanguage": "es-MX",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿Las Core Web Vitals afectan mi posicionamiento en Google?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sí, son parte de las señales de experiencia de página que Google usa, pero pesan menos de lo que suele venderse. Entre dos páginas que responden igual de bien a lo que alguien busca, la más rápida y estable tiene ventaja. Entre una página rápida con contenido pobre y una lenta con contenido excelente, gana la segunda casi siempre. Donde sí se nota de inmediato es en la conversión, no en la posición. Una página que tarda o que brinca pierde prospectos que ya llegaron, y eso duele más cuando pagaste publicidad para traerlos. Si tu ticket promedio se mide en cientos de miles de pesos, cada visita que se cae por un formulario inestable es un costo directo, aunque tu ranking no se haya movido ni un lugar."
          }
        },
        {
          "@type": "Question",
          "name": "¿Por qué PageSpeed Insights me da 90 y Search Console dice que estoy mal?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Porque están midiendo dos cosas distintas. La calificación grande y colorida de PageSpeed Insights viene de una prueba simulada en un entorno controlado. Search Console reporta lo que les pasó a tus visitantes reales durante los últimos 28 días, con sus celulares y sus conexiones. La segunda es la que cuenta para posicionar. Cuando veas esa contradicción, baja en PageSpeed Insights hasta el bloque de datos de usuarios reales, que aparece arriba de la simulación. Ahí vas a encontrar números parecidos a los de Search Console. La prueba simulada sigue siendo útil, pero para otra cosa: te dice qué arreglar. Los datos reales te dicen si ya funcionó."
          }
        },
        {
          "@type": "Question",
          "name": "¿Cuánto tarda en actualizarse mi calificación después de arreglar el sitio?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Entre tres y cuatro semanas desde que la corrección está publicada. La calificación se construye con una ventana móvil de 28 días de visitas reales, así que el reporte tiene que ir soltando los días malos y llenándose de días buenos. No hay forma de acelerarlo ni botón de revisión que lo adelante. Esto tiene una consecuencia práctica que conviene acordar con tu proveedor desde el principio: no midas el trabajo por el reporte de la semana siguiente. Lo que sí puedes revisar de inmediato es la prueba simulada, que te confirma si el cambio técnico quedó bien hecho. El reporte de campo llega después y es el que manda."
          }
        },
        {
          "@type": "Question",
          "name": "¿Necesito rehacer mi sitio completo para pasar las Core Web Vitals?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Casi nunca. En la mayoría de los casos que revisamos, tres arreglos concentran la mejora: comprimir las imágenes del encabezado, quitar scripts de terceros que ya nadie usa, y declarar las dimensiones de imágenes y videos. Eso no es un rediseño, es un par de días de trabajo técnico sobre lo que ya tienes. El rediseño se justifica cuando el problema es de construcción: una plantilla comprada cargada de funciones que no ocupas, un constructor visual que genera código inflado, o un sitio armado con veinte plugins encimados. Ahí sí, remendar sale más caro que rehacer. La forma de saber en cuál de los dos casos estás es medir primero y hacer los arreglos baratos; si después de eso las métricas siguen mal, el problema es estructural."
          }
        },
        {
          "@type": "Question",
          "name": "¿Qué pasa si mi sitio tiene poco tráfico y no aparece en el reporte?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Es normal y le pasa a muchos negocios de alto ticket. Google necesita un mínimo de visitas para armar una muestra confiable, y si tu sitio recibe pocas al mes, simplemente no va a haber datos de campo para tus URLs. En ese caso Google puede recurrir a datos de todo el dominio en lugar de la página individual, o no reportar nada. Que no aparezcas no significa que estés bien. Significa que no te están midiendo todavía. Usa la prueba simulada de PageSpeed Insights como guía, deja el sitio en buen estado desde ahora, y cuando el tráfico crezca vas a llegar a esa etapa con la casa ordenada en lugar de con una alerta en rojo. Es mucho más barato hacerlo así que corregirlo cuando ya dependes del canal."
          }
        }
      ]
    }
  ]
}
    </script>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TKVRW96N"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/componentes/header-blog.php'; ?>

    <main class="post-flova">

        <!-- HERO -->
        <div class="post-flova-hero" style="--post-hero-img: url('/img/blog/core-web-vitals.jpg');">
            <div class="post-flova-hero-inner">
                <span class="post-flova-eyebrow">Guía · Google SEO</span>
                <h1>Core Web Vitals: qué son y cómo mejorarlos</h1>
                <p class="post-flova-subtitulo">
                    Las tres métricas con las que Google mide si tu sitio le sirve a quien lo visita, explicadas sin tecnicismos y con lo que sí puedes hacer al respecto.
                </p>
                <div class="post-flova-meta">
                    <div class="post-flova-avatar">FM</div>
                    <div class="post-flova-meta-texto">
                        <strong>Equipo editorial de Flova Media</strong>
                        18 de septiembre, 2026 · Lectura de 8 min
                    </div>
                </div>
            </div>
        </div>

        <!-- LAYOUT DE DOS COLUMNAS -->
        <div class="post-flova-layout">

            <article class="post-flova-cuerpo">

                <p class="post-flova-intro">
                    Tu página se ve bien. La abres desde la computadora de la oficina y carga al instante. Nadie se ha quejado nunca. Y un día alguien de tu equipo entra a Search Console y ahí está la advertencia: problemas de Core Web Vitals en la mayoría de tus URLs.
                </p>

                <p>
                    Lo que casi nadie te explica es que Google no está calificando la página que tú abres. Está calificando la que abre un prospecto con un celular de gama media y datos móviles en la Roma a las dos de la tarde. Son dos experiencias distintas, y la segunda es la que cuenta.
                </p>

                <p>
                    Esta guía es parte de nuestro material sobre <a href="/blog/que-es-el-seo-y-por-que-usarlo">qué es el SEO y por qué conviene invertir en él</a>. Aquí nos metemos a una sola pieza: las tres métricas con las que Google mide la experiencia real de tus visitantes.
                </p>

                <div class="post-flova-toc-inline">
                    <p>En esta guía</p>
                    <ul>
                        <li><a href="#que-son">Qué son las Core Web Vitals</a></li>
                        <li><a href="#las-tres-metricas">Las tres métricas y sus umbrales</a></li>
                        <li><a href="#datos-de-campo">El detalle que cambia todo: datos de campo</a></li>
                        <li><a href="#que-las-rompe">Qué las rompe, en orden de frecuencia</a></li>
                        <li><a href="#por-industria">Cómo se ve esto en tu industria</a></li>
                        <li><a href="#como-medirlo">Cómo medirlo y qué esperar</a></li>
                        <li><a href="#faq">Preguntas frecuentes</a></li>
                    </ul>
                </div>

                <section id="que-son">
                    <h2>Qué son las Core Web Vitals</h2>
                    <p>
                        Las Core Web Vitals son tres métricas con las que Google mide la experiencia real de quien visita tu sitio: qué tan rápido aparece el contenido, qué tan rápido responde cuando alguien toca algo, y qué tan quieto se queda todo mientras carga.
                    </p>
                    <p>
                        Ojo con la confusión más común. <strong>No son lo mismo que "velocidad de carga"</strong>, aunque una de las tres sí la mide. Un sitio puede cargar en un segundo y seguir reprobando porque los botones tardan en responder o porque el contenido brinca de lugar mientras el visitante lo lee. Velocidad es una tercera parte del asunto.
                    </p>
                    <p>
                        Tampoco son todo el SEO técnico. Si lo que te preocupa es el panorama completo, incluyendo indexación y errores de rastreo, eso lo cubrimos en la guía de <a href="/blog/seo-tecnico-velocidad-indexacion-errores">SEO técnico: velocidad, indexación y errores</a>. Aquí vamos a fondo en las métricas.
                    </p>
                    <p>
                        Y sí, cuentan para posicionar. Google las reconoce como parte de sus señales de experiencia de página. Pero el argumento más fuerte no es ese: es que una página lenta o inestable pierde prospectos que ya habías pagado por traer.
                    </p>
                </section>

                <section id="las-tres-metricas">
                    <h2>Las tres métricas y sus umbrales</h2>
                    <p>
                        Google publica un umbral para cada una. Pasarlas significa quedar dentro de los tres, no dentro de dos.
                    </p>

                    <h3>LCP: qué tan rápido aparece lo importante</h3>
                    <p>
                        Largest Contentful Paint mide cuánto tarda en aparecer el elemento más grande de la pantalla: normalmente la foto principal o el titular. Es, en la práctica, cuánto tarda el visitante en ver aquello por lo que entró.
                    </p>
                    <p>
                        <strong>El umbral bueno es 2.5 segundos o menos.</strong> Entre 2.5 y 4 segundos necesita mejorar. Arriba de 4 segundos se considera malo.
                    </p>

                    <h3>INP: qué tan rápido responde cuando tocan algo</h3>
                    <p>
                        Interaction to Next Paint mide el tiempo entre que alguien da clic, toca o escribe, y el momento en que la pantalla le responde algo. Es el equivalente digital de apretar el botón del elevador y esperar a que se prenda la luz. Si tarda, vuelves a apretar. Y si tarda mucho, te vas por las escaleras.
                    </p>
                    <p>
                        <strong>El umbral bueno es 200 milisegundos o menos.</strong> Arriba de 500 milisegundos se considera malo.
                    </p>
                    <p>
                        Si alguien de tu equipo todavía habla de FID, está usando información vieja: esa métrica quedó retirada en marzo de 2024. La diferencia importa, porque FID solo medía la primera interacción, mientras que INP evalúa todas. Es una vara considerablemente más alta.
                    </p>

                    <h3>CLS: qué tanto se mueve todo mientras carga</h3>
                    <p>
                        Cumulative Layout Shift mide cuánto brinca el contenido mientras la página termina de cargar. Ya lo viviste: vas a dar clic en un botón, entra un banner tarde, todo se recorre, y terminas dando clic donde no querías.
                    </p>
                    <p>
                        <strong>El umbral bueno es 0.1 o menos.</strong> Arriba de 0.25 se considera malo.
                    </p>
                    <p>
                        Esta es la métrica que más daño hace en formularios de contacto, y casi nadie la revisa.
                    </p>
                </section>

                <section id="datos-de-campo">
                    <h2>El detalle que cambia todo: datos de campo</h2>
                    <p>
                        Aquí está la parte que hace que la mitad de las conversaciones sobre este tema vayan en la dirección equivocada.
                    </p>
                    <p>
                        Google no califica tu sitio con una prueba de laboratorio. Lo califica con lo que le pasó a <strong>tus visitantes reales</strong>, desde sus dispositivos reales, en sus conexiones reales, durante los últimos 28 días. Esa información sale del Chrome User Experience Report, y es lo que se conoce como datos de campo.
                    </p>
                    <p>
                        Es la diferencia entre calificar un restaurante por lo que dicen los comensales que sí fueron, y calificarlo por lo que dice el chef en su cocina vacía a las once de la mañana. El chef siempre va a salir bien.
                    </p>
                    <p>
                        Y hay una segunda capa. Google no usa el promedio, usa el <strong>percentil 75</strong>. Para pasar, el 75% de las visitas tiene que estar dentro del umbral bueno. Eso significa que si una cuarta parte de tu tráfico tiene mala experiencia, repruebas, por muy bien que le vaya al resto.
                    </p>
                    <p>
                        De ahí sale la escena que nos toca ver seguido en juntas: el desarrollador enseña su pantalla con calificación de 95 y el dueño enseña Search Console con la alerta en rojo. Los dos tienen razón. Están midiendo cosas distintas.
                    </p>
                </section>

                <section id="que-las-rompe">
                    <h2>Qué las rompe, en orden de frecuencia</h2>
                    <p>
                        En los sitios que auditamos, los culpables se repiten. Van ordenados por qué tan seguido aparecen, no por qué tan graves son.
                    </p>
                    <ul>
                        <li><strong>Imágenes pesadas sin comprimir.</strong> El caso más común y el más fácil de arreglar. Una foto de render de 4 MB en el encabezado destruye el LCP sola. Sube las imágenes en formatos modernos y al tamaño en que realmente se van a mostrar.</li>
                        <li><strong>Demasiados scripts de terceros.</strong> Cada píxel, chat, mapa de calor y widget de reseñas cobra su cuota. Es la causa número uno de INP malo. Haz inventario: casi siempre hay dos o tres que nadie usa desde hace un año.</li>
                        <li><strong>Imágenes y videos sin dimensiones declaradas.</strong> Si el navegador no sabe cuánto espacio va a ocupar algo, no lo aparta, y cuando llega empuja todo lo demás. Es la causa número uno de CLS malo y se corrige con dos atributos en el código.</li>
                        <li><strong>Fuentes tipográficas que cargan tarde.</strong> El texto aparece con una tipografía y a la mitad de segundo cambia a otra. El brinco cuenta como inestabilidad.</li>
                        <li><strong>Banners, avisos de cookies y pop-ups que entran tarde.</strong> Si se insertan empujando el contenido en lugar de encimarse, cada visita suma inestabilidad.</li>
                        <li><strong>Hosting barato o mal ubicado.</strong> El menos glamoroso y el más de fondo. Si tu servidor está en otro continente y tu mercado está en México, cada visita arranca con desventaja.</li>
                    </ul>
                    <p>
                        Los primeros tres explican la mayoría de los casos que nos llegan. Si solo vas a atacar algo este mes, ataca esos. Hay más problemas técnicos que sangran tráfico sin que nadie los note, y los reunimos en <a href="/blog/errores-de-seo-que-matan-tu-trafico">los errores de SEO que matan tu tráfico</a>.
                    </p>
                </section>

                <section id="por-industria">
                    <h2>Cómo se ve esto en tu industria</h2>
                    <p>
                        El diagnóstico general sirve poco. Lo que rompe las métricas cambia según qué vendes y cómo es tu sitio.
                    </p>

                    <h3>Clínicas y consultorios</h3>
                    <p>
                        El problema suele estar en el widget de agenda. Esos calendarios embebidos cargan su propio paquete de código y tiran el INP, justo en el botón que más te importa. Si tu agenda tarda medio segundo en responder al primer toque, una parte de los pacientes vuelve a apretar, se frustra y se sale. Vale la pena medir esa página aparte de la principal.
                    </p>

                    <h3>Despachos jurídicos y contables</h3>
                    <p>
                        Aquí el pecado casi siempre es el CLS en las páginas de contacto. El sitio es sobrio, carga bien, y aun así reprueba porque el formulario se recorre cuando terminan de cargar las fuentes o un mapa. Quien te iba a escribir se equivoca de campo dos veces y abandona. Considerando lo que vale un solo cliente en estos giros, es una fuga cara.
                    </p>

                    <h3>Industrial B2B</h3>
                    <p>
                        Los catálogos técnicos y las fichas de producto con planos de alta resolución son un problema de LCP crónico. Súmale que buena parte del tráfico B2B llega en horario laboral desde redes corporativas con restricciones. Aquí la comprensión de imágenes y la carga diferida de todo lo que está abajo del primer pantallazo hacen la mayor diferencia.
                    </p>

                    <h3>Desarrolladoras inmobiliarias</h3>
                    <p>
                        El giro más castigado, por una razón obvia: el producto se vende con imágenes. Renders, recorridos virtuales, galerías de amenidades y video de fondo en el encabezado. Todo eso es indispensable para vender y todo eso pesa. La salida no es quitar las imágenes, es cargarlas en el orden correcto: primero la que el visitante ve, el resto conforme baja. Lo desarrollamos en <a href="/blog/seo-para-desarrollos-inmobiliarios">SEO para desarrollos inmobiliarios</a>, junto con lo que aplica al <a href="/blog/seo-local-para-inmobiliarias">posicionamiento local de una inmobiliaria</a>.
                    </p>
                </section>

                <section id="como-medirlo">
                    <h2>Cómo medirlo y qué esperar</h2>
                    <p>
                        Dos herramientas gratuitas bastan y las dos son de Google.
                    </p>
                    <p>
                        <strong>PageSpeed Insights</strong> te da el diagnóstico de una URL específica. Al abrirlo vas a ver dos bloques: uno con datos de usuarios reales y otro con una prueba simulada. <strong>El que cuenta para posicionar es el primero.</strong> Si el bloque de datos reales no aparece, es que esa página no recibe visitas suficientes para que Google tenga muestra.
                    </p>
                    <p>
                        <strong>Search Console</strong> te da la foto de todo el sitio, agrupada. Sirve para detectar qué grupo de páginas está mal, no para diagnosticar una en particular. El flujo natural es encontrar el grupo en Search Console y luego revisar una URL de ese grupo en PageSpeed Insights.
                    </p>
                    <p>
                        Sobre los tiempos, sé realista con tu equipo. Como la calificación se construye con 28 días de visitas reales, arreglar el sitio hoy no mueve el reporte mañana. Lo normal es esperar entre tres y cuatro semanas para ver el cambio reflejado, y eso contando desde que la corrección ya está en producción. Es la misma lógica de paciencia que aplica a todo lo orgánico y que explicamos en <a href="/blog/cuanto-tarda-el-seo-en-dar-resultados">cuánto tarda el SEO en dar resultados</a>.
                    </p>
                    <p>
                        ¿Y qué esperar en resultados? Google documentó un experimento de Vodafone donde dos versiones idénticas de una página compitieron entre sí, con la única diferencia de que una estaba optimizada. La versión rápida vendió 8% más. No es un número que puedas prometerle a tu consejo, pero sí te dice de qué tamaño es la palanca cuando el resto ya está bien hecho.
                    </p>
                    <p>
                        Una advertencia para cerrar esta parte. Las Core Web Vitals funcionan como desempate, no como milagro. Si tu contenido no responde lo que la gente busca, el sitio más rápido del mundo no te va a subir. Primero resuelve <a href="/blog/seo-on-page-checklist">el SEO on page</a>, después afina la velocidad. En ese orden.
                    </p>
                </section>

                <!-- Servicio relacionado (enlace interno a la página de servicio) -->
                <div class="post-flova-servicio">
                    <p class="post-flova-servicio-etiqueta">Servicio relacionado · SEO</p>
                    <p>
                        Mejorar estas métricas casi siempre implica tocar el código. Como programamos los sitios a mano, sin constructores, en nuestro <a href="/seo">servicio de SEO técnico</a> medimos tus páginas comerciales y corregimos directamente lo que las hace lentas o inestables.
                    </p>
                </div>

                <section id="faq" class="post-flova-faq">
                    <h2>Preguntas frecuentes</h2>

                    <details>
                        <summary>¿Las Core Web Vitals afectan mi posicionamiento en Google?</summary>
                        <p>Sí, son parte de las señales de experiencia de página que Google usa, pero pesan menos de lo que suele venderse. Entre dos páginas que responden igual de bien a lo que alguien busca, la más rápida y estable tiene ventaja. Entre una página rápida con contenido pobre y una lenta con contenido excelente, gana la segunda casi siempre.</p>
                        <p>Donde sí se nota de inmediato es en la conversión, no en la posición. Una página que tarda o que brinca pierde prospectos que ya llegaron, y eso duele más cuando pagaste publicidad para traerlos. Si tu ticket promedio se mide en cientos de miles de pesos, cada visita que se cae por un formulario inestable es un costo directo, aunque tu ranking no se haya movido ni un lugar.</p>
                    </details>

                    <details>
                        <summary>¿Por qué PageSpeed Insights me da 90 y Search Console dice que estoy mal?</summary>
                        <p>Porque están midiendo dos cosas distintas. La calificación grande y colorida de PageSpeed Insights viene de una prueba simulada en un entorno controlado. Search Console reporta lo que les pasó a tus visitantes reales durante los últimos 28 días, con sus celulares y sus conexiones. La segunda es la que cuenta para posicionar.</p>
                        <p>Cuando veas esa contradicción, baja en PageSpeed Insights hasta el bloque de datos de usuarios reales, que aparece arriba de la simulación. Ahí vas a encontrar números parecidos a los de Search Console. La prueba simulada sigue siendo útil, pero para otra cosa: te dice qué arreglar. Los datos reales te dicen si ya funcionó.</p>
                    </details>

                    <details>
                        <summary>¿Cuánto tarda en actualizarse mi calificación después de arreglar el sitio?</summary>
                        <p>Entre tres y cuatro semanas desde que la corrección está publicada. La calificación se construye con una ventana móvil de 28 días de visitas reales, así que el reporte tiene que ir soltando los días malos y llenándose de días buenos. No hay forma de acelerarlo ni botón de revisión que lo adelante.</p>
                        <p>Esto tiene una consecuencia práctica que conviene acordar con tu proveedor desde el principio: no midas el trabajo por el reporte de la semana siguiente. Lo que sí puedes revisar de inmediato es la prueba simulada, que te confirma si el cambio técnico quedó bien hecho. El reporte de campo llega después y es el que manda.</p>
                    </details>

                    <details>
                        <summary>¿Necesito rehacer mi sitio completo para pasar las Core Web Vitals?</summary>
                        <p>Casi nunca. En la mayoría de los casos que revisamos, tres arreglos concentran la mejora: comprimir las imágenes del encabezado, quitar scripts de terceros que ya nadie usa, y declarar las dimensiones de imágenes y videos. Eso no es un rediseño, es un par de días de trabajo técnico sobre lo que ya tienes.</p>
                        <p>El rediseño se justifica cuando el problema es de construcción: una plantilla comprada cargada de funciones que no ocupas, un constructor visual que genera código inflado, o un sitio armado con veinte plugins encimados. Ahí sí, remendar sale más caro que rehacer. La forma de saber en cuál de los dos casos estás es medir primero y hacer los arreglos baratos; si después de eso las métricas siguen mal, el problema es estructural.</p>
                    </details>

                    <details>
                        <summary>¿Qué pasa si mi sitio tiene poco tráfico y no aparece en el reporte?</summary>
                        <p>Es normal y le pasa a muchos negocios de alto ticket. Google necesita un mínimo de visitas para armar una muestra confiable, y si tu sitio recibe pocas al mes, simplemente no va a haber datos de campo para tus URLs. En ese caso Google puede recurrir a datos de todo el dominio en lugar de la página individual, o no reportar nada.</p>
                        <p>Que no aparezcas no significa que estés bien. Significa que no te están midiendo todavía. Usa la prueba simulada de PageSpeed Insights como guía, deja el sitio en buen estado desde ahora, y cuando el tráfico crezca vas a llegar a esa etapa con la casa ordenada en lugar de con una alerta en rojo. Es mucho más barato hacerlo así que corregirlo cuando ya dependes del canal.</p>
                    </details>
                </section>

                <div class="post-flova-siguiente-paso">
                    <h3>Lo que deberías hacer ahora</h3>
                    <p>
                        Abre PageSpeed Insights y mide la página que más te importa comercialmente, no la principal: la del desarrollo que estás vendiendo, la de agendar cita, la de contacto. Baja al bloque de datos de usuarios reales y anota los tres números. Eso te toma diez minutos y te dice si tienes un problema o no. Si quieres el panorama completo del canal orgánico, aquí están nuestras <a href="/ebook-seo">guías de Marketing Digital</a>, y también puedes revisar cómo hacer un <a href="/blog/como-hacer-analisis-seo-de-la-competencia">análisis SEO de tu competencia</a> para saber contra qué estás compitiendo.
                    </p>

                    <form class="cta-form">
                        <input type="email" placeholder="Ingresa tu correo...">
                        <button type="submit">¡Aquí!</button>
                    </form>
                </div>

                <details class="post-flova-fuentes">
                    <summary>Ver las fuentes consultadas en este artículo</summary>
                    <ol>
                        <li><a href="https://developers.google.com/search/docs/appearance/core-web-vitals" target="_blank" rel="noopener noreferrer">Google Search Central: documentación oficial de Core Web Vitals y su relación con los resultados de búsqueda</a></li>
                        <li><a href="https://web.dev/case-studies/vodafone" target="_blank" rel="noopener noreferrer">web.dev: caso de estudio de Vodafone sobre el impacto comercial de mejorar LCP</a></li>
                        <li><a href="https://web.dev/articles/inp" target="_blank" rel="noopener noreferrer">web.dev: documentación de la métrica Interaction to Next Paint</a></li>
                    </ol>
                </details>

            </article>

            <!-- SIDEBAR -->
            <aside class="post-flova-sidebar">
                <nav class="post-flova-toc" id="tocLateral">
                    <p class="post-flova-sidebar-titulo">En esta guía</p>
                    <ul>
                        <li><a href="#que-son">Qué son</a></li>
                        <li><a href="#las-tres-metricas">Las tres métricas</a></li>
                        <li><a href="#datos-de-campo">Datos de campo</a></li>
                        <li><a href="#que-las-rompe">Qué las rompe</a></li>
                        <li><a href="#por-industria">Por industria</a></li>
                        <li><a href="#como-medirlo">Cómo medirlo</a></li>
                        <li><a href="#faq">Preguntas frecuentes</a></li>
                    </ul>
                </nav>

                <div class="post-flova-ficha">
                    <p class="post-flova-sidebar-titulo">Ficha rápida</p>
                    <div class="post-flova-ficha-dato">
                        <span>LCP (carga)</span>
                        <strong>2.5 s o menos</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>INP (respuesta)</span>
                        <strong>200 ms o menos</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>CLS (estabilidad)</span>
                        <strong>0.1 o menos</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>Cómo se mide</span>
                        <strong>Percentil 75, 28 días</strong>
                    </div>
                </div>

                <div class="post-flova-cta-sidebar">
                    <p>¿Quieres saber cuántos prospectos estás perdiendo por la velocidad de tu sitio?</p>
                    <a href="/agenda">Agenda una sesión gratuita</a>
                </div>
            </aside>

        </div>

        <!-- CTA FINAL -->
        <div class="post-flova-cta-final">
            <div class="post-flova-cta-final-inner">
                <h2>Tu sitio es la primera junta con tu prospecto</h2>
                <p>Agenda una sesión gratuita de 20 minutos y te decimos, sin compromiso,<br>dónde estás parado hoy frente a tu competencia en Google.</p>

                <div class="botonAgenda">
                    <button onclick="
                        document.cookie = 'preferred_language=es; path=/; max-age=31536000;';
                        window.location.href = '/agenda';">
                        <strong>AGENDA TU SESIÓN GRATUITA DE 20 MINUTOS</strong>
                    </button>
                </div>
                <p class="textoAgenda">
                    ¡Date prisa! ¡Quedan pocas sesiones GRATIS de estrategia para Septiembre!
                </p>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/componentes/footer-blog.php'; ?>

</body>

</html>
