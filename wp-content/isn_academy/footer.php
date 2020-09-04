<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ISN_ACADEMY
 */

?>

<footer id="colophon" class="site-footer">
	<div class="d-md-flex flex-row flex-nowrap">
		<div class="col-12 col-md-3">
			<div class="site-info">
				<?php if( is_active_sidebar( 'footer1' ) ) : ?>
				<?php dynamic_sidebar( 'footer1' ); ?>
				<?php endif; ?>
			</div><!-- .site-info -->
		</div>
		<div class="col-12 col-md-9">
			<div class="col-12 d-md-flex flex-row">
				<div class="col-12 col-md-4">
					<?php if( is_active_sidebar( 'footer2' ) ) : ?>
					<div class="footer-nav">
						<?php dynamic_sidebar( 'footer2' ); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-12 col-md-4">
					<?php if( is_active_sidebar( 'footer3' ) ) : ?>
					<div class="footer-nav">
						<?php dynamic_sidebar( 'footer3' ); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="col-12 col-md-4">
					<?php if( is_active_sidebar( 'footer4' ) ) : ?>
					<div class="footer-letter">
						<?php dynamic_sidebar( 'footer4' ); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 footer-copy d-flex flex-row flex-wrap justify-content-between">
				<?php if( is_active_sidebar( 'footer5' ) ) : ?>
				<div class="footer-nav">
					<?php dynamic_sidebar( 'footer5' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- Bootstrap JavaScript Bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

</body>

</html>