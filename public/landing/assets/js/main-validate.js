
$(document).ready(function(){
 
    $('#simple_form input, #simple_form textarea').jqBootstrapValidation({
     preventSubmit: true,
     submitSuccess: function($form, event){     
      event.preventDefault();
       },
    });

});
/*
$(function(){
$('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(400, function(){

  });
});*/