document.addEventListener('DOMContentLoaded', function() {
    // =============================================
    // 1. Animación de secciones al hacer scroll
    // =============================================
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // =============================================
    // 2. Header que se oculta al hacer scroll (mejorado)
    // =============================================
    let lastScroll = 0;
    const header = document.querySelector('header');
    const scrollThreshold = 50;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.scrollY;
        
        if (currentScroll > lastScroll && currentScroll > scrollThreshold) {
            header.classList.add('headerOculto');
        } else {
            header.classList.remove('headerOculto');
        }
        lastScroll = currentScroll <= 0 ? 0 : currentScroll;
    });

    // =============================================
    // 3. Carrusel infinito de testimonios
    // =============================================
    function setupInfiniteTestimonials() {
        const scroller = document.querySelector('.testimonios-scroller');
        if (!scroller || scroller.dataset.infinite) return;

        const testimonials = scroller.innerHTML;
        scroller.innerHTML = testimonials + testimonials + testimonials;

        const singleWidth = Array.from(scroller.children)
            .slice(0, scroller.children.length / 3)
            .reduce((acc, el) => acc + el.offsetWidth + 32, 0);

        const style = document.createElement('style');
        style.textContent = `
            @keyframes scrollTestimonials {
                0% { transform: translateX(0); }
                100% { transform: translateX(-${singleWidth}px); }
            }
        `;
        document.head.appendChild(style);

        scroller.addEventListener('animationiteration', () => {
            requestAnimationFrame(() => {
                scroller.style.transition = 'none';
                scroller.style.transform = 'translateX(0)';
                setTimeout(() => {
                    scroller.style.transition = 'transform 40s linear';
                }, 50);
            });
        });

        scroller.dataset.infinite = 'true';
    }

    setupInfiniteTestimonials();
    
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



