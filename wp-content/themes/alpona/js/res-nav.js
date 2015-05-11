// DOM ready
jQuery(function($) {

  // Create the dropdown base
  $("<select />").appendTo(".top-menu");

  // Create default option "Menu"
  $("<option />", {
	 "selected": "selected",
	 "value"   : "#",
	 "text"    : "Menu"
  }).appendTo(".top-menu select");

  // Populate dropdown with menu items
  $(".top-menu a").each(function() {
   var el = $(this);
   $("<option />", {
	   "value"   : el.attr("href"),
	   "text"    : el.text()
   }).appendTo(".top-menu select");
  });

   // To make dropdown actually work
   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
  $(".top-menu select").change(function() {
	window.location = $(this).find("option:selected").val();
  });

});