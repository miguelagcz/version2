document.addEventListener('DOMContentLoaded', function () {
    // ==============================
    // NUEVO: Animación de todos los <section> desde la izquierda
    // ==============================
    const secciones = document.querySelectorAll("section");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    secciones.forEach(seccion => {
        seccion.classList.remove("visible"); // por si acaso, las oculta al inicio
        observer.observe(seccion);
    });

// =============================================
    // 2. CÓDIGO DEL MENÚ HAMBURGUESA (SCROLL) - CORREGIDO
    // =============================================
    let lastScrollTop = 0;
    const header = document.querySelector("header");
    // Referencia al botón toggle para verificar si está activo
    const toggleParaScroll = document.getElementById('menuToggle'); 

    window.addEventListener("scroll", function () {
        // CORRECCIÓN: Si el menú está abierto, no hacemos nada.
        // Esto evita que el header se oculte llevándose el botón "X".
        if (toggleParaScroll && toggleParaScroll.classList.contains('active')) {
            return;
        }

        let scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // scroll hacia abajo
            header.classList.add("headerOculto");
        } else {
            // scroll hacia arriba
            header.classList.remove("headerOculto");
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // =============================================
    // 2. CAMBIO DE IDIOMA (language selector nosotros)
    // =============================================
    const langSelectUs = document.getElementById('languageSelectUs');
    if (langSelectUs) {
        langSelectUs.addEventListener('change', function () {
            const selectedLanguageUs = this.value;
            if (selectedLanguageUs === 'en') {
                window.location.href = '/en/Opt-In.html';
            } else if (selectedLanguageUs === 'es') {
                window.location.href = '/es/Opt-In.html';
            }
        });
    }

    // =============================================
    // 3. CAMBIO DE IDIOMA (language selector terminosUso)
    // =============================================
    const langSelectTerminos = document.getElementById('languageSelectTerminos');
    if (langSelectTerminos) {
        langSelectTerminos.addEventListener('change', function () {
            const selectedLanguageTerminos = this.value;
            if (selectedLanguageTerminos === 'en') {
                window.location.href = '/en/terminos-de-uso.html';
            } else if (selectedLanguageTerminos === 'es') {
                window.location.href = '/es/terminos-de-uso.html';
            }
        });
    }

    // =============================================
    // 4. CAMBIO DE IDIOMA (language selector terminosPoli)
    // =============================================
    const langSelectPoli = document.getElementById('languageSelectPoli');
    if (langSelectPoli) {
        langSelectPoli.addEventListener('change', function () {
            const selectedLanguagePoli = this.value;
            if (selectedLanguagePoli === 'en') {
                window.location.href = '/en/politicas-de-privacidad.html';
            } else if (selectedLanguagePoli === 'es') {
                window.location.href = '/es/politicas-de-privacidad.html';
            }
        });
    }

    // =============================================
    // 5. CONTADOR DE 24 HORAS (contador 1)
    // =============================================
    function actualizarContador() {
        const ahora = new Date();
        const siguienteDia = new Date(ahora);
        siguienteDia.setHours(24, 0, 0, 0);

        const diff = siguienteDia - ahora;
        let horas = Math.floor((diff / (1000 * 60 * 60)) % 24);
        let minutos = Math.floor((diff / (1000 * 60)) % 60);
        let segundos = Math.floor((diff / 1000) % 60);

        const mostrarPuntos = segundos % 2 === 0 ? ":" : "<span class='parpadeo'>:</span>";

        document.getElementById("contador").innerHTML =
            `${String(horas).padStart(2, "0")}${mostrarPuntos}${String(minutos).padStart(2, "0")}${mostrarPuntos}${String(segundos).padStart(2, "0")}`;
    }
    setInterval(actualizarContador, 1000);
    actualizarContador();

    // =============================================
    // 6. CONTADOR DE 24 HORAS (contador 2)
    // =============================================
    function actualizarContador2() {
        const ahora = new Date();
        const siguienteDia = new Date(ahora);
        siguienteDia.setHours(24, 0, 0, 0);

        const diff = siguienteDia - ahora;
        let horas = Math.floor((diff / (1000 * 60 * 60)) % 24);
        let minutos = Math.floor((diff / (1000 * 60)) % 60);
        let segundos = Math.floor((diff / 1000) % 60);

        const mostrarPuntos = segundos % 2 === 0 ? ":" : "<span class='parpadeo2'>:</span>";

        document.getElementById("contador2").innerHTML =
            `${String(horas).padStart(2, "0")}${mostrarPuntos}${String(minutos).padStart(2, "0")}${mostrarPuntos}${String(segundos).padStart(2, "0")}`;
    }
    setInterval(actualizarContador2, 1000);
    actualizarContador2();


    // =============================================
    // 7. CÓDIGO DEL POP-UP (NUEVO)
    // =============================================
    
    // Seleccionar todos los botones que deben abrir el pop-up
    // (los 3 botones de "Mándame mi guía")
    const botonesAbrirPopup = document.querySelectorAll('.botonAgenda button');
    
    // Seleccionar los elementos del pop-up
    const popupOverlay = document.getElementById('popup-overlay');
    const popupModal = document.getElementById('popup-modal');
    const popupClose = document.getElementById('popup-close');
    const popupForm = document.getElementById('popup-form');
    const body = document.body;

    // Función para abrir el pop-up
    function abrirPopup(event) {
        event.preventDefault(); // Prevenir cualquier acción default del botón
        popupOverlay.classList.add('visible');
        popupModal.classList.add('visible');
        body.classList.add('popup-abierto'); // <-- ESTO BLOQUEA EL SCROLL
    }

    // Función para cerrar el pop-up
    function cerrarPopup() {
        popupOverlay.classList.remove('visible');
        popupModal.classList.remove('visible');
        body.classList.remove('popup-abierto'); // <-- ESTO DESBLOQUEA EL SCROLL
    }

    // 1. Asignar evento a TODOS los botones de "Mándame mi guía"
    botonesAbrirPopup.forEach(boton => {
        boton.addEventListener('click', abrirPopup);
    });

    // 2. Asignar evento al botón de cerrar (la 'X')
    if (popupClose) {
        popupClose.addEventListener('click', cerrarPopup);
    }

    // 3. Asignar evento al overlay (cerrar al hacer clic afuera)
    if (popupOverlay) {
        popupOverlay.addEventListener('click', cerrarPopup);
    }

    // 4. Manejar el envío del formulario
    if (popupForm) {
        popupForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir envío real para este ejemplo
            
            // Aquí iría tu código para enviar los datos (ej. a un CRM, Mailchimp, etc.)
            
            // Por ahora, solo mostramos una alerta y cerramos
            alert('¡Gracias! Tu guía será enviada a tu correo.');
            cerrarPopup();
        });
    }
    
     // =============================================
    // TEXTO AUTOMÁTICO CON MES ACTUAL (MULTIPLE)
    // =============================================
    function actualizarTextoMes() {
        const ahora = new Date();

        const meses = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];

        const mesActual = meses[ahora.getMonth()];

        document.querySelectorAll(".textoAgenda").forEach(p => {
            p.innerHTML = `¡Date prisa! ¡Quedan pocas sesiones GRATIS de estrategia para ${mesActual}!`;
        });
    }

    actualizarTextoMes();

});