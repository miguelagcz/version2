document.addEventListener('DOMContentLoaded', function () {
    const secciones = document.querySelectorAll("section:not(.sinAnimacion), .animarEntrada");

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0, rootMargin: '0px 0px -10% 0px' });

    secciones.forEach(seccion => {
        seccion.classList.remove("visible"); // por si acaso, las oculta al inicio
        observer.observe(seccion);
    });


    const pistaOriginal = document.querySelector('.carruselLogos:not([data-repetir-logos]) .pistaLogos');
    if (pistaOriginal) {
        document.querySelectorAll('.carruselLogos[data-repetir-logos] .pistaLogos').forEach(pista => {
            pista.innerHTML = pistaOriginal.innerHTML;
        });
    }

    document.querySelectorAll('.carruselLogos .pistaLogos').forEach(pista => {
        Array.from(pista.children).forEach(logo => {
            const copia = logo.cloneNode(true);
            copia.setAttribute('aria-hidden', 'true');
            copia.querySelectorAll('img').forEach(img => img.setAttribute('alt', ''));
            pista.appendChild(copia);
        });
    });


    // ==============================
    // Resultados: los números cuentan hacia arriba y la barra de meta se llena
    // cuando la sección aparece en pantalla. Sin JavaScript se ven los valores finales.
    // ==============================
    const sinMovimiento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const numerosContador = document.querySelectorAll('[data-contar]');
    const barrasMeta = document.querySelectorAll('.metaBarra');

    if (!sinMovimiento && 'IntersectionObserver' in window) {
        const formatear = (valor, decimales) => new Intl.NumberFormat('es-MX', {
            minimumFractionDigits: decimales,
            maximumFractionDigits: decimales
        }).format(valor);

        const textoCifra = (el, valor) => {
            const decimales = parseInt(el.dataset.decimales || '0', 10);
            return (el.dataset.prefijo || '') + formatear(valor, decimales) + (el.dataset.sufijo || '');
        };

        function contar(el) {
            const final = parseFloat(el.dataset.contar);
            const duracion = 1800;
            // Reserva el ancho final para que nada se mueva mientras cuenta
            el.textContent = textoCifra(el, final);
            el.style.minWidth = el.getBoundingClientRect().width + 'px';
            let inicio = null;

            function paso(tiempo) {
                if (inicio === null) inicio = tiempo;
                const avance = Math.min((tiempo - inicio) / duracion, 1);
                const suavizado = 1 - Math.pow(1 - avance, 3);
                el.textContent = textoCifra(el, final * suavizado);
                if (avance < 1) {
                    requestAnimationFrame(paso);
                } else {
                    el.textContent = textoCifra(el, final);
                    el.style.minWidth = '';
                }
            }
            requestAnimationFrame(paso);
        }

        function llenarBarra(barra) {
            const actual = parseFloat(barra.getAttribute('aria-valuenow'));
            const meta = parseFloat(barra.getAttribute('aria-valuemax'));
            const relleno = barra.querySelector('.metaRelleno');
            if (relleno && meta > 0) {
                relleno.style.width = Math.min(actual / meta * 100, 100) + '%';
            }
        }

        // Estado inicial: en cero, listos para animar
        numerosContador.forEach(el => { el.textContent = textoCifra(el, 0); });
        barrasMeta.forEach(barra => {
            const relleno = barra.querySelector('.metaRelleno');
            if (relleno) relleno.style.width = '0%';
        });

        const observadorResultados = new IntersectionObserver((entradas, obs) => {
            entradas.forEach(entrada => {
                if (!entrada.isIntersecting) return;
                const el = entrada.target;
                if (el.hasAttribute('data-contar')) contar(el);
                else llenarBarra(el);
                obs.unobserve(el);
            });
        }, { threshold: 0.6 });

        numerosContador.forEach(el => observadorResultados.observe(el));
        barrasMeta.forEach(barra => observadorResultados.observe(barra));
    }


    let lastScrollTop = 0;
    const header = document.querySelector("header");
    // Referencia al botón toggle para verificar si está activo
    const toggleParaScroll = document.getElementById('menuToggle'); 

    window.addEventListener("scroll", function () {

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

        // Duplicar contenido para efecto infinito
        scroller.innerHTML += scroller.innerHTML;

        return {
            container,
            scroller,
            totalHeight: scroller.offsetHeight / 2,
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


    window.addEventListener('resize', () => {
        testimonialColumns.forEach(column => {
            column.totalHeight = column.scroller.offsetHeight / 2;
        });
    });

    // Iniciar animaciones
    testimonialColumns.forEach(column => {
        column.scroller.style.transition = 'transform 0.5s ease';
        column.animationId = requestAnimationFrame(ts => scrollTestimonial(column, ts));
    });


    const portfolioScrollerConfig = {
        scrollSpeed: 0.8, // Velocidad del scroll (más alto = más rápido)
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

        // Calcular el ancho total de una sola vuelta
        const gap = parseFloat(getComputedStyle(scroller).gap) || 0;
        const totalWidth = items.reduce((acc, item) => acc + item.offsetWidth + gap, 0);

        // Duplicar contenido para loop infinito (igual que en tu carrusel de testimonios)
        scroller.innerHTML += scroller.innerHTML;

        let currentPosition = 0;
        let isPaused = false;

        // Para el scroll a la DERECHA, empezamos desde la mitad (negativo)
        if (config.direction === 'right') {
            currentPosition = -totalWidth;
            scroller.style.transform = `translateX(${currentPosition}px)`;
        }

        scroller.addEventListener('mouseenter', () => isPaused = true);
        scroller.addEventListener('mouseleave', () => isPaused = false);

        function animateScroll() {
            if (!isPaused) {
                if (config.direction === 'left') {
                    // Mover a la izquierda
                    currentPosition -= portfolioScrollerConfig.scrollSpeed;
                    if (Math.abs(currentPosition) >= totalWidth) {
                        currentPosition = 0; // Reset
                    }
                } else {
                    // Mover a la derecha
                    currentPosition += portfolioScrollerConfig.scrollSpeed;
                    if (currentPosition >= 0) {
                        currentPosition = -totalWidth; // Reset
                    }
                }
                scroller.style.transform = `translateX(${currentPosition}px)`;
            }
            requestAnimationFrame(animateScroll);
        }

        requestAnimationFrame(animateScroll);
    });


    function toggleModal(button, modalId) {
        // Cerrar todas las preguntas abiertas primero
        document.querySelectorAll('.modal-container.show').forEach(modal => {
            if (modal.id !== modalId) {
                modal.classList.remove('show');
                const icon = modal.previousElementSibling.querySelector('.toggle-icon');
                icon.classList.replace('fa-minus', 'fa-plus');
            }
        });

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

    const menuToggle = document.getElementById('menuToggle');
    const menuOverlay = document.getElementById('menuOverlay');
    let scrollGuardado = 0;


    function bloquearScroll() {
        scrollGuardado = window.scrollY || document.documentElement.scrollTop;
        document.body.style.position = 'fixed';
        document.body.style.top = '-' + scrollGuardado + 'px';
        document.body.style.width = '100%';
    }

    function liberarScroll() {
        document.body.style.position = '';
        document.body.style.top = '';
        document.body.style.width = '';
        window.scrollTo(0, scrollGuardado);
    }

    if (menuToggle && menuOverlay) {
        menuToggle.addEventListener('click', () => {
            const isActive = menuToggle.classList.toggle('active');
            menuOverlay.classList.toggle('show');

            if (isActive) {
                bloquearScroll();
                // CORRECCIÓN: Forzamos que el header sea visible al abrir el menú
                // por si estaba oculto o intenta ocultarse.
                header.classList.remove("headerOculto");
            } else {
                liberarScroll();
            }
        });

        menuOverlay.addEventListener('click', (e) => {
            if (e.target === menuOverlay) {
                menuOverlay.classList.remove('show');
                menuToggle.classList.remove('active');
                liberarScroll();
            }
        });
    }
    
    // TEXTO AUTOMÁTICO CON MES ACTUAL (MULTIPLE)
    function actualizarTextoMes() {
        const ahora = new Date();
    
        const meses = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
    
        const mesActual = meses[ahora.getMonth()];
    
        document.querySelectorAll(".textoAgenda").forEach(p => {
                p.innerHTML = `¡Date prisa! ¡Quedan pocos lugares para ${mesActual}!`;

        });
    }

actualizarTextoMes();

});