
<?php
/**
 * Template Name: Dashboard
 * Description: A page template for Dashboard Page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package neconde
 *
 */
get_header( 'dashboard' );
?>
 <section id="dashboard-content">
  <sidebar class="sidebar-is-expanded">
    <header class="l-header">
      <div class="l-header__inner clearfix">
        <div class="c-search">
          <input class="c-search__input u-input" placeholder="&#128269;  Search for something" type="text"/>
        </div>
        <div class="header-icons-group">
          <div class="c-header-icon has-dropdown">
            <span class="c-badge c-badge--header-icon animated shake">87</span>
            <i class="fa fa-bell"></i>
            <div class="c-dropdown c-dropdown--notifications">
              <div class="c-dropdown__header"></div>
              <div class="c-dropdown__content"></div>
            </div>
          </div>
          <div class="c-header-profile d-flex align-items-center pl-4">
           <div class="c-header-profile-avatar mr-4">
            <img src="<?= bloginfo('template_url');?>/images/user-avatar.jpg" alt="Profile Picture"/>
           </div>
           <div class="c-header-profile-name">Lekan Akinsaya</div>
           <div class="c-header-icon has-dropdown">
             <i class="fa fa-angle-down"></i>
             <div class="c-dropdown">
               <div class="c-dropdown__header"></div>
               <div class="c-dropdown__content"></div>
             </div>
           </div>
          </div>
          <!-- <div class="c-header-icon logout"><i class="fa fa-power-off"></i></div> -->
        </div>
      </div>
    </header>
    <div class="l-sidebar">
      <div class="logo">
        <div class="js-hamburger">
         <div class="logo__txt">
          <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
         </div>
        </div>
      </div>
      <div class="l-sidebar__content">
        <nav class="c-menu js-menu">
          <ul class="u-list">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Home">
              <div class="c-menu__item__inner">
               <i class=""><img src="<?= bloginfo('template_url');?>/images/home.svg" alt="Home Icon"/></i>
               <div class="c-menu-item__title">
                <span>Home</span>
               </div>
              </div>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Courses">
              <div class="c-menu__item__inner">
               <i class=""><img src="<?= bloginfo('template_url');?>/images/course.svg" alt="Courses Icon"/></i>
               <div class="c-menu-item__title">
                <span>Courses</span>
               </div>
                <div class="c-menu-item__expand js-expand-submenu"><i class="fa fa-angle-down"></i></div>
              </div>
              <ul class="c-menu__submenu u-list">
                <li>Payments</li>
                <li>Maps</li>
                <li>Notifications</li>
              </ul>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Assessments">
              <div class="c-menu__item__inner">
               <i class=""><img src="<?= bloginfo('template_url');?>/images/assessment.svg" alt="Assessments Icon"/></i>
               <div class="c-menu-item__title">
                <span>Assessments</span>
               </div>
              </div>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Certificates">
              <div class="c-menu__item__inner">
               <i class=""><img src="<?= bloginfo('template_url');?>/images/certificates.svg" alt="Certificates Icon"/></i>
               <div class="c-menu-item__title">
                <span>Certificates</span>
               </div>
              </div>
            </li>
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Log Out">
              <div class="c-menu__item__inner">
               <i class=""><img src="<?= bloginfo('template_url');?>/images/logout.svg" alt="Log Out Icon"/></i>
               <div class="c-menu-item__title">
                <span>Log Out</span>
               </div>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </sidebar>
  <main class="l-main">
   <div class="content-wrapper content-wrapper--with-bg">

    <!-- Last Section -->
    <section id="last-section" class="section-padding d-flex flex-column">
     <div class="section-header">
      <h3 class="section-heading">CONTINUE READING</h3>
      <p>Pick up where you left off:</p>
     </div>
     <div class="d-flex flex-row">
      <div class="col-12 col-sm-6 section-img hover-zoomin">
       <img src="<?= bloginfo('template_url');?>/images/dashboard-banner.jpg" alt="Dashboard Banner" />
      </div>
      <div class="d-flex align-items-center pl-3 last-section-content">
       <div class="d-flex flex-column">
        <h4>Introduction to Clinical Laboratory Science</h4>
        <p>
         Introduction to Clinical Laboratory ScienceIn anim consectetur pariatur laboris. 
         Aute enim et voluptate sunt cillum laborum. Sunt est voluptate ipsum excepteur aute 
         esse et excepteur eiusmod occaecat tempor nisi quis. Aliqua. In anim consectetur 
         pariatur laboris. Aute enim et voluptate sunt cillum.
        </p>
        <div class="course-info d-flex flex-row flex-nowrap align-items-center justify-content-between">

         <div class="d-flex flex-row justify-content-center">
          <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
          <span class="course-des">24 Lessons</span>
         </div>

         <div class="d-flex flex-row align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
          <span class="course-des">5hrs 30mins</span>
         </div>
         
        </div>
        <a href="#" class="btn btn-blue">CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </div>
     </div>
    </section>
 
    <!-- Ongoing Courses Section -->
    <section id="ongoing-courses" class="section-padding">
     <div class="section-header">
      <h3 class="section-heading">ONGOING COURSES</h3>
      <p>
       Here’s a look at all the courses you’re currently taking. 
       Complete these courses so you can generate your certificate.
      </p>
     </div>

     <div class="section-body learning-list d-flex flex-wrap justify-content-between">
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/course-1.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Essential Tips and Tricks for Collecting Samples for Blood Tests</h4>
        <a href="#" class="btn btn-blue">CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/course-2.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>The Invention of X-Rays and How They Have Radicalized The Age of Modern Medicine</h4>
        <a href="#" class="btn btn-blue">CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/course-3.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        <a href="#" class="btn btn-blue">CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>

     </div>

    </section>
 
    <!-- Assessment Section -->
    <section id="assessment" class="section-padding">
     <div class="section-header">
      <h3 class="section-heading">ASSESSMENTS</h3>
      <p>
       Here’s a look at all the assessments you can take. Complete the 
       required modules to unlock more quizzes and get certified.
      </p>
     </div>

     <div class="section-body learning-list assessment-list d-flex flex-wrap justify-content-between">     
      <article class="assessment-list-item unlocked-assessment d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-unlock-alt" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue">TAKE QUIZ  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="assessment-list-item unlocked-assessment d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-unlock-alt" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue">TAKE QUIZ  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="assessment-list-item locked-assessment d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
       </div>
      </article>
      
      <article class="assessment-list-item locked-assessment d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
       </div>
      </article>
      
      <article class="assessment-list-item certificate d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-check" aria-hidden="true"></i>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-between">
         <a href="#" class="btn btn-blue">VIEW CERTIFICATE</a>
         <div class="grade">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
         </div>
        </div>
       </div>
      </article>
      
      <article class="assessment-list-item certificate d-flex flex-column pb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-check" aria-hidden="true"></i>
        </div>
        <div class="d-flex flex-row align-items-center justify-content-between">
         <a href="#" class="btn btn-blue">VIEW CERTIFICATE</a>
         <div class="grade">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
         </div>
        </div>
       </div>
      </article>

     </div>

    </section>

    <!-- Get Started Now Section -->
    <section id="popular-courses" class="section-padding">
     <div class="section-header">
      <h3 class="section-heading">GET STARTED NOW</h3>
      <p>
       Here’s a list of all the other courses available on the ISN 
       Academy Platform.
      </p>
     </div>

     <div class="section-body learning-list d-flex flex-wrap justify-content-between">
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/popular-courses.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        
        <div class="course-info d-flex flex-nowrap justify-content-between">

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/cert.svg" alt="Course Certificate Icon" />
          <span class="course-des">Course Certificate</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
          <span class="course-des">24 Lessons</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
          <span class="course-des">5hrs 30mins</span>
         </div>

        </div>
       </div>
      </article>
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/popular-courses.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        
        <div class="course-info d-flex flex-nowrap justify-content-between">

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/cert.svg" alt="Course Certificate Icon" />
          <span class="course-des">Course Certificate</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
          <span class="course-des">24 Lessons</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
          <span class="course-des">5hrs 30mins</span>
         </div>

        </div>
       </div>
      </article>
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/popular-courses.jpg" alt="Course Featured Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        
        <div class="course-info d-flex flex-nowrap justify-content-between">

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/cert.svg" alt="Course Certificate Icon" />
          <span class="course-des">Course Certificate</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
          <span class="course-des">24 Lessons</span>
         </div>

         <div class="d-flex flex-column align-items-center">
          <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
          <span class="course-des">5hrs 30mins</span>
         </div>

        </div>
       </div>
      </article>

     </div>

    </section>

    <!-- CErtificate Section -->
    <section id="Certificates" class="section-padding">

     <div class="section-body learning-list d-flex flex-wrap justify-content-start">
      
      <article class="learning-list-item d-flex flex-column mb-4" style="padding-right: 2%;">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/certificates.jpg" alt="Certificates Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        <a href="#" class="cert-download"><i class="fa fa-download" aria-hidden="true"></i> Download PDF Certificate</a>
       </div>
      </article>
      
      <article class="learning-list-item d-flex flex-column mb-4">
       <div class="learning-list-image hover-zoomin">
        <img src="<?= bloginfo('template_url');?>/images/certificates.jpg" alt="Certificates Image" />
       </div>
       <div class="learning-list-content d-flex flex-column">
        <h4>Lab 2.0 - The Golden Age of the Clinical Laboratory: Changing the Way Healthcare is Delivered</h4>
        <a href="#" class="cert-download"><i class="fa fa-download" aria-hidden="true"></i> Download PDF Certificate</a>
       </div>
      </article>

     </div>

    </section>

   </div>
  </main>
 </section>


<?php
get_footer( 'dashboard' );
?>
 <script >
  "use strict";

  var Dashboard = function () {
   var global = {
    tooltipOptions: {
     placement: "right"
    },
    menuClass: ".c-menu"
   };

   var menuChangeActive = function menuChangeActive(el) {
    var hasSubmenu = jQuery(el).hasClass("has-submenu");
    jQuery(global.menuClass + " .is-active").removeClass("is-active");
    jQuery(el).addClass("is-active");

    // if (hasSubmenu) {
    // 	$(el).find("ul").slideDown();
    // }
   };

    jQuery('#dashboard .c-header-icon.has-dropdown').click(function () {
     jQuery(this).find('.c-dropdown').toggleClass("c-dropdown-show");
    });

   if (jQuery("sidebar").hasClass("sidebar-is-expanded")) {
     jQuery('#dashboard main.l-main').addClass("move-left");
    } 

   var sidebarChangeWidth = function sidebarChangeWidth() {
    var $menuItemsTitle = jQuery("li .menu-item__title");

    jQuery("sidebar").toggleClass("sidebar-is-reduced sidebar-is-expanded");
    jQuery(".hamburger-toggle").toggleClass("is-opened");

    if (jQuery("sidebar").hasClass("sidebar-is-expanded")) {
     jQuery('[data-toggle="tooltip"]').tooltip("destroy");
     jQuery('#dashboard main.l-main').addClass("move-left");
    } else {
     jQuery('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
     jQuery('#dashboard main.l-main').removeClass("move-left");
    }
   };

   return {
    init: function init() {
     jQuery(".js-hamburger").on("click", sidebarChangeWidth);

     jQuery(".js-menu li").on("click", function (e) {
      menuChangeActive(e.currentTarget);
     });

     jQuery('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
   };
  }();

  Dashboard.init();
  //# sourceURL=pen.js
 </script>
</body>
</html>