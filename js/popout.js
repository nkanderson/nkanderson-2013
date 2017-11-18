// Control slide up and down for Projects and Experience boxes
// along with fade for the About box

var slide_time = 350;

// Control slide up and down from side navigation
function boxslide_click() {
	// Get class for box matching the clicked nav element
	click_box = '.' + $(this).attr('class') + '.not_visible';
	if ($(click_box).is(':hidden')) {
		$('.about').addClass('fade', slide_time);
		$(click_box).slideDown(slide_time);
		// If matching box is already visible, hide it
	} else {
		$(click_box).slideUp(slide_time);
		// If siblings are also hidden, remove fade class from About box
		if ($(click_box).siblings().is(':hidden')) {
			$('.about').removeClass('fade', slide_time);
		}
	}
};

// Make the 'x' on the popout box close the box
function x_click() {
	// Locate parent box and sibling
	click_box = $(this).parent();
	click_sibling = $(click_box).siblings();
	
	// Slide clicked box up, remove fade class from About if sibling is hidden
	$(this).parent().slideUp(slide_time);
	if ($(click_sibling).is(':hidden')) {
		$('.about').removeClass('fade', slide_time);
	};
};
