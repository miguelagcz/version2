<!DOCTYPE html>
<html lang="es">
<!--
  Normalmente quien abre el código fuente es un programador.
  Si eres dueño de un negocio y llegaste hasta aquí, ya entendiste algo:
  un buen sitio no solo se ve bien, está construido para vender.
  Hablemos → https://flovamedia.com
-->
<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TKVRW96N');</script>
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

    <title>Meta CAPI: qué es la API de Conversiones y cómo usarla | Flova Media</title>
    <meta name="description" content="Qué es la API de Conversiones de Meta, por qué el Pixel ya no alcanza, cómo se configura sin duplicar eventos y cómo usarla para recibir leads de mejor calidad.">

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
    <link rel="canonical" href="https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi">

    <link rel="alternate" hreflang="es-MX" href="https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi">
    <link rel="alternate" hreflang="x-default" href="https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi">
    <meta name="geo.region" content="MX-CMX">
    <meta name="geo.placename" content="Ciudad de México">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="Flova Media">
    <meta property="og:title" content="Meta CAPI: qué es la API de Conversiones y cómo usarla | Flova Media">
    <meta property="og:description" content="Qué es la API de Conversiones de Meta, por qué el Pixel ya no alcanza, cómo se configura sin duplicar eventos y cómo usarla para recibir leads de mejor calidad.">
    <meta property="og:url" content="https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi">
    <meta property="og:image" content="https://flovamedia.com/img/blog/meta-ads-api-de-conversiones-capi.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "BlogPosting",
      "@id": "https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi#articulo",
      "headline": "Meta CAPI: qué es la API de Conversiones y cómo usarla",
      "description": "Qué es la API de Conversiones de Meta, por qué el Pixel ya no alcanza, cómo se configura sin duplicar eventos y cómo usarla para recibir leads de mejor calidad.",
      "inLanguage": "es-MX",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi"
      },
      "author": {
        "@type": "Organization",
        "name": "Flova Media",
        "url": "https://flovamedia.com/"
      },
      "publisher": {
        "@id": "https://flovamedia.com/#organizacion"
      },
      "image": "https://flovamedia.com/img/blog/meta-ads-api-de-conversiones-capi.jpg",
      "datePublished": "2026-10-07",
      "dateModified": "2026-10-07",
      "articleSection": "Facebook Ads"
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
          "name": "Meta CAPI: qué es la API de Conversiones y cómo usarla",
          "item": "https://flovamedia.com/blog/meta-ads-api-de-conversiones-capi"
        }
      ]
    },
    {
      "@type": "FAQPage",
      "inLanguage": "es-MX",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿La API de Conversiones reemplaza al Pixel de Meta?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No. Meta recomienda usar los dos al mismo tiempo, en lo que llama una configuración redundante: el Pixel manda los eventos desde el navegador del visitante y la API los manda desde tu servidor. Si uno de los dos pierde un evento, el otro lo cubre. El Pixel sigue siendo útil para lo que pasa dentro de tu sitio en tiempo real, y la API es la única forma de mandar lo que pasa después y fuera del sitio: la cita que se agendó por teléfono, el apartado que se firmó en la oficina de ventas. Juntos le dan a Meta una imagen mucho más completa que cualquiera de los dos por separado."
          }
        },
        {
          "@type": "Question",
          "name": "¿Necesito un programador para instalar la API de Conversiones?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Depende de tu plataforma. Si tu sitio está en una plataforma con integración oficial de Meta, como varias tiendas en línea y gestores de contenido populares, la conexión se activa en unos cuantos pasos sin escribir código. Meta también ofrece una puerta de enlace que se instala en tu propia nube con un asistente. Si tu sitio está programado a mano o quieres mandar eventos desde tu CRM, sí necesitas a alguien técnico, porque los eventos se envían desde tu servidor con la información del cliente cifrada. No es un proyecto enorme, pero conviene hacerlo bien desde el principio: un evento mal configurado puede contar doble o mandar datos incompletos."
          }
        },
        {
          "@type": "Question",
          "name": "¿Qué es la calidad de coincidencia de eventos?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Es una calificación del 1 al 10 que Meta te muestra en el Administrador de Eventos para tus eventos web. Mide qué tan bien puede relacionar cada evento que le mandas con una persona real en Facebook o Instagram, según la información del cliente que incluyas: correo, teléfono, nombre y los identificadores del navegador. Entre más alta, mejor puede Meta atribuir tus resultados y encontrar a personas parecidas a tus clientes. Para subirla, manda todos los datos que tengas de cada contacto, cifrados como pide Meta, y no solo uno. Un formulario que ya pide correo y teléfono te da casi todo lo necesario."
          }
        },
        {
          "@type": "Question",
          "name": "¿Cómo evito que se dupliquen los eventos entre el Pixel y la API?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Mandando el mismo identificador de evento y el mismo nombre de evento desde los dos lados. Cuando Meta recibe dos eventos con el mismo nombre y el mismo identificador dentro de 48 horas, se queda con uno y descarta el otro. Si no lo haces, cada lead se cuenta dos veces: tus reportes se ven el doble de buenos y el algoritmo aprende con datos inflados. Antes de dar por terminada la instalación, usa la herramienta de prueba de eventos de Meta y confirma que los eventos aparecen como deduplicados."
          }
        },
        {
          "@type": "Question",
          "name": "¿Sirve la API de Conversiones si uso formularios de Meta para captar leads?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sí, y es de los usos más valiosos para un negocio de alto ticket. Meta tiene una forma de conectar tu CRM para mandarle de regreso qué leads de sus formularios avanzaron en tu proceso de venta, y así optimizar tus campañas hacia leads de calidad en lugar de solo más formularios llenos. Tiene requisitos: según su documentación, necesitas al menos unos 200 leads al mes, subir los datos al menos una vez al día, guardar el identificador de cada lead en tu CRM y que la etapa que eliges para optimizar ocurra dentro de los 28 días siguientes al lead. Si no llegas a ese volumen, todavía te conviene mandar tus ventas como eventos fuera de línea para medir mejor."
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
        <div class="post-flova-hero" style="--post-hero-img: url('/img/blog/meta-ads-api-de-conversiones-capi.jpg');">
            <div class="post-flova-hero-inner">
                <span class="post-flova-eyebrow">Guía · Facebook Ads</span>
                <h1>Meta CAPI: qué es la API de Conversiones y cómo usarla</h1>
                <p class="post-flova-subtitulo">
                    El Pixel ve lo que pasa en el navegador; la API de Conversiones ve lo que pasa en tu negocio. Por qué necesitas las dos y cómo conectarlas.
                </p>
                <div class="post-flova-meta">
                    <div class="post-flova-avatar">FM</div>
                    <div class="post-flova-meta-texto">
                        <strong>Equipo editorial de Flova Media</strong>
                        7 de octubre, 2026 · Lectura de 7 min
                    </div>
                </div>
            </div>
        </div>

        <!-- LAYOUT DE DOS COLUMNAS -->
        <div class="post-flova-layout">

            <article class="post-flova-cuerpo">

                <p class="post-flova-intro">
                    El Administrador de Anuncios dice que este mes tuviste 40 leads. Tu CRM dice 55. Y tu equipo de ventas dice que de esos 55, los que de verdad agendaron cita vinieron de campañas que Meta reporta como las peores. Tres versiones de la misma realidad, y el algoritmo está optimizando con la más incompleta.
                </p>

                <p>
                    Eso pasa porque el Pixel solo ve una parte de lo que ocurre. La <strong>API de Conversiones</strong>, o CAPI, existe para llenar los huecos. Este artículo forma parte de nuestro clúster sobre <a href="/blog/que-es-facebook-ads-como-funciona">Facebook Ads y Meta Ads</a>, y aquí vemos qué es, cómo se configura sin romper tus reportes y cómo usarla para que Meta te traiga clientes, no solo formularios.
                </p>

                <div class="post-flova-toc-inline">
                    <p>En esta guía</p>
                    <ul>
                        <li><a href="#que-es">Qué es la API de Conversiones</a></li>
                        <li><a href="#por-que-no-alcanza-el-pixel">Por qué el Pixel ya no alcanza</a></li>
                        <li><a href="#como-funciona">Cómo funciona junto con el Pixel</a></li>
                        <li><a href="#formas-de-implementarla">Formas de implementarla</a></li>
                        <li><a href="#crm-y-calidad">Del formulario a la venta: la API y tu CRM</a></li>
                        <li><a href="#errores-comunes">Errores comunes</a></li>
                        <li><a href="#por-industria">Cómo se ve esto en tu industria</a></li>
                        <li><a href="#como-medirlo">Cómo medirlo y qué esperar</a></li>
                        <li><a href="#faq">Preguntas frecuentes</a></li>
                    </ul>
                </div>

                <section id="que-es">
                    <h2>Qué es la API de Conversiones</h2>
                    <p>
                        Es una conexión directa entre tu servidor, tu plataforma web o tu CRM y Meta. Por ahí le mandas los eventos importantes de tu negocio, como un lead, una cita agendada o una venta, para que Meta los use para medir resultados, mejorar la segmentación y bajar tu costo por resultado.
                    </p>
                    <p>
                        La diferencia con el Pixel está en de dónde sale el dato. El Pixel es un código que corre en el navegador de quien visita tu sitio. La API manda el dato desde tu servidor. Piénsalo así: el Pixel es el encargado que cuenta a la gente que entra por la puerta; la API de Conversiones es tu libro de ventas. Los dos sirven, pero solo uno sabe quién terminó comprando.
                    </p>
                    <p>
                        Antes de conectarla conviene tener la cuenta ordenada, con los eventos y la estructura que describimos en <a href="/blog/como-estructurar-cuenta-meta-ads">cómo estructurar una cuenta de Meta Ads</a>.
                    </p>
                </section>

                <section id="por-que-no-alcanza-el-pixel">
                    <h2>Por qué el Pixel ya no alcanza</h2>
                    <p>
                        Durante años el Pixel fue suficiente. Hoy pierde eventos por varias razones que no controlas: navegadores que bloquean cookies y rastreadores, bloqueadores de anuncios, la función de privacidad de Apple que desde iOS 14 permite a los usuarios negarse al seguimiento entre aplicaciones, y conexiones lentas en las que el código no alcanza a cargar antes de que la persona se vaya.
                    </p>
                    <p>
                        Cada evento que se pierde es información que el algoritmo no recibe. Y el algoritmo de Meta aprende de lo que le mandas: si le llega solo una parte de tus leads, aprende con una muestra incompleta y te busca más personas parecidas a esa muestra, no a tus clientes reales.
                    </p>
                    <p>
                        Hay un segundo problema, más grande para un negocio de alto ticket: el Pixel solo ve lo que pasa en tu sitio. La venta de un departamento o de un sistema solar no ocurre en un formulario; ocurre semanas después, en una junta, en una visita, en un contrato. Eso el Pixel nunca lo va a ver.
                    </p>
                </section>

                <section id="como-funciona">
                    <h2>Cómo funciona junto con el Pixel</h2>
                    <p>
                        Meta recomienda una <strong>configuración redundante</strong>: mandar los mismos eventos por el Pixel y por la API al mismo tiempo. Si el navegador bloquea el Pixel, el servidor lo cubre. Si el servidor tarda, el Pixel ya avisó.
                    </p>
                    <p>
                        Para que eso no cuente doble, cada evento lleva un identificador. Cuando Meta recibe el mismo evento con el mismo nombre y el mismo identificador por las dos vías dentro de 48 horas, se queda con uno y descarta el otro. A eso se le llama <strong>deduplicación</strong>, y es el paso que más se hace mal.
                    </p>
                    <p>
                        El otro ingrediente es la información del cliente. Junto con cada evento mandas los datos que tengas del contacto, como correo, teléfono, nombre y los identificadores del navegador, cifrados antes de enviarlos. Con eso Meta relaciona el evento con una persona real. Qué tan bien lo logra se mide con la <strong>calidad de coincidencia de eventos</strong>, una calificación del 1 al 10 que ves en el Administrador de Eventos.
                    </p>
                </section>

                <section id="formas-de-implementarla">
                    <h2>Formas de implementarla</h2>
                    <ul>
                        <li><strong>Integración de una plataforma.</strong> Varias plataformas de tienda en línea y gestores de contenido tienen conexión oficial con Meta. Se activa desde su panel, sin escribir código. Es la vía más rápida si tu sitio vive en una de ellas.</li>
                        <li><strong>Puerta de enlace de Meta.</strong> Meta ofrece una opción que se instala con un asistente en tu propia nube y manda los eventos del Pixel también por servidor. Es un punto medio: no requiere programar, pero sí administrar ese servicio.</li>
                        <li><strong>Integración directa.</strong> Tu servidor manda los eventos a Meta con su propio código. Es la opción más flexible y la que necesitas si tu sitio está programado a mano o si quieres mandar eventos desde tu CRM.</li>
                    </ul>
                    <p>
                        En un sitio programado a mano, la forma más limpia es que el mismo código que guarda el formulario de contacto mande el evento de lead a Meta en ese momento, con el mismo identificador que dispara el Pixel en la página de gracias. Así la deduplicación queda resuelta desde el diseño.
                    </p>
                </section>

                <section id="crm-y-calidad">
                    <h2>Del formulario a la venta: la API y tu CRM</h2>
                    <p>
                        Aquí está el verdadero valor para un negocio de alto ticket. La API también recibe eventos que ocurren fuera de tu sitio: la cita confirmada, la visita a la oficina de ventas, el apartado, la venta. Mandarlos le enseña a Meta cuáles de tus leads se convierten en clientes.
                    </p>
                    <p>
                        Si usas los formularios instantáneos de Meta, existe una integración pensada para esto: conectas tu CRM, eliges la etapa de tu proceso que más te importa, por ejemplo "cita agendada", y Meta optimiza tus campañas para conseguir leads que lleguen a esa etapa, no solo formularios llenos. Su documentación pide al menos unos 200 leads al mes, subir los datos diario, guardar el identificador de cada lead y que la etapa elegida ocurra dentro de los 28 días siguientes.
                    </p>
                    <p>
                        Si todavía no llegas a ese volumen, igual conviene mandar tus ventas como eventos fuera de línea: te permiten medir qué campañas traen clientes de verdad y armar públicos con tus mejores compradores, la base de los <a href="/blog/publicos-personalizados-y-lookalike">públicos similares</a> que mejor funcionan.
                    </p>
                </section>

                <section id="errores-comunes">
                    <h2>Errores comunes</h2>
                    <p>
                        Ordenados por lo que más cuestan:
                    </p>
                    <ol>
                        <li><strong>No deduplicar.</strong> Cada lead se cuenta dos veces, tus reportes mienten a tu favor y el algoritmo aprende con datos inflados.</li>
                        <li><strong>Mandar eventos sin datos del cliente.</strong> Un evento sin correo ni teléfono casi no se puede relacionar con nadie. Meta incluso rechaza eventos que solo traen datos demasiado genéricos.</li>
                        <li><strong>Marcar como lead lo que no es un lead.</strong> Una visita a la página de contacto no es un prospecto. Si se lo reportas a Meta como tal, te va a traer más curiosos.</li>
                        <li><strong>Mandar datos sensibles.</strong> Detalles de salud, finanzas personales o información que tu aviso de privacidad no contempla no deben viajar en los eventos. Revisa tu aviso de privacidad con tu abogado antes de conectar el CRM.</li>
                        <li><strong>Instalarla y no revisarla.</strong> Un cambio en el formulario o en el servidor puede romper el envío sin que nadie se entere. Revisa el Administrador de Eventos cada semana.</li>
                    </ol>
                </section>

                <section id="por-industria">
                    <h2>Cómo se ve esto en tu industria</h2>

                    <h3>Desarrolladoras inmobiliarias</h3>
                    <p>
                        Las etapas que vale la pena mandar son cita agendada, visita al desarrollo o al departamento muestra, apartado y firma. Optimizar hacia la visita, en lugar del formulario, suele cambiar por completo el tipo de lead que llega. La estrategia de campañas está en <a href="/blog/facebook-ads-para-inmobiliarias">Facebook Ads para inmobiliarias</a>.
                    </p>

                    <h3>Empresas de energía solar</h3>
                    <p>
                        Visita técnica, cotización entregada e instalación firmada. Como el ciclo puede ser largo, la visita técnica suele ser la mejor etapa para optimizar: ocurre dentro de la ventana y ya filtra a los curiosos. Lo complementa <a href="/blog/facebook-ads-para-energia-solar">Facebook Ads para energía solar</a>.
                    </p>

                    <h3>Clínicas y consultorios</h3>
                    <p>
                        Aquí la regla es la prudencia: manda que hubo una cita, nunca el motivo de consulta ni el tratamiento. Meta restringe el uso de información de salud, y tus pacientes también esperan que no viaje a ningún lado. El evento "cita agendada" sin más detalle basta para optimizar.
                    </p>

                    <h3>Despachos y servicios B2B</h3>
                    <p>
                        Ciclos largos y pocas ventas. Normalmente no llegas al volumen para optimizar con el CRM, pero sí te conviene mandar las propuestas aceptadas como eventos fuera de línea para saber qué campañas generan negocio y construir públicos con tus mejores clientes.
                    </p>
                </section>

                <section id="como-medirlo">
                    <h2>Cómo medirlo y qué esperar</h2>
                    <p>
                        En el Administrador de Eventos revisa tres cosas: que cada evento llegue por navegador y por servidor, que aparezca como deduplicado y la calificación de calidad de coincidencia. Después compara los leads que reporta Meta contra los de tu CRM: la diferencia entre los dos debería achicarse.
                    </p>
                    <p>
                        El efecto en campañas no es inmediato. Meta necesita unas semanas con datos más completos para ajustar a quién le muestra tus anuncios, y su propia documentación estima alrededor de un mes para ver el valor de la optimización con el CRM. La métrica que importa al final no es el costo por lead, sino el costo por cita o por venta. Para leer esas cifras sin perderte, revisa <a href="/blog/como-leer-ads-manager">cómo leer el Ads Manager</a>.
                    </p>
                </section>

                <!-- Servicio relacionado (enlace interno a la página de servicio) -->
                <div class="post-flova-servicio">
                    <p class="post-flova-servicio-etiqueta">Servicio relacionado · Facebook Ads</p>
                    <p>
                        Conectar la API bien es tanto tarea técnica como de proceso comercial. En nuestra <a href="/facebook">implementación de la API de Conversiones y gestión de Meta Ads</a> configuramos el envío desde tu sitio o tu CRM, revisamos que no haya duplicados y definimos contigo qué etapa de tu venta le conviene optimizar a Meta.
                    </p>
                </div>

                <!-- FAQ -->
                <section id="faq" class="post-flova-faq">
                    <h2>Preguntas frecuentes</h2>

                    <details>
                        <summary>¿La API de Conversiones reemplaza al Pixel de Meta?</summary>
                        <p>No. Meta recomienda usar los dos al mismo tiempo, en lo que llama una configuración redundante: el Pixel manda los eventos desde el navegador del visitante y la API los manda desde tu servidor. Si uno de los dos pierde un evento, el otro lo cubre.</p>
                        <p>El Pixel sigue siendo útil para lo que pasa dentro de tu sitio en tiempo real, y la API es la única forma de mandar lo que pasa después y fuera del sitio: la cita que se agendó por teléfono, el apartado que se firmó en la oficina de ventas. Juntos le dan a Meta una imagen mucho más completa que cualquiera de los dos por separado.</p>
                    </details>

                    <details>
                        <summary>¿Necesito un programador para instalar la API de Conversiones?</summary>
                        <p>Depende de tu plataforma. Si tu sitio está en una plataforma con integración oficial de Meta, como varias tiendas en línea y gestores de contenido populares, la conexión se activa en unos cuantos pasos sin escribir código. Meta también ofrece una puerta de enlace que se instala en tu propia nube con un asistente.</p>
                        <p>Si tu sitio está programado a mano o quieres mandar eventos desde tu CRM, sí necesitas a alguien técnico, porque los eventos se envían desde tu servidor con la información del cliente cifrada. No es un proyecto enorme, pero conviene hacerlo bien desde el principio: un evento mal configurado puede contar doble o mandar datos incompletos.</p>
                    </details>

                    <details>
                        <summary>¿Qué es la calidad de coincidencia de eventos?</summary>
                        <p>Es una calificación del 1 al 10 que Meta te muestra en el Administrador de Eventos para tus eventos web. Mide qué tan bien puede relacionar cada evento que le mandas con una persona real en Facebook o Instagram, según la información del cliente que incluyas: correo, teléfono, nombre y los identificadores del navegador.</p>
                        <p>Entre más alta, mejor puede Meta atribuir tus resultados y encontrar a personas parecidas a tus clientes. Para subirla, manda todos los datos que tengas de cada contacto, cifrados como pide Meta, y no solo uno. Un formulario que ya pide correo y teléfono te da casi todo lo necesario.</p>
                    </details>

                    <details>
                        <summary>¿Cómo evito que se dupliquen los eventos entre el Pixel y la API?</summary>
                        <p>Mandando el mismo identificador de evento y el mismo nombre de evento desde los dos lados. Cuando Meta recibe dos eventos con el mismo nombre y el mismo identificador dentro de 48 horas, se queda con uno y descarta el otro.</p>
                        <p>Si no lo haces, cada lead se cuenta dos veces: tus reportes se ven el doble de buenos y el algoritmo aprende con datos inflados. Antes de dar por terminada la instalación, usa la herramienta de prueba de eventos de Meta y confirma que los eventos aparecen como deduplicados.</p>
                    </details>

                    <details>
                        <summary>¿Sirve la API de Conversiones si uso formularios de Meta para captar leads?</summary>
                        <p>Sí, y es de los usos más valiosos para un negocio de alto ticket. Meta tiene una forma de conectar tu CRM para mandarle de regreso qué leads de sus formularios avanzaron en tu proceso de venta, y así optimizar tus campañas hacia leads de calidad en lugar de solo más formularios llenos.</p>
                        <p>Tiene requisitos: según su documentación, necesitas al menos unos 200 leads al mes, subir los datos al menos una vez al día, guardar el identificador de cada lead en tu CRM y que la etapa que eliges para optimizar ocurra dentro de los 28 días siguientes al lead. Si no llegas a ese volumen, todavía te conviene mandar tus ventas como eventos fuera de línea para medir mejor.</p>
                    </details>
                </section>

                <!-- Tarjeta "Lo que deberías hacer ahora" -->
                <div class="post-flova-siguiente-paso">
                    <h3>Lo que deberías hacer ahora</h3>
                    <p>
                        Abre el Administrador de Eventos de Meta, elige tu evento de lead y revisa de dónde llega: si solo dice navegador, no tienes la API conectada. Después compara los leads de los últimos 30 días contra los de tu CRM. Si la diferencia es grande, ya sabes cuánto le estás escondiendo al algoritmo. Si quieres seguir aprendiendo, descarga nuestras <a href="/ebook-facebook">guías de Marketing Digital</a>.
                    </p>

                    <form class="cta-form">
                        <input type="email" placeholder="Ingresa tu correo...">
                        <button type="submit">¡Aquí!</button>
                    </form>
                </div>

                <details class="post-flova-fuentes">
                    <summary>Ver las fuentes consultadas en este artículo</summary>
                    <ol>
                        <li><a href="https://developers.facebook.com/docs/marketing-api/conversions-api" target="_blank" rel="noopener noreferrer">Meta for Developers: qué es la API de Conversiones y qué datos recibe</a></li>
                        <li><a href="https://developers.facebook.com/docs/marketing-api/conversions-api/deduplicate-pixel-and-server-events" target="_blank" rel="noopener noreferrer">Meta for Developers: configuración redundante y deduplicación de eventos</a></li>
                        <li><a href="https://developers.facebook.com/docs/marketing-api/conversions-api/best-practices" target="_blank" rel="noopener noreferrer">Meta for Developers: buenas prácticas, datos del cliente y calidad de coincidencia</a></li>
                        <li><a href="https://developers.facebook.com/docs/marketing-api/conversions-api/conversion-leads-integration" target="_blank" rel="noopener noreferrer">Meta for Developers: integración del CRM para optimizar por calidad de lead</a></li>
                    </ol>
                </details>

            </article>

            <!-- SIDEBAR -->
            <aside class="post-flova-sidebar">
                <nav class="post-flova-toc" id="tocLateral">
                    <p class="post-flova-sidebar-titulo">En esta guía</p>
                    <ul>
                        <li><a href="#que-es">Qué es</a></li>
                        <li><a href="#por-que-no-alcanza-el-pixel">Por qué no alcanza el Pixel</a></li>
                        <li><a href="#como-funciona">Cómo funciona</a></li>
                        <li><a href="#formas-de-implementarla">Cómo implementarla</a></li>
                        <li><a href="#crm-y-calidad">API y CRM</a></li>
                        <li><a href="#errores-comunes">Errores comunes</a></li>
                        <li><a href="#por-industria">Por industria</a></li>
                        <li><a href="#como-medirlo">Cómo medirlo</a></li>
                        <li><a href="#faq">Preguntas frecuentes</a></li>
                    </ul>
                </nav>

                <div class="post-flova-ficha">
                    <p class="post-flova-sidebar-titulo">Ficha rápida</p>
                    <div class="post-flova-ficha-dato">
                        <span>De dónde salen los eventos</span>
                        <strong>Tu servidor o tu CRM</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>Configuración que recomienda Meta</span>
                        <strong>Pixel + API, en paralelo</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>Ventana para eliminar duplicados</span>
                        <strong>48 horas</strong>
                    </div>
                    <div class="post-flova-ficha-dato">
                        <span>Mínimo para optimizar con tu CRM</span>
                        <strong>200 leads al mes</strong>
                    </div>
                </div>

                <div class="post-flova-cta-sidebar">
                    <p>¿Quieres saber cuántas conversiones está perdiendo tu Pixel?</p>
                    <a href="/agenda">Agenda una sesión gratuita</a>
                </div>
            </aside>

        </div>

        <!-- CTA FINAL -->
        <div class="post-flova-cta-final">
            <div class="post-flova-cta-final-inner">
                <h2>Si Meta no ve tus ventas, no puede encontrarte más clientes</h2>
                <p>Agenda una sesión gratuita de 20 minutos y te decimos, sin compromiso,<br>qué tan completa está la información que recibe Meta de tu negocio.</p>

                <div class="botonAgenda">
                    <button onclick="
                        document.cookie = 'preferred_language=es; path=/; max-age=31536000;';
                        window.location.href = '/agenda';">
                        <strong>AGENDA TU SESIÓN GRATUITA DE 20 MINUTOS</strong>
                    </button>
                </div>
                <p class="textoAgenda">
                    ¡Date prisa! ¡Quedan pocas sesiones GRATIS de estrategia para Octubre!
                </p>
            </div>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/componentes/footer-blog.php'; ?>

</body>

</html>
