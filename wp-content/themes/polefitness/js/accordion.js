jQuery(document).ready(function($){
  $('.js-accordion-trigger').bind('click', function(e){
    jQuery(this).parent().find('.accordion-content').slideToggle('fast');
    jQuery(this).parent().toggleClass('is-expanded');
    e.preventDefault();
  });
});