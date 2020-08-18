<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
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

	<main id="primary" class="site-main">

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
			
			<!-- Quick Learning Section -->
			<section id="quick-learning" class="section-padding">
				<div class="section-header d-md-flex flex-wrap justify-content-between align-items-center">
					<h3>Quick Learnings</h3>
					<div class="section-filters d-flex justify-content-between">
						<span class="d-flex flex-nowrap justify-content-between align-items-center mr-3"> <b class="mr-3">All Learnings</b> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span>
						<span class="d-flex flex-nowrap justify-content-between align-items-center"> <b class="mr-3">All Specialities</b> <i class="fa fa-chevron-down" aria-hidden="true"></i> </span>
					</div>
				</div>
				<div class="section-body learning-list d-flex flex-wrap justify-content-between">
					
					<article class="learning-list-item d-flex flex-column learning-pdf pb-4">
						<div class="learning-list-content d-flex flex-column">
							<h4>Obtaining ICE Views to Visualize Ventricular Anatomy with Joshua Silverstein, MD</h4>
							<span class="learning-info">20 Pages</span>
						</div>
						<div class="learning-list-image">
							<span class="learning-action"><i class="fa fa-download" aria-hidden="true"></i></span>
							<span class="learning-doc"><img src="<?= bloginfo('template_url');?>/images/learning-pdf.jpg" alt="Learning Document Image" /></span>
						</div>
					</article>
					
					<article class="learning-list-item d-flex flex-column learning-video pb-4">
						<div class="learning-list-content d-flex flex-column">
							<h4>Plating Advancements for Fracture Fixation with Michael P. Kowaleski DVM, DACVS, DECVS</h4>
							<span class="learning-info">47mins 32 secs</span>
						</div>
						<div class="learning-list-image">
							<img src="<?= bloginfo('template_url');?>/images/learning-video.jpg" alt="Learning Featured Image" />
							<span class="learning-action"><i class="fa fa-play" aria-hidden="true"></i></span>
						</div>
					</article>
					
					<article class="learning-list-item d-flex flex-column learning-pdf pb-4">
						<div class="learning-list-content d-flex flex-column">
							<h4>Posterior Correction of Adolescent Idiopathic Scoliosis with Attention</h4>
							<span class="learning-info">20 Pages</span>
						</div>
						<div class="learning-list-image">
							<span class="learning-action"><i class="fa fa-download" aria-hidden="true"></i></span>
							<span class="learning-doc"><img src="<?= bloginfo('template_url');?>/images/learning-pdf.jpg" alt="Learning Document Image" /></span>
						</div>
					</article>
				
				</div>
			</section>

			<!-- Popular Courses Section -->
			<section id="popular-courses" class="section-padding">

				<div class="section-header d-md-flex flex-wrap justify-content-between align-items-center">
					<h3>Popular Courses</h3>
					<a href="#" class="btn btn-blue">View All</a>
				</div>

				<div class="section-body learning-list d-flex flex-wrap justify-content-between">
					
					<article class="learning-list-item d-flex flex-column pb-4">
						<div class="learning-list-image">
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
									<img src="<?= bloginfo('template_url');?>/images/login.svg" alt="Login Required Icon" />
									<span class="course-des">Login Required</span>
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
					
					<article class="learning-list-item d-flex flex-column pb-4">
						<div class="learning-list-image">
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
									<img src="<?= bloginfo('template_url');?>/images/login.svg" alt="Login Required Icon" />
									<span class="course-des">Login Required</span>
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
					
					<article class="learning-list-item d-flex flex-column pb-4">
						<div class="learning-list-image">
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
									<img src="<?= bloginfo('template_url');?>/images/login.svg" alt="Login Required Icon" />
									<span class="course-des">Login Required</span>
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

		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
