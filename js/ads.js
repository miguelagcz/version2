document.addEventListener('DOMContentLoaded', function () {
    // ==============================
    // 1. ANIMACIÓN DE SECCIONES (LÓGICA CORREGIDA)
    // ==============================
    
    // Seleccionamos TODAS las secciones (padres e hijas)
    const todasLasSecciones = document.querySelectorAll("section");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    todasLasSecciones.forEach(seccion => {
        // CORRECCIÓN CRÍTICA:
        // Verificamos si la sección ES un rombo/flecha O si vive DENTRO de uno
        const esBloqueFijo = seccion.matches('.rombo, .flechon') || seccion.closest('.rombo, .flechon');

        if (esBloqueFijo) {
            // SI ES UN BLOQUE FIJO O ESTÁ DENTRO DE UNO:
            // 1. Le damos la clase visible de inmediato
            seccion.classList.add("visible");
            
            // 2. Forzamos los estilos inline para "matar" cualquier animación CSS residual
            seccion.style.opacity = "1";
            seccion.style.transform = "none";
            seccion.style.transition = "none"; 
            
            // 3. NO lo observamos (el observer jamás tocará esto)
        } else {
            // SI ES UNA SECCIÓN NORMAL:
            // Aplicamos la lógica de animación estándar
            seccion.classList.remove("visible");
            observer.observe(seccion);
        }
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
    // 3. CÓDIGO DEL EFECTO CASCADA (TESTIMONIOS)
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

    // Iniciar animaciones de testimonios
    testimonialColumns.forEach(column => {
        column.scroller.style.transition = 'transform 0.5s ease';
        column.animationId = requestAnimationFrame(ts => scrollTestimonial(column, ts));
    });

    // =============================================
    // 4. CÓDIGO DEL CARRUSEL DE PORTFOLIO (SI EXISTE)
    // =============================================
    const portfolioScrollerConfig = {
        scrollSpeed: 0.8,
        scrollers: [
            { id: 'scroller-arriba', direction: 'right' },
            { id: 'scroller-abajo', direction: 'left' }
        ]
    };

    portfolioScrollerConfig.scrollers.forEach(config => {
        const scroller = document.getElementById(config.id);
        if (!scroller) return;

        const items = Array.from(scroller.querySelectorAll('.portfolio-item'));
        if (items.length === 0) return;

        const gap = parseFloat(getComputedStyle(scroller).gap) || 0;
        const totalWidth = items.reduce((acc, item) => acc + item.offsetWidth + gap, 0);

        scroller.innerHTML += scroller.innerHTML;

        let currentPosition = 0;
        let isPaused = false;

        if (config.direction === 'right') {
            currentPosition = -totalWidth;
            scroller.style.transform = `translateX(${currentPosition}px)`;
        }

        scroller.addEventListener('mouseenter', () => isPaused = true);
        scroller.addEventListener('mouseleave', () => isPaused = false);

        function animateScroll() {
            if (!isPaused) {
                if (config.direction === 'left') {
                    currentPosition -= portfolioScrollerConfig.scrollSpeed;
                    if (Math.abs(currentPosition) >= totalWidth) {
                        currentPosition = 0;
                    }
                } else {
                    currentPosition += portfolioScrollerConfig.scrollSpeed;
                    if (currentPosition >= 0) {
                        currentPosition = -totalWidth;
                    }
                }
                scroller.style.transform = `translateX(${currentPosition}px)`;
            }
            requestAnimationFrame(animateScroll);
        }

        requestAnimationFrame(animateScroll);
    });

    // =============================================
    // 5. MODALES (PREGUNTAS FRECUENTES)
    // =============================================
    function toggleModal(button, modalId) {
        document.querySelectorAll('.modal-container.show').forEach(modal => {
            if (modal.id !== modalId) {
                modal.classList.remove('show');
                const icon = modal.previousElementSibling.querySelector('.toggle-icon');
                if (icon) icon.classList.replace('fa-minus', 'fa-plus');
            }
        });

        const modal = document.getElementById(modalId);
        const icon = button.querySelector('.toggle-icon');

        if (modal) modal.classList.toggle('show');
        
        if (icon) {
            icon.classList.toggle('fa-minus');
            icon.classList.toggle('fa-plus');
        }
    }

    document.querySelectorAll('.btn-read-more').forEach(btn => {
        const id = btn.id.replace('open', '');
        btn.addEventListener('click', () => toggleModal(btn, 'modal_container' + id));
    });


    // =============================================
    // 7. POP-UP (DESCARGA GUÍA)
    // =============================================
    const botonesAbrirPopup = document.querySelectorAll('.botonAgenda2 button, #show-popup-button');
    const popupOverlay = document.getElementById('popup-overlay');
    const popupModal = document.getElementById('popup-modal');
    const popupClose = document.getElementById('popup-close');
    const popupForm = document.getElementById('popup-form');
    const body = document.body;

    function abrirPopup(event) {
        if (event) event.preventDefault();
        if(popupOverlay && popupModal) {
            popupOverlay.classList.add('visible');
            popupModal.classList.add('visible');
            body.classList.add('popup-abierto');
        }
    }

    function cerrarPopup() {
        if(popupOverlay && popupModal) {
            popupOverlay.classList.remove('visible');
            popupModal.classList.remove('visible');
            body.classList.remove('popup-abierto');
        }
    }

    botonesAbrirPopup.forEach(boton => {
        boton.addEventListener('click', abrirPopup);
    });

    if (popupClose) {
        popupClose.addEventListener('click', cerrarPopup);
    }

    if (popupOverlay) {
        popupOverlay.addEventListener('click', cerrarPopup);
    }

    if (popupForm) {
        popupForm.addEventListener('submit', function (event) {
            event.preventDefault();
            cerrarPopup();
        });
    }

    // =============================================
    // 8. MENÚ HAMBURGUESA (OVERLAY)
    // =============================================
    const menuToggle = document.getElementById('menuToggle');
    const menuOverlay = document.getElementById('menuOverlay');

    if (menuToggle && menuOverlay) {
        menuToggle.addEventListener('click', () => {
            const isActive = menuToggle.classList.toggle('active');
            menuOverlay.classList.toggle('show');

            if (isActive) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });

        menuOverlay.addEventListener('click', (e) => {
            if (e.target === menuOverlay) {
                menuOverlay.classList.remove('show');
                menuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Cerrar menú al hacer clic en enlaces internos
    document.querySelectorAll('.menu-desplegado a').forEach(link => {
        link.addEventListener('click', () => {
            if (menuOverlay) menuOverlay.classList.remove('show');
            if (menuToggle) menuToggle.classList.remove('active');
            document.body.style.overflow = '';
        });
    });

    // =============================================
    // 9. ACTIVADOR DE LA FLECHA SVG (NUEVO)
    // =============================================
    const seccionProceso = document.querySelector('.contenedorProceso');
    const svgAnimado = document.querySelector('.fondo-svg-animado');

    if (seccionProceso && svgAnimado) {
        const observerFlecha = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Agrega la clase que inicia la animación CSS
                    svgAnimado.classList.add('animar-rutas');
                    // Desconectamos para que solo se anime una vez
                    observerFlecha.disconnect(); 
                }
            });
        }, { threshold: 0.3 }); // Se activa cuando el 30% de la sección es visible
        
        observerFlecha.observe(seccionProceso);
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