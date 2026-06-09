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

    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        function applyTheme(theme) {
            document.body.classList.toggle('dark', theme === 'dark');
            themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
            localStorage.setItem('site-theme', theme);
        }

        const savedTheme = localStorage.getItem('site-theme') ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        applyTheme(savedTheme);

        themeToggle.addEventListener('click', function () {
            const nextTheme = document.body.classList.contains('dark') ? 'light' : 'dark';
            applyTheme(nextTheme);
        });
    }

    const langToggle = document.getElementById('lang-toggle');
    const i18nElements = document.querySelectorAll('[data-i18n]');
    const translations = {
        ro: {
            heroTitle: 'Saci din polipropilenă<br>și polietilenă',
            heroSubtitle: 'Pentru cereale, construcții și uz gospodăresc',
            heroButton: 'Vezi produsele',
            locationLabel: 'Chișinău, Moldova',
            btnPanel: 'Panou',
            btnLogout: 'Deconectare',
            btnLogin: 'Autentificare',
            btnRegister: 'Înregistrare',
            'cat-big-bags': 'Big bags',
            'cat-plasa-tubulara': 'Plasă tubulară si stretch',
            'cat-plasa': 'Plasă',
            'cat-polietilena': 'Polietilenă',
            'cat-polipropilena': 'Polipropilenă'
        },
        ru: {
            heroTitle: 'Мешки из полипропилена<br>и полиэтилена',
            heroSubtitle: 'Для зерна, строительства и хозяйственного использования',
            heroButton: 'Смотреть товары',
            locationLabel: 'Кишинэу, Молдова',
            btnPanel: 'Панель',
            btnLogout: 'Выйти',
            btnLogin: 'Вход',
            btnRegister: 'Регистрация',
            'cat-big-bags': 'Биг бэгс',
            'cat-plasa-tubulara': 'Трубчатая сетка и stretch',
            'cat-plasa': 'Сетка',
            'cat-polietilena': 'Полиэтилен',
            'cat-polipropilena': 'Полипропилен'
        }
    };

    function applyLanguage(lang) {
        document.documentElement.lang = lang === 'ru' ? 'ru' : 'ro';
        i18nElements.forEach(el => {
            const key = el.dataset.i18n;
            const text = translations[lang] && translations[lang][key];
            if (typeof text === 'string') {
                el.innerHTML = text;
            }
        });
        if (langToggle) {
            langToggle.textContent = lang === 'ru' ? 'RO' : 'RU';
        }
        localStorage.setItem('site-lang', lang);
    }

    const savedLang = localStorage.getItem('site-lang') || 'ro';
    applyLanguage(savedLang);

    if (langToggle) {
        langToggle.addEventListener('click', function () {
            const nextLang = document.documentElement.lang === 'ru' ? 'ro' : 'ru';
            applyLanguage(nextLang);
        });
    }
});

function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    if (!input) return;
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    btn.title = isHidden ? 'Ascunde parola' : 'Arată parola';
}
