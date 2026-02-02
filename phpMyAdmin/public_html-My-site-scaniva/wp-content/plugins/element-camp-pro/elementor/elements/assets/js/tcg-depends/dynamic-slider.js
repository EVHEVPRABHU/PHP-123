!(function ($) {
    // slider
    function tcgDynamicSlider($scope, $) {
        const $slider = $scope.find('.tcg-dynamic-slider');
        const sliderSettings = $slider.data('tcg-dynamic-slider');
        const $swiperContainer = $slider.find('.swiper-container');
        const $nextArrow = $slider.find('.swiper-button-next');
        const $prevArrow = $slider.find('.swiper-button-prev');
        const $pagination = $slider.find('.swiper-pagination');
        const $scrollbar = $slider.find('.swiper-scrollbar');

        // Slider Area Element Animation
        const $slideElements = $slider.find('.tcg-dynamic-slide .elementor-element[data-settings*="animation"], .tcg-dynamic-slide .elementor-element[data-settings*="_animation"]');

        function slideElemAnimation(swiper) {
            $slideElements.each(function () {
                const $this = $(this);
                const settings = $this.data('settings');
                const animationName = settings._animation || settings.animation;
                const animationDelay = settings._animation_delay || settings.animation_delay;

                if (swiper.activeIndex === $this.closest('.swiper-slide').index()) {
                    $this.removeClass('elementor-invisible').addClass('animated ' + animationName);
                } else {
                    $this.removeClass('animated ' + animationName).addClass('elementor-invisible');
                }
            });
        }

        // fix swiper vertical slider height bug
        function setSlideHeight(swiper) {
            if (sliderSettings.autoHeight === 'true' && sliderSettings.direction !== 'vertical') {
                return;
            }

            const currentSlide = swiper.slides[swiper.activeIndex];
            const newHeight = $(currentSlide).children().first().height();


            $swiperContainer.find('.swiper-wrapper, .swiper-slide').each( function () {
                $(this).css({ height: newHeight });
            });

            swiper.update();
        }

        // set slidesPerView to 1
        function oneSlideView(breakpoints) {
            Object.keys(breakpoints).forEach(key => {
                breakpoints[key].slidesPerView = 1;
            });
            return breakpoints;
        }

        const swiperOptions = {
            loop: sliderSettings.loop === 'true',
            effect: sliderSettings.effect,
            speed: sliderSettings.speed,
            direction: sliderSettings.direction,
            oneWayMovement: sliderSettings.oneWayMovement === 'true',
            centeredSlides: sliderSettings.centeredSlides === 'true',
            autoHeight: sliderSettings.autoHeight === 'true',
            mousewheel: {
                enabled: sliderSettings.mousewheel === 'true',
            },
            keyboard: {
                enabled: sliderSettings.keyboard === 'true',
            },
            navigation: {
                nextEl: $nextArrow.get(0),
                prevEl: $prevArrow.get(0),
            },
            pagination: {
                el: $pagination.get(0),
                type: sliderSettings.paginationType !== 'all' ? sliderSettings.paginationType : 'bullets',
                clickable: true
            },
            scrollbar: {
                el: $scrollbar.get(0),
                draggable: true,
                snapOnRelease: true,
            },
            on: {
                init: function () {
                    setSlideHeight(this);
                    slideElemAnimation(this);
                    updateCustomPagination(this),
                    updateProgressBar(this);
                },
                slideChangeTransitionStart: function () {
                    slideElemAnimation(this);
                },
                slideChange: function () {
                  updateCustomPagination(this),
                  updateProgressBar(this);
                },
                resize: function () {
                    setSlideHeight(this);
                    this.update();
                },
            },
            observer: true,
            observeParents: true,
        };

        if (sliderSettings.effect === 'parallax') {
            swiperOptions.parallax = true;
            swiperOptions.on.init = function () {
                setSlideHeight(this);
                slideElemAnimation(this);
                updateCustomPagination(this),
                updateProgressBar(this);
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    $(swiper.slides[i])
                        .find(".tcg-dynamic-slide > .elementor > .e-con")
                        .attr({
                            "data-swiper-parallax": 0.75 * swiper.width,
                        });
                }
            };
            swiperOptions.breakpoints = oneSlideView(sliderSettings.breakpoints);
        } if (sliderSettings.effect === 'material') {
            swiperOptions.materialEffect = {
                slideSplitRatio: 0.65
            };
            swiperOptions.modules = [EffectMaterial];
            swiperOptions.breakpoints = sliderSettings.breakpoints;
        } else if (sliderSettings.effect !== 'slide' && sliderSettings.effect !== 'coverflow' && sliderSettings.effect !== 'cards' && sliderSettings.effect !== 'material') {
            swiperOptions.breakpoints = oneSlideView(sliderSettings.breakpoints);
        } else {
            swiperOptions.breakpoints = sliderSettings.breakpoints;
        }

        if (sliderSettings.autoplay) {
            swiperOptions.autoplay = {
                delay: sliderSettings.autoplay.delay,
                reverseDirection: sliderSettings.autoplay.reverseDirection === 'true',
                disableOnInteraction: sliderSettings.autoplay.disableOnInteraction === 'true',
            };
        }

        if (sliderSettings.effect === 'cards') {
            swiperOptions.cardsEffect = {
                rotate: true,
                slideShadows: false,
                perSlideOffset: sliderSettings.cardsOffset,
                perSlideRotate: sliderSettings.cardsRotate,
            };
        }

        const swiper = new Swiper($swiperContainer.get(0), swiperOptions);

        function updateCustomPagination(swiper) {

            if(sliderSettings.paginationType !== 'all') return;

            const totalSlides = swiper.pagination.bullets.length; // Adjust for cloned slides if loop is true
            const currentIndex = swiper.realIndex + 1; // realIndex starts from 0            
            const customPagination = document.querySelector('.swiper-pagination-fraction');
            
            customPagination.innerHTML = `<span class="swiper-pagination-current"> ${currentIndex} </span> <span class="slide-mark"> / </span> <span class="swiper-pagination-total"> ${totalSlides} </span>`;
        }    
        updateCustomPagination(swiper);
    
        function updateProgressBar(swiper) {

            if(sliderSettings.paginationType !== 'all') return;

            const totalSlides = swiper.pagination.bullets.length; // Adjust for cloned slides if loop is true
            const currentIndex = swiper.realIndex + 1; // realIndex starts from 0
            const progressPercentage = (currentIndex / totalSlides) * 100;
            const progressBar = document.querySelector('.swiper-pagination-progressbar-fill');
            progressBar.style.width = `${progressPercentage}%`;
        }
    }

    function tcg_float_cursor($scope, $) {
        const floatCursorContainers = document.querySelectorAll('.tcg-float-cursor-container');
        const isRTL = $('body').css('direction') === 'rtl';

        floatCursorContainers.forEach(container => {
            const floatCursor = container.querySelector('.tcg-float-cursor');
            let mouseX = 0, mouseY = 0;
            let isMoving = false;

            // When mouse enters the container
            container.addEventListener('mouseenter', () => {
                floatCursor.style.opacity = '1';
                floatCursor.style.transform = 'scale(1)';
            });

            // When mouse moves within the container
            container.addEventListener('mousemove', (e) => {
                const rect = container.getBoundingClientRect();
                mouseX = isRTL ? rect.right - e.clientX - 75 : e.clientX - rect.left - 75;
                mouseY = e.clientY - rect.top - 75;
                isMoving = true;
            });

            // Update cursor position using requestAnimationFrame for smoother performance
            function updateCursor() {
                if (isMoving) {
                    floatCursor.style.left = isRTL ? 'auto' : `${mouseX}px`;
                    floatCursor.style.right = isRTL ? `${mouseX}px` : 'auto';
                    floatCursor.style.top = `${mouseY}px`;
                    isMoving = false;
                }
                requestAnimationFrame(updateCursor);
            }

            updateCursor();  // Start the update loop

            // When mouse leaves the container
            container.addEventListener('mouseleave', () => {
                floatCursor.style.opacity = '0';
                floatCursor.style.transform = 'scale(0)';
            });
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/tcg-dynamic-slider.default', tcgDynamicSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/tcg-dynamic-slider.default', tcg_float_cursor);
    });
})(jQuery);