(function($) {
// карта

// YandexMap

(function() {

    function coords(str) {
        return str.split(',');
    }

    function init(options) {
        options.center = coords(options.center);

        $.each(options.data, function(key, item) {
            item.coords = coords(item.coords);
        });

        if (options.type == 'google') {

            google.maps.event.addDomListener(window, 'load', function() {
                
                var map = new google.maps.Map(document.getElementById(options.id), {
                    zoom: parseInt(options.zoom),
                    scrollwheel: false,
                    center: new google.maps.LatLng(options.center[0], options.center[1])
                });
                
                var style1 = [{"featureType":"landscape","stylers":[{"hue":"#FFA800"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FBFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#00FFFD"},{"saturation":0},{"lightness":30},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00BFFF"},{"saturation":6},{"lightness":8},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#679714"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1}]}];
                
                map.setOptions({styles: style1});

                $.each(options.data, function(key, item) {

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(item.coords[0], item.coords[1]),
                        map: map,
                        title: item.name
                    });

                    var infowindow = new google.maps.InfoWindow({
                        content: '<div class="baloon-content">' +
                                    '<h3 style="margin: 0; padding-bottom: 3px;">' + item.name + '</h3>' +
                                    item.desc +
                                '</div>'
                    });

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });

                });
            });

        } else {

            ymaps.ready(function() {

                var map = new ymaps.Map(options.id, {
                    center: options.center,
                    zoom: parseInt(options.zoom),
                    behaviors: ['drag', 'rightMouseButtonMagnifier'],
                });

                map.controls.add(
                    new ymaps.control.ZoomControl()
                );

                var MyBalloonContentLayoutClass = ymaps.templateLayoutFactory.createClass(
                    '<div class="baloon-content" style="padding: 10px 20px;">' +
                        '<h3 style="margin: 0;">$[properties.name]</h3>' +
                        '$[properties.desc]' +
                    '</div>'
                );

                var myCollection = new ymaps.GeoObjectCollection();

                $.each(options.data, function(key, item) {
                    myCollection.add(new ymaps.Placemark(
                        item.coords,
                        item, 
                        {balloonContentLayout: MyBalloonContentLayoutClass}
                    ));
                });

                map.geoObjects.add(myCollection);

            });
        }
    }

    window.mjsMap = init;
})();

// /YandexMap
	

	//деление на колонки меню

	$(function () {
        $('.top-menu > li > ul').autocolumnlist({
            columns: 3
        });
    });

	$(function() {
		var $html = $(document.documentElement),
			$doc = $(document),
			isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		
		var $doubleMenu = $('.top-menu').clone();
		
		
		
		$('table').wrap('<div class="table-wrapper"></div>');

		
		$('.reviews').addClass('owl-carousel');
		if ($('.reviews .item').length > 1) {
			$(".reviews").owlCarousel({
				loop: true,
				margin: 10,
				nav: false,
				items: 2,
				autoplay: false,
				dots: true,
				autoplayHoverPause: true,
				responsiveClass:true,
			    responsive:{
			 		0:{
		 				items:1,
			 			nav:false,
			 			dots: true
			 		},
			 		940:{
			 			items:1,
			 			nav:false,
			 			dots: true
			 		},
			 		1000:{
			 			items:2,
			 			nav:false,
			 			dots: true
			 		}
			 	},
			});
		}

		//слайдер

		if ($('.slide-in .item').length > 1) {
			$(".slide-in").owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				items: 1,
				autoplay: false,
				dots: true,
				autoplayHoverPause: true
			});
		}

		menuWidth();	

	


		// dropdown menu
		var $win = $(window),
			$doc = $(document),
			$html = $(document.documentElement),
			$body = $(document.body),
			isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
			
		
		
		var $menuButton = $('.menu-button'),
			$menuFixed = $('.menuT'),
			$topMenu = $('.top-menu');

		// Top Menu
		
			
			var $menuButton = $('.top-menu-button'),
				$menuFixed = $('.top-menu-fixed'),
				$topMenu = $('.top-menu');

				$menuButton.on("click", function(){
					$menuFixed.toggleClass('opened');
					$menuFixed.addClass('animit');
					$html.toggleClass('overflowHidden');
				});
	
				$body.on("click", function(event){
					if ($(event.target).closest(".top-menu-wrapper").length) return;
					$menuFixed.removeClass('opened');
					$html.removeClass('overflowHidden');
				});
			var rsFunc = function(){
				if ($(window).width()<=940) {
					
						
					$('.top-menu-scroll .top-menu').remove();
					$('.top-menu-scroll').append($doubleMenu.clone());
					
					$('.top-menu li.has-child a').append('<span class="tree-link"></span>');
					
					$('.top-menu li').find('a .tree-link').on('click', function(event){
						$(this).parents('li:first').siblings().removeClass('sublist-opened');
						$(this).parents('li:first').toggleClass('sublist-opened');
						console.log($(this));
						return false;
					});
	
					$body.on("touchstart", function(event){
						if ($(event.target).closest(".top-menu").length) return;
						$('.top-menu').find(' li').removeClass('sublist-opened');
					});
					
					
	
				} else {
					
					$('.top-menu-scroll .top-menu').remove();
					$('.top-menu-scroll').append($doubleMenu.clone());
					$('.top-menu').s3MenuAllIn({
							type: 'bottom',
							showFn: $.fn.fadeIn,
	        				hideFn: $.fn.fadeOut,
	        				showTime: 250,
                    		hideTime: 250
					});
				}
			}
			rsFunc();
			$(window).resize(function(){
				rsFunc();
			});
			
			
			
			
		// Top Menu End

		//form cells

		// $('.slider-block .form-row').wrap('<div class="extra-wrapper"></div>')
		/*
		$('.slider-block .form-row.text').wrapAll('<div class="text-wrapper"></div>');
		
		$('.form-row.tpl-field.text').wrapAll('<div class="text-wrapper"></div>');
		
		$('.slider-block .form-row.textarea').wrapAll('<div class="textarea-wrapper"></div>');
		
		$('.form-row.tpl-field.textarea').wrapAll('<div class="textarea-wrapper"></div>');*/

		//высота textarea

		var he = $('.slider-block .form-rows.tpl-fields').outerHeight();
		var he2 = $('.slider-block .form-row.textarea').outerHeight();
		var he3 = he-he2;

		var he4 = he2+he3;

		$('.slider-block .form-row.textarea label textarea').outerHeight(he4);


	
		$(document).keydown(function(e) {
		    if( e.keyCode === 27 ) {
		        $('.slider-block .slide-form').removeClass('active');
		        return false;
		    }
		});
		
		$('.slider-block .slide-but').on('click', function() {
			$('.slider-block .slide-form').toggleClass('active');
		});
		$('body').on('click', function(e){
			if ($(e.target).closest('.slider-block .slide-form, .slider-block .slide-but').length) return;
			if ($('.slide-form').hasClass('active')){
				$('.slider-block .slide-form').removeClass('active');
			};
		});
	
		$('.bestsellers-inner').lightGallery({
			selector : '.ls'
		});

		// search

		var $input = $(".search-text"),
			$button = $(".search-button"),
			$form = $(".search-form"),
			$doc = $(document);

		$input.on({
			focus: function() {
				var $parent = $(this).parent();
				$parent.addClass("focus");
			},

			blur: function() {
				var $parent = $(this).parent();
				$parent.removeClass("focus");
			}
		});

		
		
		
		if (isMobile) {
			$button.on("click",  function(event) {
				var $parent = $(this).parent();
	
				if (!$parent.hasClass("opened")) {
					$input.focus();
					$parent.addClass("opened")
					event.preventDefault();
				}
			});
		} else {
			$button.on("click",  function(event) {
			var $parent = $(this).parent();

			if (!$parent.hasClass("opened")) {
				$input.focus();
				$parent.addClass("opened")
				event.preventDefault();
			}
			});
		}

		$('.site-wrapper').on("click", function(event) {
			if ($(event.target).closest($form).length) return;
			$form.removeClass("opened");
			$input.blur();
		});
		
		var IsMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
			$body = $(document.body),
    		$html = $(document.documentElement);

		// Код оборачивает в бургер, пункты меню первого уровня которые не помещаются в одну строку. 
        function menuWidth() {
            var winWidth = $(window).width(), 
            MenuUl = $('.top-menu-scroll .top-menu'); // Этот класс нужно менять на свой (Тег "ul").
            if ( winWidth > 1000 && MenuUl.find('> li').length ) {
                var width_li = 0, countLi = 0, menuTWidth = MenuUl.width();

                MenuUl.find('> li').each(function() {
                    width_li += Math.ceil($(this).outerWidth());
                    countLi++;
                });

                if ( menuTWidth < width_li ) {
                    MenuUl.append("<li class='last-childrens'><a href='javascript:void(0);'>...</a><ul class='level-2'></ul></li>");
                    menuTWidth -= Math.ceil(MenuUl.find('> li.last-childrens').outerWidth());
                    for ( var i = countLi-1; menuTWidth < width_li; i-- ) {
                        width_li -= MenuUl.find('> li:not(last-childrens)').eq(i).outerWidth();
                        MenuUl.find('> li.last-childrens > ul').prepend(MenuUl.find('> li:not(last-childrens)').eq(i));    
                    }
                }        
            }


        }
	
		//var pr = $.trim($('.site-header .site-name a').text()).length
		
		//var pr = $('.site-header .site-name a').height()

		// function fontSize(h) {
		//   var height = 64; // ширина, от которой идет отсчет
		//   var fontSize =20; // минимальный размер шрифта
		//   var bodyHeight = $('.site-header .site-name a').height();
		//   var multiplier =  / height;
		//   if ($('html').height() >= height) fontSize = Math.floor(fontSize * multiplier);
		//   $('.site-header .site-name a').css({fontSize: fontSize+'px'});
		// }
		
		// function fontSize2(h) {
		// 	h = parseInt(h);
		// 	var fontSize = 2560/h;
		// 	$('.site-header .site-name a').css({
		// 		"font-size": fontSize+"px",
		// 		"line-height": "normal"
		// 	})
		// 	console.log(fontSize);
		// }
		
		/*$(function() {
			fontSize();
		});
		$('.site-header .site-name a').resize(function() {
			fontSize();
		});*/
		
		
		
		// var elHeight = $('.site-header .site-name a').height();

		// setInterval(function() {
		// 	var newHeight = $('.site-header .site-name a').height();
		// 	if (newHeight!=elHeight) {
		// 		elHeight=newHeight;
		// 		//console.log(elHeight);
		// 		fontSize2(elHeight);
				
		// 	}
			
		// }, 1000);

		

	});
	
	$(document).ready(function() {
        var $window = $(window);
        var $document = $(document);
        var countUp = window.countUp;
    
        function Element(el) {
    
            var num;
            var cls;
            var parent;
            this.el = el;
            this.$el = $(el);
            this.data = this.$el.data('s3-animator');
            this.params = this.data.split(/\s+/);
    
            if (~this.params.indexOf('counter') && countUp) {
    
                this.type = 'counter';
                num = Number(this.$el.text().replace(/\D/g, '')) || 0;
                this.counter = new countUp(this.el, 0, num, 0, 10, {
                    separator: ' ',
                    useGrouping: true,
                    useEasing: true
                });
    
            } else {
    
                this.type = 'animate';
                cls = this.params.map(function (param) {
                    return 's3-animator-' + param;
                });
                cls.push('s3-animator');
                this.cls = cls.join(' ');
    
            }
    
            if (~this.data.indexOf('bar')) {
    
                parent = this.$el.parent();
                this.height = parent.height();
                this.top = parent.offset().top;
    
            } else {
    
                this.height = this.$el.height();
                this.top = this.$el.offset().top;
    
            }
        }
    
        Element.prototype.play = function () {
            this.working = true;
            if (this.type == 'counter') {
                this.counter.start();
            } else {
                this.$el.removeClass('s3-animator-hide').addClass(this.cls);
            }
    
        };
    
        Element.prototype.stop = function () {
            this.working = false;
            if (this.type == 'counter') {
                this.counter.reset();
            } else {
                this.$el.addClass('s3-animator-hide').removeClass(this.cls);
            }
    
        };
    
        function Animator() {
    
            var self = this;
            this.offset = 10;
            this.refresh();
    
            $document.on('scroll.s3_animator', function () {
                self.check();
            });
    
            $window.on('resize.s3_animator', function () {
                self.windowHeight = $window.height();
                self.check();
            }).trigger('resize.s3_animator');
    
        }
    
        Animator.prototype.check = function () {
    
            var self = this;
            var scrollTop = $document.scrollTop();
            $.each(this.elements, function () {
                if (this.top + this.height > scrollTop + self.offset && this.top < scrollTop + self.windowHeight - self.offset) {
                    if (!(self.once && this.working)) {
                        this.play();
                    }
                } else {
                    if (!(self.once && this.working)) {
                        this.stop();
                    }
                }
            });
    
        };
    
        Animator.prototype.refresh = function () {
    
            var self = this;
            this.elements = [];
            $('[data-s3-animator]').each(function () {
                self.elements.push(new Element(this));
            });
    
        };
    
        window.s3Animator = new Animator();        
        
        s3Animator.once = true;
    
    });

})(jQuery);