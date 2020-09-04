/**
 * File nmain.js.
 *
 * Handles all the script interaction on the website
 * Created by Emmanuel
 */
(function($) {

// Use $() inside of this function
 $(document).ready(function(){
  
  // Home tab control
  jQuery("#home-account .um-right a" ).removeAttr("href");
  // jQuery("#home-account .login-submit").append('<span class="btn btn-reg-toggle">Create Account</span>');

  $(function(){
   $( "#hom_reg" ).hide();// hide it initially
   $( "#home-account .um-right a" ).on('click', function(){
    $( "#hom_login, #hom_reg" ).fadeToggle( 500 );
    // $("#hom_login, #hom_reg").toggle();
   });
  });

  $( "input#user_login" ).attr( "placeholder", "Email Address" );
  $( "input#username-50" ).attr( "placeholder", "Email Address" );
  $( "input#user_pass" ).attr( "placeholder", "Password" );
  $( "#home-account .um-field-checkbox-option" ).html( "Remember Me" );

  $( "#menu-footer-extras" ).addClass( "menu d-flex flex-row flex-wrap" );
  $( "#dashboard-menu li" ).addClass( "c-menu__item has-submenu" );

  $(".home #quick-learning #dashboard .has-dropdown").click(function () {
   $(this).find(".c-dropdown").toggleClass("c-dropdown-show");
  });

 });

}( jQuery ) );