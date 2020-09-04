<?php
/**
 * Template Name: Certificate
 * Description: A page template for Certificate Page
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