const prefix = 'repay', ns = prefix+'-';
(function( $ ) {
    'use strict';

    var prefix = 'repay',
        ns = prefix+'-';


    $(document).ready(function(){


        /**
         * Accessibility code
         * @type {jQuery}
         */

        // Adding NAV to submenus
        $('ul.sub-menu').each(function(){
            $(this).attr('role','menu');
        });

        // Look through each menu
        $('[role="menu"] li').each(function(){
            $(this).attr('role','menuitem');
        });

        // Hyperlinks that have submenus to display
        $('.menu-item-has-children a').each(function(){
            $(this).attr('aria-haspopup',"true");
            $(this).attr('aria-expanded',"false");
        });

        // On hover of an element that has a popup, toggle the Expanded attribute to true when the mouse ENTERS
        $('[aria-haspopup="true"]').mouseover(function(){
            $(this).attr('aria-expanded',"true");
        });

        // On hover of an element that has a popup, toggle the Expanded attribute to FALSE when the mouse leaves
        $('[aria-haspopup="true"]').mouseout(function(){
            $(this).attr('aria-expanded',"false");
        });

        // Look at FIGURES that have direct images
        $('figure.wp-block-image').each(function(){
            $(this).attr('role','none');
        });

        // Adding accessible hyperlink information
        $("a").each(function(){

            // Variablitize the link
            var a = $(this);

            // Get the attribute value
            var label_value = a.attr('aria-label');

            // Get the role
            var aria_role = a.attr('aria-role');

            // Get the href value
            var href = a.attr('href');

            // Get the link's target
            var target = a.attr('target');

            if(label_value === undefined || target === "_blank") {

                // Get the link text
                var link_text = a.html().replace(/(<([^>]+)>)/gi, "").trim();

                // Does it open in a new window?
                if(target === "_blank") {
                    link_text += " (new window)";
                }

                // Set the attribute
                a.attr('aria-label',link_text);

            }

            // Check for current role
            if(aria_role === undefined) {

                // Check for href and hashtag
                if(href === undefined || href === "#" || href === "javascript:void(0);") {
                    a.attr('role','button');
                }

            }

        });




        // Add padding to the body for the fixed position navbar
        let root = document.documentElement;
        var navbar_height = $('nav').outerHeight();
        root.style.setProperty('--navbar-height', navbar_height + "px");

    });

    // Toggle CSS class on navbar based on scroll position
    $(window).scroll(function (event) {

        // Get the scroll position
        var scroll_position = $(window).scrollTop();

        // If the scroll_position is greater than 50
        if(scroll_position > 50) {
            $('[data-nav-bar]').attr('data-nav-bar','middle');
        } else {
            $('[data-nav-bar]').attr('data-nav-bar','top');
        }

    });

    // Toggling the menu
    $('[data-toggle]').click(function ( e ) {

        // Make sure links don't activate
        e.preventDefault();

        // Get the element to toggle
        let element_to_toggle = $(this).attr('data-target');
        console.log(element_to_toggle);

        // Toggle this class
        let class_to_toggle = $(this).attr('data-toggle');
        console.log(class_to_toggle);

        // Toggle the CSS class
        $(element_to_toggle).toggleClass(class_to_toggle);

    });

    // Toggling submenu on mobile devices
    // $('[data-submenu-selector] > a').on('touchstart', function (e) {

    //     // Make sure the link doesn't go through
    //     e.preventDefault();

    //     // Get the parent LI tag
    //     let parent_menu_item = $(this).parent();

    //     // Get the selector for the submenu
    //     let submenu_selector = parent_menu_item.attr('data-submenu-selector');

    //     // Get the class to toggle on the submenu
    //     let submenu_toggle_css_class = parent_menu_item.attr('data-submenu-class-toggle');

    //     // Toggle the CSS class
    //     parent_menu_item.find(submenu_selector).toggleClass(submenu_toggle_css_class);

    // });


})( jQuery );


// Using a class to find and update images to be dynamically the height of their sibling column
const update_stretch_together = function() {

	const st_els = document.getElementsByClassName(ns+'stretch-together');

	if(st_els.length) {

		for(let i =0; st_els[i]; i++) {
			const cols = st_els[i].getElementsByClassName('wp-block-genesis-blocks-gb-column');

			// If his is being handled by an earlier call, let's avoid race conditions or whatever
			if(cols[0].style.height == 'auto') {
				return;
			}

			// Reset and let re-render to natural height
			cols[0].style.height = 'auto';
			cols[1].style.height = 'auto';
		}

		window['st_els'] = st_els;

		setTimeout(function(){

			const st_els = window['st_els'];

			if(st_els.length) {
				for(let i =0; st_els[i]; i++) {
					const cols = st_els[i].getElementsByClassName('wp-block-genesis-blocks-gb-column');
					// Update
					let height_0 = cols[0].offsetHeight;
					let height_1 = cols[1].offsetHeight;
					let height = (height_0 >= height_1) ? height_0 : height_1;
					const img = st_els[i].getElementsByTagName('img');
					cols[0].style.height = height+'px';
					cols[1].style.height = height+'px';
					if(img[0]) img[0].style.height = height+'px';
				}
			}

		}, 100); // Wait time for re-render
	}
}

update_stretch_together();

window.addEventListener('resize', update_stretch_together);


function random_item(items) {
	return items[Math.floor(Math.random()*items.length)];
}


window.setup_tries = 3;
function setup_scroll_class_observers() {
	// console.log('setup_scroll_class_observers:',window.setup_tries);
	window.setup_tries--;
	if(window.setup_tries <= 0) return;

	var els = document.getElementsByClassName('scroll-class');

	if(els.length == 0) setTimeout(setup_scroll_class_observers, 1500);
	else set_scroll_class_observers(els);
}

jQuery( document ).ready(function() {
	setup_scroll_class_observers();
})

function set_scroll_class_observers(els = []) {
	if(els.length == 0) return;

	if ( // IntersectionObserver not supported
			!('IntersectionObserver' in window) ||
			!('IntersectionObserverEntry' in window) ||
			!('intersectionRatio' in window.IntersectionObserverEntry.prototype))
		{
			for(var i=0; i<els.length; i++) {
				var e = els[i];
				var scroll_class = e.getAttribute('data-scroll-class');
				e.classList.add(scroll_class);
			}
	}
	else {
		var options = {
			rootMargin: "-150px 0px 0px",
			threshold: 0.5,
		};
		var observer = new IntersectionObserver(function(entries, observer) {
			for(var i=0; i<entries.length; i++) {
				var e = entries[i].target;
				var is_visible = entries[i].isIntersecting;
				var scroll_class = e.getAttribute('data-scroll-class');
				var removable = e.getAttribute('data-removable-scroll-class');
				var is_removable = (removable && removable.length && removable == 'false') ? false : true;

				if(is_visible) e.classList.add(scroll_class);
				else if(is_removable) e.classList.remove(scroll_class);
			}
		}, options);

		for(var i=0; i<els.length; i++) {
			observer.observe(els[i]);
		}
	}
}