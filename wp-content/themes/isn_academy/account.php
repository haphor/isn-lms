<?php
/**
 * Template Name: Custom Account
 * Description: A page template for Custom Account Page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ISN_ACADEMY
 */

get_header();

?>

	<main id="primary" class="site-main" style="padding-bottom: 0px;">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
			<!-- Banner Section -->
			<section id="home-banner" style="background-image: url('<?php echo $thumb['0'];?>')">
				<div class="show-mobile">
					<?php isn_academy_post_thumbnail(); ?>
				</div>
				<div class="entry-content section-padding">
					<?php the_content(); ?>
				</div>
			</section>
			<?php wp_reset_postdata(); ?>
		<?php
		endwhile; // End of the loop.
		?>



	</main><!-- #main -->

<?php
get_footer();
