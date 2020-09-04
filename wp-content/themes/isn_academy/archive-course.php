<?php
/**
 * Template Name: Archive course page
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

$args = [
    'post_type' => 'course',
    'post_status' => 'publish',
    'orderby' => 'rand',
    'posts_per_page' => 6,
    'post_parent' => 0,
];
$courses = new WP_Query( $args );
?>
<section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' ); ?>
    <main class="l-main">
        <div class="content-wrapper content-wrapper--with-bg">

            <?php get_template_part( 'templates/courses/ongoing', 'courses' ); ?>

            <section id="popular-courses" class="section-padding">
                <div class="section-header">
                    <h3 class="section-heading">GET STARTED NOW</h3>
                    <p>
                        Here’s a list of all the other courses available on the ISN
                        Academy Platform.
                    </p>
                </div>
                <div class="section-body learning-list d-flex flex-wrap justify-content-between">
                    <?php if ( $courses->have_posts() ) : ?>
                        <?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
                            <article class="learning-list-item d-flex flex-column mb-4">
                                
                                <div class="learning-list-image hover-zoomin">
                                    <?php the_post_thumbnail( 'medium' ) ?>
                                </div>
                                <div class="learning-list-content d-flex flex-column">
                                    <a href="<?php the_permalink();?>" class="link-to-course">
                                        <h4><?php the_title() ?></h4>
                                        <div class="course-info d-flex flex-nowrap justify-content-between">
                                            <?php
                                            $totalCourse = get_children( ['num_of_posts' => -1, 'post_parent' => get_the_ID() ], ARRAY_A );
                                            $total = count($totalCourse) + 1;
                                            $meta = get_post_meta( get_the_ID(), 'youtube_fields', true);
                                            ?>
                                            <?php if( $meta['certificate'] ) : ?>
                                                <div class="d-flex flex-column align-items-center">
                                                    <img src="<?= bloginfo( 'template_url' ) ?>/images/cert.svg" alt="Course Certificate Icon" />
                                                    <span class="course-des">Course Certificate</span>
                                                </div>
                                            <?php endif;?>
                                            <div class="d-flex flex-column align-items-center">
                                                <img src="<?= bloginfo( 'template_url' ) ?>/images/lesson.svg" alt="24 Lessons Icon" />
                                                <span class="course-des"><?= $total ?> Lessons</span>
                                            </div>
                                            <?php if( !empty($meta['length'] ) ) :?>
                                            <div class="d-flex flex-column align-items-center">
                                                <img src="<?= bloginfo( 'template_url' ) ?>/images/time.svg" alt="5hrs 30mins Icon" />
                                                <span class="course-des"><?= $meta['length']?></span>
                                            </div>
                                            <?php endif?>
                                        </div>
                                    </a>
                                </div>
                                
                            </article>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</section>
<?php
get_footer( 'dashboard' );
?>