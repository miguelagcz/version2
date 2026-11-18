/* =============================================================
   CONTADOR "HASTA 2026, HEMOS GENERADO" — FlovaMedia
   El número se llena de agua mientras cuenta cuando entra en pantalla.
   Las cifras se editan en los atributos data-* de la sección en index.html:
     data-total    → millones generados (ej. 20.1)
     data-goal     → meta en millones (ej. 50)
     data-duration → milisegundos que tarda en contar
   ============================================================= */
(function () {
    var root = document.querySelector('[data-fm-counter]');
    if (!root) return;

    var total = parseFloat(root.getAttribute('data-total')) || 0;
    var goal = parseFloat(root.getAttribute('data-goal')) || 0;
    var duration = parseInt(root.getAttribute('data-duration'), 10) || 2800;

    var water = root.querySelector('.fm-amount__water');
    var amountEls = root.querySelectorAll('[data-fm-amount]');
    var goalFill = root.querySelector('[data-fm-goal-fill]');
    var stats = Array.prototype.slice.call(root.querySelectorAll('.fm-stat__value[data-count]'));

    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var easeOut = function (p) { return 1 - Math.pow(1 - p, 3); };
    var easeInOut = function (p) { return 0.5 - Math.cos(Math.PI * p) / 2; }; // el agua sube pareja

    // Altura del agua en "em": la caja del número mide 1.15em (su line-height)
    var EMPTY = 0.08;  // agua justo debajo de los números
    var FULL = 1.15;   // agua cubriendo todo el número

    // Cuenta con la misma cantidad de dígitos que la cifra final (00.0 → 20.1),
    // así el número nunca cambia de tamaño mientras cuenta
    var intDigits = String(Math.floor(total)).length;
    function formatAmount(value) {
        var parts = value.toFixed(1).split('.');
        while (parts[0].length < intDigits) parts[0] = '0' + parts[0];
        return '+$' + parts[0] + '.' + parts[1];
    }

    function setAmount(e) {
        var text = formatAmount(total * e);
        for (var i = 0; i < amountEls.length; i++) {
            if (amountEls[i].textContent !== text) amountEls[i].textContent = text;
        }
        if (water) water.style.setProperty('--fm-h', (EMPTY + (FULL - EMPTY) * e).toFixed(4) + 'em');
        if (goalFill && goal) goalFill.style.width = (total / goal * 100 * e).toFixed(2) + '%';
    }

    function setStats(e) {
        stats.forEach(function (el) {
            var n = Math.round(parseFloat(el.getAttribute('data-count')) * e);
            el.textContent = (el.getAttribute('data-prefix') || '') + n.toLocaleString('es-MX');
        });
    }

    function finish() {
        setAmount(1);
        setStats(1);
        root.classList.add('is-full'); // detiene el oleaje cuando ya está lleno
    }

    // Sin animación si la persona la desactivó o el navegador es muy viejo
    if (reduceMotion || !('IntersectionObserver' in window)) {
        finish();
        return;
    }

    setAmount(0);
    setStats(0);

    function run() {
        var start = null;
        function frame(t) {
            if (start === null) start = t;
            var elapsed = t - start;
            setAmount(easeInOut(Math.min(1, elapsed / duration)));
            setStats(easeOut(Math.min(1, elapsed / (duration * 0.75))));
            if (elapsed < duration) requestAnimationFrame(frame);
            else finish();
        }
        requestAnimationFrame(frame);
    }

    // Arranca cuando el número entra en pantalla (una sola vez)
    var io = new IntersectionObserver(function (entries) {
        if (entries[0].isIntersecting) {
            io.disconnect();
            run();
        }
    }, { threshold: 0.35 });
    io.observe(root.querySelector('.fm-amount') || root);
})();