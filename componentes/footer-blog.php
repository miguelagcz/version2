<footer class="cierrePagina">
    <div class="footer-flova-inner">

        <div class="footer-flova-brand">
            <img src="/img/logob.png" alt="Flova Media Logo" class="logo" />
            <div class="social-icons">
                <a href="https://www.instagram.com/flova.media/" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.facebook.com/profile.php?id=61572633061981" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.linkedin.com/company/flovamedia/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com/@FlovaMedia" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
            <h3 class="footer-flova-heading">Hacemos Crecer<br>tu Negocio.</h3>
            <p class="footer-flova-tagline">
                Conseguir clientes es brutal. Nosotros lo hacemos mucho más rápido, sin suposiciones y con más ganancias.
            </p>
        </div>

        <div class="footer-flova-links">

            <div class="footer-flova-col">
                <h4>Servicios</h4>
                <ul>
                    <li><a href="/facebook">Facebook Ads</a></li>
                    <li><a href="/google-ads">Google Ads</a></li>
                    <li><a href="/seo">Google SEO</a></li>
                    <li><a href="#">Optimización del Embudo de Ventas</a></li>
                    <li><a href="/paginas-de-aterrizaje">Páginas de Aterrizaje</a></li>
                    <li><a href="#">Diseño Web</a></li>
                </ul>
            </div>

            <div class="footer-flova-col">
                <h4>Empresa</h4>
                <ul>
                    <li><a href="/sobre-nosotros">Sobre Nosotros</a></li>
                    <li><a href="/contactoform">Contáctanos</a></li>
                    <li><a href="/blog/">Blog</a></li>
                    <li><a href="#">Casos de Éxito</a></li>
                </ul>
            </div>

            <div class="footer-flova-col">
                <h4>Contacto</h4>
                <ul class="footer-flova-contacto">
                    <li>+52 55 3194 0098</li>
                    <li>contacto@flova-media.com</li>
                    <li>Dirección pendiente</li>
                </ul>
            </div>

            <div class="footer-flova-col">
                <h4>Soluciones</h4>
                <ul>
                    <li><a href="#">Agencia</a></li>
                    <li><a href="#">Consultoría</a></li>
                    <li><a href="#">Guías <i class="fa-solid fa-chevron-down" style="font-size:0.7rem"></i></a></li>
                    <li><a href="/blog/">Blog</a></li>
                </ul>
            </div>

            <div class="footer-flova-col footer-flova-newsletter">
                <h4>Material para ti</h4>
                <p>Recibe estrategias de marketing cada semana directamente a tu correo. Solo introduce tu correo aquí abajo...</p>
                <form class="cta-form">
                    <input type="email" placeholder="Ingresa tu Correo...">
                    <button type="submit">¡Aquí!</button>
                </form>
            </div>

        </div>
    </div>

    <div class="footer-bottom">
        <p>Copyright © 2026 Flova Media Todos los derechos reservados.<br>
            <a href="/terminos-de-uso">Condiciones de uso</a> | <a href="/politicas-de-privacidad">Política de privacidad</a>
        </p>
    </div>
</footer>

<script src="/js/appFlova.js?v2"></script>

<script>
    // Barra de progreso de lectura
    var progreso = document.getElementById('progreso');
    var progresoTicking = false;

    function actualizarProgreso() {
        var alto = document.documentElement.scrollHeight - window.innerHeight;
        var avance = alto > 0 ? window.scrollY / alto : 0;
        progreso.style.transform = 'scaleX(' + avance + ')';
        progresoTicking = false;
    }

    window.addEventListener('scroll', function () {
        if (!progresoTicking) {
            requestAnimationFrame(actualizarProgreso);
            progresoTicking = true;
        }
    }, { passive: true });

    // Scrollspy: resalta el enlace activo del índice lateral
    var secciones = document.querySelectorAll('.post-flova-cuerpo section[id]');
    var enlacesToc = document.querySelectorAll('#tocLateral a');
    if ('IntersectionObserver' in window) {
        var spy = new IntersectionObserver(function (entries) {
            entries.forEach(function (entrada) {
                var id = entrada.target.getAttribute('id');
                var enlace = document.querySelector('#tocLateral a[href="#' + id + '"]');
                if (!enlace) return;
                if (entrada.isIntersecting) {
                    enlacesToc.forEach(function (a) { a.classList.remove('activo'); });
                    enlace.classList.add('activo');
                }
            });
        }, { rootMargin: '-20% 0px -65% 0px' });
        secciones.forEach(function (s) { spy.observe(s); });
    }
</script>
