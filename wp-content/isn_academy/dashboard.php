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
 * @package isn
 *
 */
get_header( 'dashboard' );
?>
 <section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' ); ?>
  <main class="l-main">
   <div class="content-wrapper content-wrapper--with-bg">

<?php
$args = [
    'post_type' => 'course',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'posts_per_page' => 6,
    'post_parent' => 0,
];
$loop = new WP_Query( $args );
set_query_var( 'accordion', $loop );
?>
       <?php if( ! is_user_logged_in() ) :
           set_query_var( 'courses', $loop );
           get_template_part( 'templates/parts/general', 'view' );
       ?>


       <?php else :?>

       <?php
           get_template_part( 'templates/courses/currently', 'watching' );

           get_template_part( 'templates/courses/ongoing', 'courses' );
       ?>
       <?php endif; ?>
   </div>
  </main>
 </section>


<?php
get_footer( 'dashboard' );
?>