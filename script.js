

document.addEventListener('DOMContentLoaded', function () {

    
    const sections = document.querySelectorAll('.category-section');
    const navItems = document.querySelectorAll('.categories-nav__item');

    if (sections.length && navItems.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        navItems.forEach(item => {
                            item.classList.toggle(
                                'active',
                                item.getAttribute('href') === '#' + id
                            );
                        });
                    }
                });
            },
            { rootMargin: '-30% 0px -60% 0px' }
        );

        sections.forEach(s => observer.observe(s));
    }

    
    navItems.forEach(item => {
        item.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

}); 



document.addEventListener('DOMContentLoaded', function () {

    
    const sections = document.querySelectorAll('.category-section');
    const navItems = document.querySelectorAll('.categories-nav__item');

    if (sections.length && navItems.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        navItems.forEach(item => {
                            item.classList.toggle(
                                'active',
                                item.getAttribute('href') === '#' + id
                            );
                        });
                    }
                });
            },
            { rootMargin: '-30% 0px -60% 0px' }
        );

        sections.forEach(s => observer.observe(s));
    }

    
    navItems.forEach(item => {
        item.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

});


function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    if (!input) return;
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.title = isHidden ? 'Ascunde parola' : 'Arată parola';
}