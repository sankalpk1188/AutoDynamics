var THEMEMASCOT = {};
(function($) {

	"use strict";


	/* ---------------------------------------------------------------------- */
	/* --------------------------- Start Demo Switcher  --------------------- */
	/* ---------------------------------------------------------------------- */
	var showSwitcher = true;
	var $body = $('body');
	var $style_switcher = $('#style-switcher');
	if( !$style_switcher.length && showSwitcher ) {
	      $.ajax({
	          url: "color-switcher/style-switcher.html",
	          success: function (data) { $body.append(data); },
	          dataType: 'html'
	      });
	}

	/* ---------------------------------------------------------------------- */
	/* ----------------------------- En Demo Switcher  ---------------------- */
	/* ---------------------------------------------------------------------- */


	THEMEMASCOT.isRTL = {
	    check: function() {
	      if( $( "html" ).attr("dir") === "rtl" ) {
	        return true;
	      } else {
	        return false;
	      }
	    }
	};

	THEMEMASCOT.isLTR = {
	    check: function() {
	      if( $( "html" ).attr("dir") !== "rtl" ) {
	        return true;
	      } else {
	        return false;
	      }
	    }
	};

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- En Demo Switcher  ---------------------- */
    /* ---------------------------------------------------------------------- */

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(200).fadeOut(500);
		}
	}

	//Update Header Style and Scroll to Top
	// function headerStyle() {
	// 	if($('.main-header').length){
	// 		var windowpos = $(window).scrollTop();
	// 		var siteHeader = $('.header-style-one');
	// 		var scrollLink = $('.scroll-to-top');
	// 		var sticky_header = $('.main-header .sticky-header');
	// 		if (windowpos > 100) {
	// 			sticky_header.addClass("fixed-header animated slideInDown");
	// 			scrollLink.fadeIn(300);
	// 		}else {
	// 			sticky_header.removeClass("fixed-header animated slideInDown");
	// 			scrollLink.fadeOut(300);
	// 		}
	// 		if (windowpos > 1) {
	// 			siteHeader.addClass("fixed-header");
	// 		}else {
	// 			siteHeader.removeClass("fixed-header");
	// 		}
	// 	}
	// }
	function headerStyle() {
		if ($('.main-header').length) {

			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-to-top');
			var sticky_header = $('.main-header .sticky-header');
			var scrollSection = $('.scroll-section');

			// Disable sticky only while inside custom scroll-section (if present)
			if (scrollSection.length) {
				var sectionTop = scrollSection.offset().top;
				var sectionBottom = sectionTop + scrollSection.outerHeight();
				if (windowpos >= sectionTop && windowpos <= sectionBottom) {
					sticky_header.removeClass("fixed-header animated slideInDown");
					siteHeader.removeClass("fixed-header");
					scrollLink.fadeOut(300);
					return;
				}
			}

			// ✅ section nantar normal behavior
			if (windowpos > 100) {
				sticky_header.addClass("fixed-header animated slideInDown");
				scrollLink.fadeIn(300);
			} else {
				sticky_header.removeClass("fixed-header animated slideInDown");
				scrollLink.fadeOut(300);
			}

			if (windowpos > 1) {
				siteHeader.addClass("fixed-header");
			} else {
				siteHeader.removeClass("fixed-header");
			}
		}
	}
	headerStyle();

	// Submenu dropdown toggle — only items with a real submenu (skip plain .dropdown links like Home / Capabilities / Contact)
	$('.main-header .navigation > li.dropdown').each(function () {
		var $li = $(this);
		if ($li.children('ul').length && !$li.children('.dropdown-btn').length) {
			$li.append('<div class="dropdown-btn"><i class="fa fa-angle-down"></i></div>');
		}
	});

	//Dropdown Button
	$('.pricing-tabs .tab-buttons .yearly').on('click', function() {
		$('.round').addClass('boll-right');
	});
	
	//Dropdown Button
	$('.pricing-tabs .tab-buttons .monthly').on('click', function() {
		$('.round').removeClass('boll-right');
	});

	//Hidder bar
	if ($('.hidden-bar').length){
		//Menu Toggle Btn
		$('.toggle-hidden-bar').on('click', function() {
			$('body').addClass('active-hidden-bar');
		});

		//Menu Toggle Btn
		$('.hidden-bar-back-drop, .hidden-bar .close-btn').on('click', function() {
			$('body').removeClass('active-hidden-bar');
		});
	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){

		var mobileMenuContent = $('.main-header .main-menu .navigation').html();

		$('.mobile-menu .navigation').append(mobileMenuContent);
		$('.sticky-header .navigation').append(mobileMenuContent);
		$('.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});

		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
			$(this).toggleClass('active');
			$(this).prev('.mega-menu').slideToggle(500);
		});

		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop, .mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});

	}

	//Header Search
	if($('.search-btn').length) {
		$('.search-btn').on('click', function() {
			$('.main-header').addClass('moblie-search-active');
		});
		$('.close-search, .search-back-drop').on('click', function() {
			$('.main-header').removeClass('moblie-search-active');
		});
	}

    // count Bar
	if ($(".count-bar").length) {
		$(".count-bar").appear(
			function () {
				var el = $(this);
				var percent = el.data("percent");
				$(el).css("width", percent).addClass("counted");
			}, {
				accY: -50
			}
			);
	}

	// Single Item Swiper
	if ($('.single-item_swiper').length) {  
		var swiper = new Swiper(".single-item_swiper", {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			centeredSlides: true,
			navigation: {
				nextEl: ".single-button-next",
				prevEl: ".single-button-prev",
			},
			pagination: {
				el: ".single-item-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 1,
				},
				1200: {
					slidesPerView: 1,
				},
				1000: {
					slidesPerView: 1,
				},
				970: {
					slidesPerView: 1,
				},
				650: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}

	// Testimonial Swiper
	if ($('.testimonial-swiper').length) {  
		var swiper = new Swiper(".testimonial-swiper", {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: true,
			centeredSlides: true,
			navigation: {
				nextEl: ".testimonial-button-next",
				prevEl: ".testimonial-button-prev",
			},
			pagination: {
				el: ".testimonial-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 1,
				},
				1200: {
					slidesPerView: 1,
				},
				1000: {
					slidesPerView: 1,
				},
				970: {
					slidesPerView: 1,
				},
				650: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}



	// Three Item Swiper
	if ($('.three-item_swiper').length) {  
		var swiper = new Swiper(".three-item_swiper", {
			slidesPerView: 3,
			spaceBetween: 50,
			loop: false,
			//centeredSlides: true,
			navigation: {
				nextEl: ".three-item_button-next",
				prevEl: ".three-item_button-prev",
			},
			pagination: {
				el: ".three-item-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 3,
				},
				1000: {
					slidesPerView: 2,
				},
				970: {
					slidesPerView: 2,
				},
				650: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}



	// Process Item Swiper
	if ($('.process-item_swiper').length) {  
		var swiper = new Swiper(".process-item_swiper", {
			slidesPerView: 3,
			spaceBetween: 30,
			loop: true,
			centeredSlides: true,
			navigation: {
				nextEl: ".process-item_button-next",
				prevEl: ".process-item_button-prev",
			},
			pagination: {
				el: ".process-item-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 3,
				},
				1200: {
					slidesPerView: 2,
				},
				1100: {
					slidesPerView: 2,
					centeredSlides: false
				},
				1000: {
					slidesPerView: 1,
					centeredSlides: false
				},
				650: {
					slidesPerView: 1,
					centeredSlides: false
				},
				480: {
					slidesPerView: 1,
					centeredSlides: false
				},
				0: {
					slidesPerView: 1,
					centeredSlides: false
				},
			},
		});
	}



	// Two Item Swiper
	if ($('.two-item_swiper').length) {  
		var swiper = new Swiper(".two-item_swiper", {
			slidesPerView: 2,
			spaceBetween: 30,
			loop: true,
			//centeredSlides: true,
			navigation: {
				nextEl: ".two-item_button-next",
				prevEl: ".two-item_button-prev",
			},
			pagination: {
				el: ".two-item-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 2,
				},
				1200: {
					slidesPerView: 2,
				},
				1000: {
					slidesPerView: 2,
				},
				970: {
					slidesPerView: 2,
				},
				650: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 1,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}



	// Four Item Swiper
	if ($('.four-item_swiper').length) {  
		var swiper = new Swiper(".four-item_swiper", {
			slidesPerView: 4,
			spaceBetween: 30,
			loop: false,
			//centeredSlides: true,
			navigation: {
				nextEl: ".four-item_button-next",
				prevEl: ".four-item_button-prev",
			},
			pagination: {
				el: ".four-item-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 3,
				},
				1000: {
					slidesPerView: 3,
				},
				970: {
					slidesPerView: 2,
				},
				650: {
					slidesPerView: 2,
				},
				600: {
					slidesPerView: 1,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}


	// Clients Swiper
	if ($('.clients_swiper').length) {  
		var swiper = new Swiper(".clients_swiper", {
			slidesPerView: 5,
			spaceBetween: 30,
			loop: false,
			//centeredSlides: true,
			navigation: {
				nextEl: ".clients_button-next",
				prevEl: ".clients_button-prev",
			},
			pagination: {
				el: ".clients-pagination",
				clickable: true,
			},
			breakpoints: {
				1500: {
					slidesPerView: 5,
				},
				1200: {
					slidesPerView: 4,
				},
				1000: {
					slidesPerView: 4,
				},
				970: {
					slidesPerView: 3,
				},
				650: {
					slidesPerView: 3,
				},
				400: {
					slidesPerView: 2,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}



	
	// Banner Swiper
	if ($('.banner-swiper').length) {  
		var swiper = new Swiper(".banner-swiper", {
			slidesPerView: 1,
			loop: true,
			slidesPerGroupSkip: 1,
      		grabCursor: true,
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},
			scrollbar: {
			  el: ".swiper-scrollbar",
			  //hide: true,
			  draggable: true,
			  grabCursor:true,
			  
			},
		});
	}


	// Expand Section
	gsap.to(".expand-section", {
		width: "100%",  // Expands to full width
		//borderRadius:0,
		ease: "power2.out",
		scrollTrigger: {
			trigger: ".expand-section",
			start: "top 70%",
			end: "top 5%",
			scrub: true
		}
	});


	//Denge Chars Animation
  gsap.registerPlugin(ScrollTrigger, SplitText);

  window.addEventListener('load', function () {
    const blocks = gsap.utils.toArray('.denge-chars');

    blocks.forEach(el => {
      // Split only once
      const split = new SplitText(el, { type: 'chars' });
      gsap.set(el, { perspective: 400, overflow: 'visible' });

      // Keep visible before animation starts
      gsap.set(split.chars, { opacity: 1 });

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: el,
          start: 'top 90%',
          end: 'bottom 60%',
          toggleActions: 'play none none none',
          once: true // optional: run once and keep final state
        }
      });

      tl.from(split.chars, {
        duration: 0.9,
        opacity: 0,
        scale: 0.85,
        y: 30,
        rotationX: 80,
        transformOrigin: '0% 50% 0',
        stagger: 0.035,
        ease: 'back.out(1.6)',
        immediateRender: false // <— critical to prevent pre-hiding
      });
    });

    // Ensure measurements are correct after fonts/images load
    ScrollTrigger.refresh();
  });


	// Word Animation
	let wordsAnimation = gsap.utils.toArray(".denge-words");
	wordsAnimation.forEach(splitWords => {
		const tl = gsap.timeline({
		scrollTrigger: {
			trigger: splitWords,
			start: 'top 90%',
			end: 'bottom 60%',
			scrub: false,
			toggleActions: 'play none none none'
		}
		});

		const textSplitWords = new SplitText(splitWords, { type: "words" });
		gsap.set(splitWords, { perspective: 400 });
		textSplitWords.split({ type: "words" })
		tl.from(textSplitWords.words, {
		duration: 1,
		delay: 0.3,
		opacity: 0,
		rotationX: 10,
		x: 50,
		force3D: true,
		transformOrigin: "top center -50",
		stagger: 0.1,
		});
	});
	


	var parallaxImage = gsap.utils.toArray('.parallax-image');			
	parallaxImage.forEach(function(P) {
		var bg = P.querySelector("img");
		var parallax = gsap.fromTo( bg, {y: '-5%'}, {y: '10%', duration: 1, ease:Linear.easeNone});		
		ScrollTrigger.create({
		trigger: P,
		start: "top+=10% 100%",
		end: () => `+=${P.offsetHeight + window.innerHeight}`,
		animation: parallax,
		scrub: true,
		});
	});


	// Button Hover Animation
	$('.banner-four_explore').on('mouseenter', function (e) {
		var x = e.pageX - $(this).offset().left;
		var y = e.pageY - $(this).offset().top;
	
		$(this).find('span').css({
		  top: y,
		  left: x
		});
	});



	// Service Section Five
	if ($('.service-section-five').length) {
		document.addEventListener('DOMContentLoaded', function () {
			// Get all columns and image layers
			const columns = document.querySelectorAll('.service-section-five .column');
			const imageLayers = document.querySelectorAll('.service-section-five .image-layer');

			// Set the first column and first image as active by default
			let lastActiveIndex = 0;
			columns[lastActiveIndex].classList.add('active');
			imageLayers[lastActiveIndex].classList.add('active');

			// Add hover event listeners to each column
			columns.forEach((column, index) => {
				column.addEventListener('mouseenter', function () {
					// Remove active class from all columns and images
					columns.forEach(col => col.classList.remove('active'));
					imageLayers.forEach(img => img.classList.remove('active'));

					// Add active class to hovered column and corresponding image
					this.classList.add('active');
					imageLayers[index].classList.add('active');

					// Update the last active index
					lastActiveIndex = index;
				});
			});

			// When mouse leaves the columns container, keep the last active column
			const outerContainer = document.querySelector('.service-section-five .outer-container');
			outerContainer.addEventListener('mouseleave', function () {
				// Do nothing; keep last active state
			});
		});
	}



	// 21. Image Reveal Animation  used
  let imgs_reveal = document.querySelectorAll(".img-reveal");

  imgs_reveal.forEach((container) => {
    let image = container.querySelector("img");
    let tl = gsap.timeline({
      scrollTrigger: {
        trigger: container,
        toggleActions: "restart none none reset"
      }
    });

    tl.set(container, { autoAlpha: 1 });
    tl.from(container, 1.5, {
      xPercent: -100,
      ease: Power2.out
    });
    tl.from(image, 1.5, {
      xPercent: 100,
      scale: 1.3,
      delay: -1.5,
      ease: Power2.out
    });
  });



	gsap.utils.toArray(".img-parallax").forEach(function(container) {
		let image = container.querySelector("img");

		let tl = gsap.timeline({
			scrollTrigger: {
				trigger: container,
				scrub: true,
				pin: false,

			},
		}); 
		tl.from(image, {
			yPercent: -30,
			ease: "none",
		}).to(image, {
			yPercent: 30,
			ease: "none",
		}); 
	});




	//Custom Seclect Box
	if($('.custom-select-box').length){
		$('.custom-select-box').selectmenu().selectmenu('menuWidget').addClass('overflow');
	}

	//Service Block Hover
	if ($('.service-block_two').length) {
		var $service_block = $('.service-block_two .inner');
		$($service_block).on('mouseenter', function (e) {
			$(this).find('.lower-box').stop().slideDown(300);
			return false;
		});
		$($service_block).on('mouseleave', function (e) {
			$(this).find('.lower-box').stop().slideUp(300);
			return false;
		});
	}



	//Progress Bar
	if($('.progress-line').length){
		$('.progress-line').appear(function(){
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width',percent+'%');
		},{accY: 0});
	}


	/* ==================================================
		Overlay Animation
	================================================== */

	gsap.registerPlugin(ScrollTrigger);

	let ofsetHeight = document.querySelector(".project-three_inner-container");
	if (ofsetHeight) {
		ScrollTrigger.matchMedia({
			"(min-width: 992px)": function () {
				let pbmitpanels = gsap.utils.toArray(".project-block_three");
				const spacer = 0;

				let pbmitheight = pbmitpanels[0].offsetHeight + 0;
				pbmitpanels.forEach((pbmitpanel, i) => {
					TweenMax.set(pbmitpanel, {
						top: i * 0
					});
					const tween = gsap.to(pbmitpanel, {
						scrollTrigger: {
							trigger: pbmitpanel,
							start: () => `top bottom-=100`,
							end: () => `top top+=40`,
							scrub: true,
							invalidateOnRefresh: true
						},
						ease: "none",
						scale: () => 1 - (pbmitpanels.length - i) * 0
					});
					ScrollTrigger.create({
						trigger: pbmitpanel,
						start: () => "top 40px",
						endTrigger: '.project-three_inner-container',
						end: `bottom top+=${pbmitheight + (pbmitpanels.length * spacer)}`,
						pin: true,
						pinSpacing: false,
					});
				});
			},
			"(max-width:1025px)": function () {
				ScrollTrigger.getAll().forEach(pbmitpanels => pbmitpanels.kill(true));
			}
		});
	}





	//Accordion Box
	if ($('.accordion-box').length) {
		$(".accordion-box").on('click', '.acc-btn', function () {
			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');

			if ($(this).hasClass('active') !== true) {
				$(outerBox).find('.accordion .acc-btn').removeClass('active ');
			}

			if ($(this).next('.acc-content').is(':visible')) {
				return false;
			} else {
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);
			}
		});
	}

	// Accordion Box Two
	if ($('.accordion-box_two').length) {
	$(".accordion-box_two").on('click', '.acc-btn', function () {
		var outerBox = $(this).parents('.accordion-box_two');
		var target = $(this).parents('.accordion');

		var isActive = $(this).hasClass('active');

		if (isActive) {
		// If clicked accordion is already active, collapse it
		$(this).removeClass('active');
		target.removeClass('active-block');
		target.children('.acc-content, .accordion-content').slideUp(300);
		} else {
		// Otherwise, open it and close others
		$(outerBox).find('.accordion .acc-btn').removeClass('active');
		$(outerBox).children('.accordion').removeClass('active-block');
		$(outerBox).find('.accordion').children('.acc-content, .accordion-content').slideUp(300);

		$(this).addClass('active');
		target.addClass('active-block');
		target.children('.acc-content, .accordion-content').slideDown(300);
		}
	});
	}


	if ($('.accordion-box_three').length) {
		$(".accordion-box_three").on('click', '.acc-btn', function () {
			var outerBox = $(this).parents('.accordion-box_three');
			var target = $(this).parents('.accordion');
			var isActive = $(this).hasClass('active');
			var index = target.index();

			if (isActive) {
			// Collapse if active
			$(this).removeClass('active');
			target.removeClass('active-block');
			target.children('.acc-content, .accordion-content').slideUp(300);
			} else {
			// Close others
			$(outerBox).find('.accordion .acc-btn').removeClass('active');
			$(outerBox).children('.accordion').removeClass('active-block');
			$(outerBox).find('.accordion').children('.acc-content, .accordion-content').slideUp(300);

			// Open current
			$(this).addClass('active');
			target.addClass('active-block');
			target.children('.acc-content, .accordion-content').slideDown(300);
			}

			// Show corresponding image
			var $imageWrapper = $('.images-outer .image');
			$imageWrapper.hide().eq(index).show();
		});
	}

	if ($('.accordion-box_four').length) {
		// Initialize - show first accordion and first image by default
		$('.accordion-box_four .accordion').first().addClass('active-block');
		$('.accordion-box_four .accordion .acc-btn').first().addClass('active');
		$('.accordion-box_four .accordion .acc-content').first().slideDown(300);
		$('.images-outer .image').hide().first().show();

		$(".accordion-box_four").on('click', '.acc-btn', function() {
			var outerBox = $(this).parents('.accordion-box_four');
			var target = $(this).parents('.accordion');
			var isActive = $(this).hasClass('active');
			var index = target.index();

			if (isActive) {
				// Collapse if active
				$(this).removeClass('active');
				target.removeClass('active-block');
				target.children('.acc-content, .accordion-content').slideUp(300);
			} else {
				// Close others
				$(outerBox).find('.accordion .acc-btn').removeClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content, .accordion-content').slideUp(300);

				// Open current
				$(this).addClass('active');
				target.addClass('active-block');
				target.children('.acc-content, .accordion-content').slideDown(300);
			}

			// Show corresponding image
			var $imageWrapper = $('.images-outer .image');
			$imageWrapper.hide().eq(index).show();
		});
	}

	// Accordion Box Five
	if ($('.accordion-box_five').length) {
		$(".accordion-box_five").on('click', '.acc-btn', function () {
			var outerBox = $(this).parents('.accordion-box_five');
			var target = $(this).parents('.accordion');
			var isActive = $(this).hasClass('active');
			if (isActive) {
			// If clicked accordion is already active, collapse it
			$(this).removeClass('active');
			target.removeClass('active-block');
			target.children('.acc-content, .accordion-content').slideUp(300);
			} else {
			// Otherwise, open it and close others
			$(outerBox).find('.accordion .acc-btn').removeClass('active');
			$(outerBox).children('.accordion').removeClass('active-block');
			$(outerBox).find('.accordion').children('.acc-content, .accordion-content').slideUp(300);

			$(this).addClass('active');
			target.addClass('active-block');
			target.children('.acc-content, .accordion-content').slideDown(300);
			}
		});
	}



	// Tabs Box
	if($('.tabs-box').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(300);
				$(target).addClass('active-tab');
			}
		});
	}



	
	//Gallery Filters
	if($('.filter-list').length){
		$('.filter-list').mixItUp({});
	}



	//Fact Counter + Text Count
	if($('.count-box').length){
		$('.count-box').appear(function(){
			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);

			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}
		},{accY: 0});
	}



	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}


	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 0);

		});
	}

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}


	$(document).ready(function() {
		var st = $(".tx-split-text");
        if(st.length == 0) return;
        gsap.registerPlugin(SplitText);
        st.each(function(index, el) {
            el.split = new SplitText(el, { 
                type: "lines,words,chars",
                linesClass: "split-line"
            });
            gsap.set(el, { perspective: 400 });

            if( $(el).hasClass('split-in-fade') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    ease: "Back.easeOut",
                });
            }
            if( $(el).hasClass('split-in-right') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    x: "50",
                    ease: "Back.easeOut",
                });
            }
            if( $(el).hasClass('split-in-left') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    x: "-50",
                    ease: "circ.out",
                });
            }
            if( $(el).hasClass('split-in-up') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    y: "80",
                    ease: "circ.out",
                });
            }
            if( $(el).hasClass('split-in-down') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    y: "-80",
                    ease: "circ.out",
                });
            }
            if( $(el).hasClass('split-in-rotate') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    rotateX: "50deg",
                    ease: "circ.out",
                });
            }
            if( $(el).hasClass('split-in-scale') ){
                gsap.set(el.split.chars, {
                    opacity: 0,
                    scale: "0.5",
                    ease: "circ.out",
                });
            }
            el.anim = gsap.to(el.split.chars, {
                scrollTrigger: {
                    trigger: el,
                    // toggleActions: "restart pause resume reverse",
                    start: "top 90%",
                },
                x: "0",
                y: "0",
                rotateX: "0",
                scale: 1,
                opacity: 1,
                duration: 0.8, 
                stagger: 0.02,
            });
        });
	});


/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function() {
		headerStyle();
	});

/* ==========================================================================
   When document is loading, do
   ========================================================================== */

	$(window).on('load', function() {
		handlePreloader();
	});

})(window.jQuery);


