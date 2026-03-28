/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {

	/**
	 * Full navigation
	 */
	const topMenuItemsWithChildren = document.querySelectorAll('#site-navigation .menu > .menu-item-has-children > a');

	// Loop through all top level menu anchors that have sub-menus
	topMenuItemsWithChildren.forEach(function(item) {

		// Listen for a click on a top level anchor whose parent list item has a sub-menu child
		item.addEventListener("click", function(event) {

			// When the anchor is click, add a class to the parent list item
			event.target.parentNode.classList.toggle("sub-menu-active");

			// Get the very first top level anchor, regardless of its parent's children
			let siblingItem = event.target.parentNode.parentNode.firstElementChild;

			// Look at each top level list item to see if any other sub-menus have the 'sub-menu-active' class
			// If any of them do, remove the class because there's a new sheriff in town (another sub-menu is open).
			do {

				if (event.target.parentNode !== siblingItem && siblingItem.classList.contains("sub-menu-active")) {
					siblingItem.classList.remove("sub-menu-active");
				}

			} while (siblingItem = siblingItem.nextElementSibling);

			event.preventDefault();
		})
	});

	// Close the active sub-menu if there's a click anywhere outside itself.
	window.document.addEventListener("click", function(event) {

		// Get the current active sub-menu.
		const activeMenu = document.querySelector(".sub-menu-active");

		// Get the active sub-menu when a click is registered inside that sub-menu.
		const clickedInsideMenu = event.target.closest(".sub-menu-active");

		// If the "outside" sub-menu click is just its toggle link, let the toggle do its job.
		if (event.target.parentNode === activeMenu) {
			event.stopPropagation();
		}

		// If there's an active sub-menu and there's a verified "outside" sub-menu click, close the active sub-menu.
		if (null !== activeMenu && null === clickedInsideMenu) {
			activeMenu.classList.remove("sub-menu-active");
		}
	});

	/**
	 * Mobile navigation toggler
	 *
	 * Credit _s by Automattic for the toggle behavior
	 * https://github.com/automattic/_s
	 */
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Conduct all the tasks required for closing the menu modal.
	function closeMenuModal() {
		siteNavigation.classList.remove("toggled");
		button.setAttribute("aria-expanded", "false");
	}

	// Close the menu if the user clicks outside the navigation container.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );
		if ( ! isClickInside ) {
			closeMenuModal();
		}
	} );

	// Close the menu if the user clicks the close button.
	const closeButton = document.querySelector(".close-menu");
	closeButton.addEventListener("click", function(event) {
		closeMenuModal();
	});

	// Close the menu modal if the user presses the ESC key.
	window.addEventListener("keydown", (event) => {
		if (event.key === "Escape") {
			closeMenuModal();
		}
	});

}() );
