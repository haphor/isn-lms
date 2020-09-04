<?php
/**
 * Template for displaying courses
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.5.8
 */

get_header( 'dashboard' ); ?>
    <section id="dashboard-content">
        <?php get_template_part( 'templates/parts/sidebar', 'menu' ); ?>
            <main class="l-main parent-course-page move-left">
            <div class="content-wrapper content-wrapper--with-bg">

            <div class="<?php tutor_container_classes() ?>">
                <section id="ongoing-courses" class="section-padding">
                    <div class="section-header">
                        <h3 class="section-heading">GET STARTED NOW</h3>
                        <p>
                            Here’s a look at all the courses you’re currently taking.
                            Complete these courses so you can generate your certificate.
                        </p>
                    </div>
                        <?php
                        do_action('tutor_course/archive/before_loop');

                        if ( have_posts() ) :
                            /* Start the Loop */

                            tutor_course_loop_start();

                            while ( have_posts() ) : the_post();
                                /**
                                 * @hook tutor_course/archive/before_loop_course
                                 * @type action
                                 * Usage Idea, you may keep a loop within a wrap, such as bootstrap col
                                 */
                                do_action('tutor_course/archive/before_loop_course');

                                tutor_load_template('loop.course');

                                /**
                                 * @hook tutor_course/archive/after_loop_course
                                 * @type action
                                 * Usage Idea, If you start any div before course loop, you can end it here, such as </div>
                                 */
                                do_action('tutor_course/archive/after_loop_course');
                            endwhile;

                            tutor_course_loop_end();

                        else :

                            /**
                             * No course found
                             */
                            tutor_load_template('course-none');

                        endif;

                        tutor_course_archive_pagination();

                        do_action('tutor_course/archive/after_loop');
                        ?>
                    </section>
                </div>
	        </div><!-- .wrap -->
        </div>
    </main>
</section>

<?php get_footer( 'dashboard' );
