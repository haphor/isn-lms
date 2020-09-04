<?php
/**
 * Template Name: Assessment
 * Description: A page template for Assessment Page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package isn
 *
 */
get_header( 'dashboard' );
?>
 <section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' ); ?>
  <main class="l-main">
   <div class="content-wrapper content-wrapper--with-bg">
 
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
      <article class="assessment-list-item unlocked-assessment d-flex flex-column mb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-unlock-alt" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue">TAKE QUIZ  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="assessment-list-item unlocked-assessment d-flex flex-column mb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-unlock-alt" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue">TAKE QUIZ  <i class="fa fa-angle-right" aria-hidden="true"></i></a>
       </div>
      </article>
      
      <article class="assessment-list-item locked-assessment d-flex flex-column mb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
       </div>
      </article>
      
      <article class="assessment-list-item locked-assessment d-flex flex-column mb-4">
       <div class="assessment-list-content d-flex flex-column">
        <div class="d-flex flex-row align-items-center justify-content-between">
         <h5>General Business Practices: Factory Safety Rules</h5>
         <i class="fa fa-lock" aria-hidden="true"></i>
        </div>
        <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
       </div>
      </article>
     </div>
    </sectin>

    <!-- Assessment Section -->
    <section id="certif" class="section-padding mt-5">

     <div class="section-header">
      <h3 class="section-heading">COMPLETED ASSESSMENTS</h3>
      <p>
        Here’s a look at all the assessments you can take. Complete the 
        required modules to unlock more quizzes and get certified.
      </p>
     </div>

     <div class="section-body learning-list assessment-list d-flex flex-wrap justify-content-between">   
      <article class="assessment-list-item certificate d-flex flex-column mb-4">
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
      
      <article class="assessment-list-item certificate d-flex flex-column mb-4">
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
    
   </div>
  </main>
 </section>


<?php
get_footer( 'dashboard' );
?>