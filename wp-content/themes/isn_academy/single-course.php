<?php
get_header( 'dashboard' );

$args = [
    'post_type' => 'course',
    'posts_per_page' => 3,
    'post_parent' => 0,
    'post_status' => 'publish',
    'orderby' => 'rand'
];
$query = new WP_Query( $args );

$meta = get_post_meta( $post->ID, 'youtube_fields', true );
?>
<section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' );?>

    <main class="l-main single-course-page">
        <div class="content-wrapper content-wrapper--with-bg">
            <section id="last-section" class="section-padding d-flex flex-row">
                <?php
                    if( is_array( $meta ) && isset( $meta['text'] ) !== '') {
                        $videoId = $meta['text'];
                ?>
                <div class="col-7">
                    <iframe title="" width="100%" height="400"
                        src="https://www.youtube.com/embed/<?= $videoId ?>?disablekb=1&loop=1&modestbranding=1"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
                <?php } ?>
                <div class="col-5">
                    <div class="col-100" style="display: flex; justify-content: space-between">
                        <h4>
                            <?php the_title() ?>
                        </h4>
                        <?php echo do_shortcode('[course-navigation]'); ?>
                    </div>
                    <p>
                        <?php
                            if ( is_array( $meta ) && isset( $meta['textarea'] ) ) {
                                echo $meta['textarea'];
                            }
                        ?>
                    </p>
                    <ul class="sub-courses d-flex flex-column flex-wrap">
                        <?php
                            if( $post->post_parent ) :
                                $args = [
                                    'post_type' => 'course',
                                    'order' => 'ASC',
                                    'post_parent' => $post->post_parent
                                ];
                                $otherCourses = get_children($args);

                                foreach ($otherCourses as $course) {
                                    echo '<li class="d-flex flex-row justify-content-between"><b>&#8729;</b> ' . $course->post_title.'<span>0:41</span></li>';
                                }
                            ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>
 
            <!-- Assessment Section -->
            <section id="assessment" class="section-padding">
                <div class="section-header">
                    <h3 class="section-heading">ASSESSMENTS</h3>
                    <p>
                        Complete this course to unlock its assessment and get a course 
                        certificate all for free!
                    </p>
                </div>

                <div class="section-body learning-list assessment-list d-flex flex-wrap justify-content-between">
            
                    <article class="assessment-list-item locked-assessment d-flex flex-column pb-4">
                        <div class="assessment-list-content d-flex flex-column">
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <h5>General Business Practices: Factory Safety Rules</h5>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </div>
                            <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
                        </div>
                    </article>

                </div>

            </section>



			<!-- Popular Courses Section -->
            <section id="popular-courses" class="section-padding">
                <div class="section-header">
                    <h3 class="section-heading">GET STARTED NOW</h3>
                    <p>
                        Here’s a list of all the other courses available on the ISN 
                        Academy Platform.
                    </p>
                </div>

                <div class="section-body learning-list d-flex flex-wrap justify-content-between">
                    <?php if ( $query->have_posts() ) : ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <article class="learning-list-item d-flex flex-column mb-4">
                            <div class="learning-list-image hover-zoomin">
                                <?php the_post_thumbnail( 'medium' ) ?>
                            </div>
                            <div class="learning-list-content d-flex flex-column">
                                <h4><a href="<?php the_permalink();?>"><?php the_title() ?></a></h4>
                                <div class="course-info d-flex flex-nowrap justify-content-between">
                                    <?php
                                        $totalCourse = get_children( ['num_of_posts' => -1, 'post_parent' => get_the_ID() ], ARRAY_A );
                                        $total = count($totalCourse) + 1;
                                        $meta = get_post_meta( get_the_ID(), 'youtube_fields', true);
                                    ?>
                                    <?php if( $meta['certificate'] ) : ?>
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="<?= bloginfo('template_url');?>/images/cert.svg" alt="Course Certificate Icon" />
                                        <span class="course-des">Course Certificate</span>
                                    </div>
                                    <?php endif;?>
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="<?= bloginfo('template_url');?>/images/login.svg" alt="Login Required Icon" />
                                        <span class="course-des">Login Required</span>
                                    </div>

                                    <div class="d-flex flex-column align-items-center">
                                        <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
                                        <span class="course-des"><?= $total ?><br> Lessons</span>
                                    </div>

                                    <div class="d-flex flex-column align-items-center">
                                        <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
                                        <span class="course-des"><?= $meta['length']?></span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php endwhile;?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

                    <?php endif; ?>

                </div>

            </section>

        </div>
    </main>
</section>

<?php
get_footer( 'dashboard' );
?>