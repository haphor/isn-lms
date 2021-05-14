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
  // jQuery("#home-account .um-right a" ).removeAttr("href");
  // // jQuery("#home-account .login-submit").append('<span class="btn btn-reg-toggle">Create Account</span>');

  // $(function(){
  //  $( "#hom_reg" ).hide();// hide it initially
  //  $( "#home-account .um-right a" ).on('click', function(){
  //   $( "#hom_login, #hom_reg" ).fadeToggle( 500 );
  //   // $("#hom_login, #hom_reg").toggle();
  //  });
  // });

  $( "input#user_login" ).attr( "placeholder", "Email Address" );
  $( "input#username-50" ).attr( "placeholder", "Email Address" );
  $( "input#user_pass" ).attr( "placeholder", "Password" );
  $( "#home-account .um-field-checkbox-option" ).html( "Remember Me" );

  $( "#menu-footer-extras" ).addClass( "menu d-flex flex-row flex-wrap" );
  $( "#dashboard-menu li" ).addClass( "c-menu__item has-submenu" );

 });


 $(document).ready(function(){
  /* Check width on page load*/
  if ( $(window).width() < 1001) {
   $( "#dashboard-content > sidebar" ).addClass( "sidebar-is-reduced" );
   $( "#dashboard-content > sidebar" ).removeClass( "sidebar-is-expanded" );
   $( "#dashboard-content > main" ).removeClass( "move-left" );
  }
 });

 $(window).resize(function() {
  /*If browser resized, check width again */
  if ($(window).width() < 1001) {
   $( "#dashboard-content > sidebar" ).addClass( "sidebar-is-reduced" );
   $( "#dashboard-content > sidebar" ).removeClass( "sidebar-is-expanded" );
   $( "#dashboard-content > main" ).removeClass( "move-left" );
  }
  else {
   $( "#dashboard-content > sidebar" ).removeClass( "sidebar-is-reduced" );
   $( "#dashboard-content > sidebar" ).addClass( "sidebar-is-expanded" );
   $( "#dashboard-content > main" ).addClass( "move-left" );
  };
 });

}( jQuery ) );
