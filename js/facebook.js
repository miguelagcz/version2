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
    // 2. CÓDIGO DEL EFECTO CASCADA (TESTIMONIOS)
    // =============================================
    const testimonialConfig = {
        scrollSpeed: 0.8,
        columns: [
            { id: 'leftColumn', scroller: 'leftScroller' },
            { id: 'rightColumn', scroller: 'rightScroller' }
        ]
    };

    const testimonialColumns = testimonialConfig.columns.map(col => {
        const container = document.getElementById(col.id);
        const scroller = document.getElementById(col.scroller);

        if (!container || !scroller) return null;

        const testimonials = scroller.querySelectorAll('.testimonial');
        const totalHeight = Array.from(testimonials).reduce((acc, t) =>
            acc + t.offsetHeight + 24, 0);

        // Duplicar contenido para efecto infinito
        scroller.innerHTML += scroller.innerHTML;

        return {
            container,
            scroller,
            totalHeight,
            currentPosition: 0,
            animationId: null,
            lastTimestamp: 0
        };
    }).filter(Boolean);

    function scrollTestimonial(column, timestamp) {
        if (!column.lastTimestamp) column.lastTimestamp = timestamp;
        const delta = timestamp - column.lastTimestamp;
        column.lastTimestamp = timestamp;

        column.currentPosition -= testimonialConfig.scrollSpeed * (delta / 16);

        if (Math.abs(column.currentPosition) >= column.totalHeight) {
            column.currentPosition = 0;
            column.scroller.style.transition = 'none';
            column.scroller.style.transform = `translateY(0)`;
            void column.scroller.offsetWidth; // Forzar reflow
        }

        column.scroller.style.transform = `translateY(${column.currentPosition}px)`;
        column.animationId = requestAnimationFrame(ts => scrollTestimonial(column, ts));
    }

    // Iniciar animaciones
    testimonialColumns.forEach(column => {
        column.scroller.style.transition = 'transform 0.5s ease';
        column.animationId = requestAnimationFrame(ts => scrollTestimonial(column, ts));
    });

    // 3. CÓDIGO DE MODALES (versión con +/- y cierre automático)
    // =============================================
    function toggleModal(button, modalId) {
        // Cerrar todas las preguntas abiertas primero
        document.querySelectorAll('.modal-container.show').forEach(modal => {
            if (modal.id !== modalId) {
                modal.classList.remove('show');
                const icon = modal.previousElementSibling.querySelector('.toggle-icon');
                icon.classList.replace('fa-minus', 'fa-plus');
            }
        });

        // Abrir/cerrar la pregunta actual
        const modal = document.getElementById(modalId);
        const icon = button.querySelector('.toggle-icon');

        modal.classList.toggle('show');
        icon.classList.toggle('fa-minus');
        icon.classList.toggle('fa-plus');
    }

    document.querySelectorAll('.btn-read-more').forEach(btn => {
        const id = btn.id.replace('open', '');
        btn.addEventListener('click', () => toggleModal(btn, 'modal_container' + id));
    });

    // =============================================
    // 4. CAMBIO DE IDIOMA (language selector)
    // =============================================
    const langSelect = document.getElementById('languageSelect');
    if (langSelect) {
        langSelect.addEventListener('change', function () {
            const selectedLanguage = this.value;
            if (selectedLanguage === 'en') {
                window.location.href = '/en/index.html';
            } else if (selectedLanguage === 'es') {
                window.location.href = '/es/index.html';
            }
        });
    }

    // =============================================
    // 7. CÓDIGO DEL POP-UP (NUEVO)
    // =============================================

    // Seleccionar todos los botones que deben abrir el pop-up
    // (los 3 botones de "Mándame mi guía")
    const botonesAbrirPopup = document.querySelectorAll('.botonAgenda2 button');

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
        popupForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevenir envío real para este ejemplo

            // Aquí iría tu código para enviar los datos (ej. a un CRM, Mailchimp, etc.)

            // Por ahora, solo mostramos una alerta y cerramos
            alert('¡Gracias! Tu guía será enviada a tu correo.');
            cerrarPopup();
        });
    }

    // =============================================
    // MENÚ HAMBURGUESA (OVERLAY PANTALLA COMPLETA + BLOQUEO DE SCROLL)
    // =============================================
    const menuToggle = document.getElementById('menuToggle');
    const menuOverlay = document.getElementById('menuOverlay');

    if (menuToggle && menuOverlay) {
        menuToggle.addEventListener('click', () => {
            const isActive = menuToggle.classList.toggle('active');
            menuOverlay.classList.toggle('show');

            // 🔒 Bloquear scroll cuando el menú esté abierto
            if (isActive) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        // Cerrar al hacer clic fuera del contenido del menú
        menuOverlay.addEventListener('click', (e) => {
            if (e.target === menuOverlay) {
                menuOverlay.classList.remove('show');
                menuToggle.classList.remove('active');
                document.body.style.overflow = ''; // 🔓 Desbloquear scroll
            }
        });
    }

    // 🆕 NUEVO: Cerrar menú al hacer clic en enlaces internos (#)
    document.querySelectorAll('.menu-desplegado a[href^="#"]').forEach(link => {
        link.addEventListener('click', () => {
            menuOverlay.classList.remove('show');
            menuToggle.classList.remove('active');
            document.body.style.overflow = ''; // Desbloquear scroll
        });
    });
    
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