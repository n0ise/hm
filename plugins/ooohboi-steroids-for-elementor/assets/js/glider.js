'use strict';

( function ( $, w ) {
    
    var $window = $( w ); 

	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	}

    $window.on( 'elementor/frontend/init', function() {

        var ModuleHandler = elementorModules.frontend.handlers.Base, 
        Glider; 

        Glider = ModuleHandler.extend( {

            me_the_swiper: 'undefined', 
            glider_external_controls: [], 

            onInit: function() {
                ModuleHandler.prototype.onInit.apply( this, arguments );
                if( this.isGlider() && this.isGliderCandidate() ) {

                    this.$element.addClass( 'ob-is-glider' ); 
                    this.generateSwiperStructure(); 

                } else if( this.isGlider() && this.isOldGliderCandidate() ) { // if not a container!!!

                    this.$element.addClass( 'ob-is-glider' ); 
                    this.generateSwiperOld(); 

                }
            },

            isGlider: function() {
                return ( this.getElementSettings( '_ob_glider_is_slider' ) === 'yes' );
            }, 

            isGliderCandidate: function() {
                return ( ! this.$element.closest( '.swiper' ).length && ! this.$element.find( '.swiper' ).length && this.$element.children( '[data-element_type="container"]' ).length > 1 );
            }, 

            isOldGliderCandidate: function() { // it's not a container 
                return ( 'section' === this.$element.attr( 'data-element_type' ) );
            }, 

            onElementChange: function( changedProp ) {

                if( changedProp === '_ob_glider_is_slider' ) { 

                    if( this.isGliderCandidate() ) {

                        if( 'yes' === this.getElementSettings( '_ob_glider_is_slider' ) ) {
                            this.$element.attr( 'id', 'glider-' + this.getID() ); 
                            this.$element.addClass( 'ob-is-glider' ); 
                            this.generateSwiperStructure();
                        } else if( '' === this.getElementSettings( '_ob_glider_is_slider' ) ) {
                            this.$element.removeClass( 'ob-is-glider' ); 
                            elementor.reloadPreview();
                        } 

                    } else if( this.isOldGliderCandidate() ) { // if not a container  !!!

                        if( 'yes' === this.getElementSettings( '_ob_glider_is_slider' ) ) {
                            this.$element.attr( 'id', 'glider-' + this.getID() ); 
                            this.$element.addClass( 'ob-is-glider' ); 
                            this.generateSwiperOld();
                        } else if( '' === this.getElementSettings( '_ob_glider_is_slider' ) ) {
                            this.$element.removeClass( 'ob-is-glider' ); 
                            elementor.reloadPreview();
                        } 

                    }

                }
            }, 

            generateSwiperStructure: function() {

                if( this.$element.find( '.ob-swiper-bundle' ).length ) return; // bail if the wraping element exists

                this.$element.children( '[data-element_type="container"]' ).wrapAll( '<div class="ob-swiper-bundle swiper"></div>' ); 

                var wrapr = this.$element.find( '.ob-swiper-bundle' );

                wrapr.children( '[data-element_type="container"]' ).addClass( 'swiper-slide' ).wrapAll( '<div class="swiper-wrapper"></div>' );
                // append controls: next prev pagination
                wrapr
                .append( 
                    '<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMin" viewBox="0 0 27 44"><path d="M27 22L5 44l-2.1-2.1L22.8 22 2.9 2.1 5 0l22 22z"></path></svg></div>' 
                )
                .append( 
                    '<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMin" viewBox="0 0 27 44"><path d="M0 22L22 0l2.1 2.1L4.2 22l19.9 19.9L22 44 0 22z"></path></svg></div>' 
                )
                .append( '<div class="swiper-pagination"></div>' );

                // grab the settings...
                var settingz = {};
                settingz.pagination_type = this.getElementSettings( '_ob_glider_pagination_type' ) || 'bullets';
                settingz.allowTouchMove = this.getElementSettings( '_ob_glider_allow_touch_move' );
                settingz.autoheight = this.getElementSettings( '_ob_glider_auto_h' );
                settingz.effect = this.getElementSettings( '_ob_glider_effect' );
                settingz.loop = this.getElementSettings( '_ob_glider_loop' );
                settingz.direction = this.getElementSettings( '_ob_glider_direction' );
                settingz.parallax = this.getElementSettings( '_ob_glider_parallax' );
                settingz.speed = this.getElementSettings( '_ob_glider_speed' );
                var autoplayed = this.getElementSettings( '_ob_glider_autoplay' );
                if( autoplayed ) {
                    settingz.autoplay = {
                        'delay': this.getElementSettings( '_ob_glider_autoplay_delay' ), 
                    }
                } else settingz.autoplay = false;
                settingz.mousewheel = this.getElementSettings( '_ob_glider_allow_mousewheel' );

                /* by Xmastermind */
                settingz.allowMultiSlides = this.getElementSettings( '_ob_glider_allow_multi_slides' );
                var breakpointsSettings = {},
                breakpoints = elementorFrontend.config.breakpoints;
                breakpointsSettings[breakpoints.lg] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between' ) || 0,
                };
                breakpointsSettings[breakpoints.md] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view_tablet' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll_tablet' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between_tablet' ) || 0,
                };
                breakpointsSettings[0] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view_mobile' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll_mobile' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between_mobile' ) || 0,
                };
                settingz.breakpoints = breakpointsSettings;
                // centered slides - v1.7.9
                settingz.slides_centered = this.getElementSettings( '_ob_glider_centered_slides' ); 
                settingz.slides_centered_bounds = this.getElementSettings( '_ob_glider_centered_bounds_slides' ); 
                settingz.slides_round_lenghts = this.getElementSettings( '_ob_glider_roundlengths_slides' ); 

                // create swiper ----------------------------------------------------------------------------------
                var swiper_config = {
                    allowTouchMove: ( 'yes' === settingz.allowTouchMove ? true : false ), 
                    autoHeight: ( 'yes' === settingz.autoheight ? true : false ), 
                    effect: settingz.effect, 
                    loop: settingz.loop, 
                    direction: ( 'fade' === settingz.effect ? 'horizontal' : settingz.direction ), 
                    parallax: ( 'yes' === settingz.parallax ? true : false ),
                    speed: settingz.speed, 
                    breakpoints: ( 'yes' === settingz.allowMultiSlides ? settingz.breakpoints : false ), 
                    centeredSlides: ( 'yes' === settingz.slides_centered ? true : false ), 
                    centeredSlidesBounds: ( 'yes' === settingz.slides_centered_bounds ? true : false ), 
                    roundLengths: ( 'yes' === settingz.slides_round_lenghts ? true : false ), 
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination', 
                        type: settingz.pagination_type, 
                        clickable: true, 
                    },
                    autoplay: settingz.autoplay, 
                    mousewheel: ( 'yes' === settingz.mousewheel ? true : false ), 
                    watchOverflow : true, /* gotta force it down */ 
                };
                // improved asset loading
                if ( 'undefined' === typeof Swiper ) { // swiper not loaded
                    var tmp_this = this;
                    let chck_if_elementor_utils_loaded = setInterval( function() {

                        if( elementorFrontend.utils ) {
                            clearInterval( chck_if_elementor_utils_loaded ); 
                            const asyncSwiper = elementorFrontend.utils.swiper;
                            new asyncSwiper( wrapr, swiper_config ).then( ( newSwiperInstance ) => {
                                tmp_this.me_the_swiper = newSwiperInstance; 
                                tmp_this.runSyncStuff( tmp_this.me_the_swiper );
                            } );
                        }

                    }, 500 ); // wait for Elementor utils to load entirely

                } else { // otherwise swiper exists
                    this.me_the_swiper = new Swiper( wrapr, swiper_config );
                    this.runSyncStuff( this.me_the_swiper );
                }

                // show the swiper
                wrapr.css( 'visibility', 'visible' );
                
                if( this.isEdit ) {
                    var TMP_this = this;
                    // the DOM hack to prevent all kinds of shit ... 
                    elementor.channels.editor.on( 'change:container', function( el ) {
                        if( el._parent.model.id === TMP_this.getID() ) {
                            w.dispatchEvent( new Event( 'resize' ) ); // trigger only if dealing with the Glider
                        }
                    } );
                }

            }, 

            generateSwiperOld: function() {

                var wrapr = this.$element.children( '.elementor-container' ).first();
                var wrapr_has_row = $( wrapr ).children( '.elementor-row' ).first(); // chck for elementor-row

                if( wrapr_has_row.length ) wrapr = wrapr_has_row;

                wrapr.children( '[data-element_type="column"]' ).addClass( 'swiper-slide' ).wrapAll( '<div class="swiper-wrapper"></div>' );
                // append controls: next prev pagination
                if( ! wrapr.find( '.swiper-button-next' ).first().length ) {
                    wrapr.append( 
                        '<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMin" viewBox="0 0 27 44"><path d="M27 22L5 44l-2.1-2.1L22.8 22 2.9 2.1 5 0l22 22z"></path></svg></div>' 
                    );
                }
                if( ! wrapr.find( '.swiper-button-prev' ).first().length ) {
                    wrapr.append( 
                        '<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMin" viewBox="0 0 27 44"><path d="M0 22L22 0l2.1 2.1L4.2 22l19.9 19.9L22 44 0 22z"></path></svg></div>' 
                    );
                }
                if( ! wrapr.find( '.swiper-pagination' ).first().length ) wrapr.append( '<div class="swiper-pagination"></div>' );

                // grab the settings...
                var settingz = {};
                settingz.pagination_type = this.getElementSettings( '_ob_glider_pagination_type' ) || 'bullets';
                settingz.allowTouchMove = this.getElementSettings( '_ob_glider_allow_touch_move' );
                settingz.autoheight = this.getElementSettings( '_ob_glider_auto_h' );
                settingz.effect = this.getElementSettings( '_ob_glider_effect' );
                settingz.loop = this.getElementSettings( '_ob_glider_loop' );
                settingz.direction = this.getElementSettings( '_ob_glider_direction' );
                settingz.parallax = this.getElementSettings( '_ob_glider_parallax' );
                settingz.speed = this.getElementSettings( '_ob_glider_speed' );
                var autoplayed = this.getElementSettings( '_ob_glider_autoplay' );
                if( autoplayed ) {
                    settingz.autoplay = {
                        'delay': this.getElementSettings( '_ob_glider_autoplay_delay' ), 
                    }
                } else settingz.autoplay = false;
                settingz.mousewheel = this.getElementSettings( '_ob_glider_allow_mousewheel' );

                /* by Xmastermind */
                settingz.allowMultiSlides = this.getElementSettings( '_ob_glider_allow_multi_slides' );
                var breakpointsSettings = {},
                breakpoints = elementorFrontend.config.breakpoints;
                breakpointsSettings[breakpoints.lg] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between' ) || 0,
                };
                breakpointsSettings[breakpoints.md] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view_tablet' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll_tablet' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between_tablet' ) || 0,
                };
                breakpointsSettings[0] = {
                    slidesPerView: this.getElementSettings( '_ob_glider_slides_per_view_mobile' ),
                    slidesPerGroup: this.getElementSettings( '_ob_glider_slides_to_scroll_mobile' ),
                    spaceBetween: +this.getElementSettings( '_ob_glider_space_between_mobile' ) || 0,
                };
                settingz.breakpoints = breakpointsSettings;
                // centered slides - v1.7.9
                settingz.slides_centered = this.getElementSettings( '_ob_glider_centered_slides' ); 
                settingz.slides_centered_bounds = this.getElementSettings( '_ob_glider_centered_bounds_slides' ); 
                settingz.slides_round_lenghts = this.getElementSettings( '_ob_glider_roundlengths_slides' ); 

                // create swiper ----------------------------------------------------------------------------------
                var swiper_config = {
                    allowTouchMove: ( 'yes' === settingz.allowTouchMove ? true : false ), 
                    autoHeight: ( 'yes' === settingz.autoheight ? true : false ), 
                    effect: settingz.effect, 
                    loop: settingz.loop, 
                    direction: ( 'fade' === settingz.effect ? 'horizontal' : settingz.direction ), 
                    parallax: ( 'yes' === settingz.parallax ? true : false ),
                    speed: settingz.speed, 
                    breakpoints: ( 'yes' === settingz.allowMultiSlides ? settingz.breakpoints : false ), 
                    centeredSlides: ( 'yes' === settingz.slides_centered ? true : false ), 
                    centeredSlidesBounds: ( 'yes' === settingz.slides_centered_bounds ? true : false ), 
                    roundLengths: ( 'yes' === settingz.slides_round_lenghts ? true : false ), 
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination', 
                        type: settingz.pagination_type, 
                        clickable: true, 
                    },
                    autoplay: settingz.autoplay, 
                    mousewheel: ( 'yes' === settingz.mousewheel ? true : false ), 
                    watchOverflow : true, /* gotta force it down */ 
                };
                // improved asset loading
                if ( 'undefined' === typeof Swiper ) { // swiper not loaded
                    var tmp_this = this;
                    let chck_if_elementor_utils_loaded = setInterval( function() {

                        if( elementorFrontend.utils ) {
                            clearInterval( chck_if_elementor_utils_loaded ); 
                            const asyncSwiper = elementorFrontend.utils.swiper;
                            new asyncSwiper( wrapr, swiper_config ).then( ( newSwiperInstance ) => {
                                tmp_this.me_the_swiper = newSwiperInstance; 
                                tmp_this.runSyncStuff( tmp_this.me_the_swiper );
                            } );
                        }

                    }, 500 ); // wait for Elementor utils to load entirely

                } else { // otherwise swiper exists
                    this.me_the_swiper = new Swiper( wrapr, swiper_config );
                    this.runSyncStuff( this.me_the_swiper );
                }

                // show the swiper
                wrapr.css( 'visibility', 'visible' );

                if( this.isEdit ) {
                    var TMP_this = this;
                    // the DOM hack to prevent all kinds of shit ... 
                    elementor.channels.editor.on( 'change:section', function( el ) {
                        if( el._parent.model.id === TMP_this.getID() ) {
                            w.dispatchEvent( new Event( 'resize' ) ); // trigger only if dealing with the Glider
                        }
                    } );
                }

            }, 

            runSyncStuff: function( swiper_ob ) {

                // external control via the CSS class
                this.glider_external_controls = $( 'body' ).find( '[class*="glider-' + this.$element[ 0 ].dataset[ 'id' ] + '-gotoslide-"]' ) || [];

                if( this.glider_external_controls.length ) {

                    this.glider_external_controls.each( function() {
                        this.target_swiper = swiper_ob;
                    } );

                    this.glider_external_controls.on( 'click', function( e ) {

                        var slide_num = parseInt( $( this ).attr( 'class' ).match(/-gotoslide-(\d+)/)[ 1 ] );
                        if( slide_num > 0 ) this.target_swiper.slideTo( slide_num );

                        e.preventDefault(); // bail
            
                    } );
                }

            }, 
            
        } );

        var handlersList = {

            'section': Glider, 
            'container': Glider, 

        };
        /*
        elementorFrontend.hooks.addAction( 'frontend/element_ready/container', function( $scope ) {
            elementorFrontend.elementsHandler.addHandler( Glider, { $element: $scope } );
        } );
        */
        $.each( handlersList, function( widgetName, handlerClass ) {

            elementorFrontend.hooks.addAction( 'frontend/element_ready/' + widgetName, function( $scope ) {
                
                elementorFrontend.elementsHandler.addHandler( handlerClass, { $element: $scope } );

            } );

        } );

    } ); 


} ( jQuery, window ) );