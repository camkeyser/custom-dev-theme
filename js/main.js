// Debounce function to limit the rate at which a function can fire.
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}


window.addEventListener('load', () => {
    
    
    //-------------------------------------
    // Hamburger/Mobile Menu
    //-------------------------------------
    const hamburger = document.querySelector('.hamburger-icon');
    const fullscreenMenu = document.querySelector('.fullscreen-menu');

    // Open the menu
    const openMenu = () => {
        fullscreenMenu.classList.add('active');
        hamburger.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    // Close the menu
    const closeMenu = () => {
        fullscreenMenu.classList.remove('active');
        hamburger.classList.remove('active');
        document.body.style.overflow = '';
    };

    // Toggle menu on hamburger click
    hamburger.addEventListener('click', () => {
        if (fullscreenMenu.classList.contains('active')) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    
    //-------------------------------------
    // Accordion Functionality
    //-------------------------------------
    document.querySelectorAll('.accordion-title').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;

            // Close all other accordions
            document.querySelectorAll('.accordion-item').forEach(item => {
                const otherButton = item.querySelector('.accordion-title');
                const otherContent = item.querySelector('.accordion-content');
                if (otherContent !== content) {
                    otherButton.classList.remove('active');
                    otherContent.classList.remove('active');
                }
            });

            // Toggle current accordion
            button.classList.toggle('active');
            content.classList.toggle('active');
        });
    });


    //-------------------------------------
    // Initialize each Splide instance
    //-------------------------------------
    document.querySelectorAll('.splide').forEach(slider => {
        const splide = new Splide(slider, {
            perPage: 3,
            focus: 'center',
            trimSpace: false,
            arrows: true,
            start: 0,
            gap: '1rem',
            breakpoints: {
                768: { 
                    perPage: 2
                },
                480: { 
                    type: 'slide',
                    perPage: 1,
                    focus: 'center',
                    drag: 'free',
                    snap: true,
                    speed: 400,
                    flickPower: 300,
                    flickMaxPages: 1
                },
            },
        });
    
        function updateArrows() {
            const prevButton = splide.root.querySelector('.splide__arrow--prev');
            const nextButton = splide.root.querySelector('.splide__arrow--next');
            const totalSlides = splide.Components.Slides.getLength();
            const currentIndex = splide.index;
            
            prevButton.style.display = currentIndex === 0 ? 'none' : '';
        
            const lastPossibleIndex = totalSlides - 1;
            nextButton.style.display = currentIndex >= lastPossibleIndex ? 'none' : '';
        }
    
        splide.on('mounted moved', updateArrows);

        splide.mount();
    });


    //-------------------------------------
    // Header and Hero Animation - GSAP
    //-------------------------------------
    const header = document.querySelector('.site-header');

    const headerTimeline = gsap.timeline({
        defaults: { 
            ease: "power2.out",
            duration: 1
        }
    });

    // Animate header
    headerTimeline.fromTo(header, 
        {
            y: -50,
            opacity: 0
        },
        {
            y: 0,
            opacity: 1,
            visibility: 'visible',
            onComplete: () => console.log('Header animation complete')
        }
    );

    // Animate hero elements
    headerTimeline.fromTo(
        [".full-width-hero-image h1", ".full-width-hero-image p", ".full-width-hero-image .hero-btn-contain"],
        {
            y: -50,
            opacity: 0
        },
        {
            y: 0,
            opacity: 1,
            visibility: 'visible',
            stagger: 0.13,
            onComplete: () => console.log('Hero elements animation complete')
        },
        "<"
    );

    window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY;
        const isAltPage = document.body.classList.contains('page-id-286');
        const scrollThreshold = isAltPage ? 30 : 50;

        if (scrollPosition > scrollThreshold) {
            header.style.backgroundColor = 'rgba(11, 27, 43, 0.85)';
            header.style.backdropFilter = 'blur(8px)';
        } else {
            header.style.backgroundColor = 'rgba(11, 27, 43, 0)';
            header.style.backdropFilter = 'blur(0px)';
        }
    });

    window.dispatchEvent(new Event('scroll'));


    //-------------------------------------
    // Gravity Form Animation - GSAP
    //-------------------------------------
    gsap.matchMedia().add("(min-width: 851px)", () => {
        gsap.fromTo(
            '.gform_wrapper',
            {
                x: 200,
                opacity: 0,
            },
            {
                x: 0,
                opacity: 1,
                duration: 2,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: '.gform_wrapper',
                    start: 'top 90%',
                    end: 'bottom 50%',
                    scrub: true,
                    toggleActions: 'play reverse play reverse',
                },
            }
        );
    });


    //-------------------------------------
    // Stats Counter Animation - GSAP
    //-------------------------------------
    const statsSections = document.querySelectorAll('.stats-counter-block');

    statsSections.forEach(section => {
        gsap.utils.toArray(section.querySelectorAll('.stats-count')).forEach(number => {
            gsap.fromTo(number, {
                innerHTML: 0
            }, {
                innerHTML: number.getAttribute('data-count'),
                duration: 2,
                ease: 'power1.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                },
                snap: { innerHTML: 1 },
                stagger: 0.2,
                onUpdate: function () {
                    number.innerHTML = Math.ceil(number.innerHTML);
                }
            });
        });
    });


    //-------------------------------------
    // Parallax Section Animation - Slide In and Out
    //-------------------------------------
    gsap.registerPlugin(ScrollTrigger);

    const parallaxSections = document.querySelectorAll('.full-width-parallax-section.animation-slide-in-out');

    parallaxSections.forEach(section => {
        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 50%",
                end: "bottom 50%",
                scrub: true,
            }
        });

        let content = section.querySelector('.parallax-content');

        tl.fromTo(content, 
            { opacity: 0, x: -200 },
            { opacity: 1, x: 0, duration: 0.5, ease: "power1.out" }
        )
        .to(content, 
            { opacity: 0, x: 200, duration: 0.5, ease: "power1.in" }
        );
    });


    //-------------------------------------
    // Search Bar Toggle on Icon Press
    //-------------------------------------
    const toggleButton = document.querySelector('.search-toggle');
    const searchContainer = document.querySelector('.asl_w_container');
    const searchInput = searchContainer.querySelector('input.orig');

    toggleButton.addEventListener('click', function() {
        searchContainer.classList.toggle('active');

        if (searchContainer.classList.contains('active')) {
            searchInput.focus();
        }
    });


    //-------------------------------------
    // Search Image fallbacks
    //-------------------------------------
    const fallbackImages = themeData.fallbackImages;

    const isPost = true;
    const fallbackImage = isPost ? fallbackImages.post : fallbackImages.page;

    // Set fallback images
    function setFallbackImages() {
        const searchResults = document.querySelectorAll('.asl_r_pagepost');
        searchResults.forEach(result => {
            const image = result.querySelector('.asl_image');
            const isPost = result.classList.contains('asl_r_post');
            
            // Check if the image is the plugin's default image and replace it with the fallback
            if (image && image.src.includes('/wp-content/plugins/ajax-search-lite/img/default.jpg')) {
                image.src = isPost ? fallbackImages.post : fallbackImages.page;
            }
        });
    }

    const resultsContainer = document.querySelector('#ajaxsearchliteres1');
    if (resultsContainer) {
        const observer = new MutationObserver(setFallbackImages);
        observer.observe(resultsContainer, { childList: true, subtree: true });
    }

    setFallbackImages();


    //-------------------------------------
    // Lottie Animations
    //-------------------------------------
    const animations = document.querySelectorAll('.blob-animation');

    animations.forEach(function(container) {
        const animation = lottie.loadAnimation({
            container: container,
            renderer: 'svg',
            loop: true,
            autoplay: false,
            path: themeData.themeUrl + '/img/blob.json'
        });

        animation.addEventListener('DOMLoaded', function() {
            const totalFrames = animation.totalFrames;
            const randomStartFrame = Math.floor(Math.random() * totalFrames);
            animation.goToAndPlay(randomStartFrame, true);
        });
    });


    //-------------------------------------
    // Fancybox
    //-------------------------------------
    Fancybox.bind("[data-fancybox='gallery'], [data-fancybox='slider-gallery']", {
        click: "outside",
        trapFocus: true,
        keyboard: {
            Escape: "close",
        },
    });

});