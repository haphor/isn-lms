<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ISN_ACADEMY
 */

get_header();
?>

	<main id="primary" class="site-main site-main d-flex flex-nowrap align-items-center" style="background-image: url('<?= bloginfo('template_url');?>/images/404-cropped.jpg');background-position: 85% center;background-repeat: no-repeat;background-color: #344a5f;background-size: 200px 285px;margin-top: 30px;padding: 40px 50px;min-height: 500px;color: #fff;">

		<section class="error-404 not-found d-flex flex-column align-itmes-center">
			<header class="page-header">
				<h1 style="color: #fff;line-height: 50px;margin: 0px 0px -10px;" class="page-title"><?php esc_html_e( 'Something’s wrong here……', 'isn_academy' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'we can’t find the page you’re looking for. Use the above Navigation, Check out our Dashboard or head back to Home.', 'isn_academy' ); ?></p>
				<div style="max-width: 280px;" class="d-flex flex-row flex-nowrap justify-content-between align-items-center">
					<a href="<?php echo home_url(); ?>/dashboard" class="btn btn-blue">Dashboard</a>
					<a href="<?php echo home_url(); ?>" class="btn btn-white">Home</a>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
