var expandButton;
var expanded;

jQuery(document).ready(init);

function init() {
	expandButton = document.getElementById('nav-expand-btn');
	expanded = false;
	/*Deleguate event listeners*/
	expandButton.addEventListener('click', changeNavState);
	jQuery('#content').ajaxComplete(hideNav);
}

function changeNavState() {
	if (expanded) {
		expanded = false;
		jQuery('nav#navbar').removeClass("nav-show");
	}
	else if (expanded == false) {
		expanded = true;
		jQuery('nav#navbar').addClass("nav-show");
	}
}

function hideNav() {
	if (expanded) {
		expanded = false;
		jQuery('nav#navbar').removeClass("nav-show");
	}
}