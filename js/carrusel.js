(function() {
    const carousel = document.getElementById('manualCarousel');
    if (!carousel) return;

    const track = carousel.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const prevBtn = carousel.querySelector('.carousel-btn.prev');
    const nextBtn = carousel.querySelector('.carousel-btn.next');
    const dotsContainer = carousel.querySelector('.carousel-dots');

    let currentIndex = 0;
    const slideCount = slides.length;

    if (slideCount === 0) return;

    const dots = [];
    slides.forEach((_, i) => {
        const btn = document.createElement('button');
        btn.setAttribute('aria-label', `Ir a la diapositiva ${i + 1}`);
        if (i === 0) btn.classList.add('active');

        btn.addEventListener('click', () => {
            goTo(i);
        });

        dotsContainer.appendChild(btn);
        dots.push(btn);
    });

    function update() {
        track.style.transform = `translateX(${-currentIndex * 100}%)`;

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function goTo(index) {
        currentIndex = (index + slideCount) % slideCount;
        update();
    }

    const next = () => goTo(currentIndex + 1);
    const prev = () => goTo(currentIndex - 1);

    if (nextBtn) nextBtn.addEventListener('click', next);
    if (prevBtn) prevBtn.addEventListener('click', prev);

    carousel.tabIndex = 0;

    update();
})();