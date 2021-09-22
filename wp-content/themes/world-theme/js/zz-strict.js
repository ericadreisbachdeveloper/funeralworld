(function ($, root, undefined) {
	$(function () {



		'use strict';




		// Wordpress login form
		if ( $('form[id^="loginform"]').length > 0 )  {

			 $('form[id^="loginform"]').find('label').each(function(){
				var for_attr = jQuery(this).attr('for');
				var text = jQuery(this).html();

				jQuery('input#' + for_attr).attr('placeholder', text);
			});
		}



		// Add two-part closing animation to navbar toggler
		$('button[data-target="#navmenu"]').on('click', function(){

			// the hamburger
			if( $('#navmenu').hasClass('show')) {
				$('button[data-target="#navmenu"]').addClass('user-collapsed');
				$('#navmenu').removeClass('show').attr('aria-expanded', 'false').addClass('collapsed');
				$('.navbar-toggler').attr('aria-expanded', 'false').addClass('collapsed');
			}

			// the x
			else {
				$('#navmenu').addClass('show').attr('aria-expanded', 'true').removeClass('collapsed');
				$('.navbar-toggler').attr('aria-expanded', 'true').removeClass('collapsed');
			}
		});




		// Show subnavs on mobile by clicking .open-submenu-a carets
		$('.open-submenu-a').on('click', function(){
			$(this).toggleClass('mobile-show-submenu');
			return false;
		});



		// Show subnav on mobile if clicked a menu link with href="#"
		$('.navbar-nav li a[href="#"]').on('click', function(){
			if ( $(this).parent('li').find('.open-submenu-a').hasClass('mobile-show-submenu') ) {
				$(this).parent('li').find('.open-submenu-a').removeClass('mobile-show-submenu')
			}
			else {
				$(this).parent('li').find('.open-submenu-a').addClass('mobile-show-submenu');
			}
		});



		// If viewing a child page
		// show its containing submenu on mobile by default
		if ( $('.current-menu-item').parent('ul').hasClass('sub-menu') ) {
			$('.current-menu-item').parent('ul').parent('li').find('.open-submenu-a').addClass('mobile-show-submenu');
		}


		// If viewing a parent page
		// show its child submenu on mobile by default
		if ( $('.current-menu-item').hasClass('menu-item-has-children') ) {
			 $('.current-menu-item .open-submenu-a').addClass('mobile-show-submenu');
		}



		// Toggle search form on desktop upon clicking magnifying glass icon in header
		$('a[href="#display-search"]').on('click', function(){
			if($('a[href="#display-search"]').attr('aria-pressed') == "false") {
				$('a[href="#display-search"]').attr('aria-pressed', 'true');
				$('#nav-search').focus();
 			}
			else {
				$('a[href="#display-search"]').attr('aria-pressed', 'false');
			}
			return false;
		});



		// Links in menu with id including the word "social" open in new window
		$('.menu[id*="social"]').find('li').each(function(){
			$(this).find('a').attr('target', '_blank').attr('rel', 'noopener');
		});



		// Clicking links that are strictly hash (href="#") does nothing
		$('a[href="#"]').on('click', function(){
			return false;
		});



		// console.log what has keyboard focus on Tab
		/*
		jQuery(document.body).keydown(function(e) {
			if (e.which === 9) {
				setTimeout(function() {
					console.log(document.activeElement);
				}, 100);
			}
		});
		*/



	});
})(jQuery, this);
