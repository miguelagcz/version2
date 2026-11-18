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
        seccion.classList.remove("visible");
        observer.observe(seccion);
    });

    // =============================================
    // 2. CÓDIGO DEL MENÚ HAMBURGUESA (SCROLL) - CORREGIDO
    // =============================================
    let lastScrollTop = 0;
    const header = document.querySelector("header");
    const toggleParaScroll = document.getElementById('menuToggle'); 

    window.addEventListener("scroll", function () {
        if (toggleParaScroll && toggleParaScroll.classList.contains('active')) {
            return;
        }

        let scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            header.classList.add("headerOculto");
        } else {
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
                window.location.href = '/en/sobre-nosotros.html';
            } else if (selectedLanguageUs === 'es') {
                window.location.href = '/es/sobre-nosotros.html';
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
    // MENÚ HAMBURGUESA (OVERLAY PANTALLA COMPLETA + BLOQUEO DE SCROLL)
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

    document.querySelectorAll('.menu-desplegado a[href^="#"]').forEach(link => {
        link.addEventListener('click', () => {
            menuOverlay.classList.remove('show');
            menuToggle.classList.remove('active');
            document.body.style.overflow = '';
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
