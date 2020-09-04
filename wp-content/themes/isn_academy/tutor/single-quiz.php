<?php
/**
 * Template for displaying single quiz
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

//get_tutor_header();
get_header( 'dashboard' );

$course = tutor_utils()->get_course_by_quiz(get_the_ID());

$enable_spotlight_mode = tutor_utils()->get_option('enable_spotlight_mode');
?>

    <section id="dashboard-content">
    <?php
        get_template_part( 'templates/parts/sidebar', 'menu' );
        do_action('tutor_quiz/single/before/wrap');
    ?>
        <main class="l-main parent-course-page">
            <div class="content-wrapper content-wrapper--with-bg">
                    <div class="tutor-single-lesson-wrap flex-reverse <?php echo $enable_spotlight_mode ? 'tutor-spotlight-mode' : ''; ?>">
                        <div class="tutor-lesson-sidebar col-5">
                            <?php tutor_lessons_sidebar(); ?>
                        </div>
                        <div id="tutor-single-entry-content" class="tutor-quiz-single-entry-wrap tutor-single-entry-content">
                            <input type="hidden" name="tutor_quiz_id" id="tutor_quiz_id" value="<?php the_ID(); ?>">
                            <div class="tutor-single-page-top-bar">
                                <div class="tutor-topbar-item tutor-hide-sidebar-bar">
                                    <a href="javascript:;" class="tutor-lesson-sidebar-hide-bar"><i class="tutor-icon-angle-right"></i> </a>
                                </div>

                                <div class="tutor-topbar-item tutor-topbar-mark-to-done" style="width: 150px;"></div>
                            </div>
                            <div class="tutor-quiz-single-wrap ">
                            <input type="hidden" name="tutor_quiz_id" id="tutor_quiz_id" value="<?php the_ID(); ?>">

                            <?php
                            if ($course){
                                tutor_single_quiz_top();
                                tutor_single_quiz_content();
                                tutor_single_quiz_body();
                            }else{
                                tutor_single_quiz_no_course_belongs();
                            }
                            ?>
                        </div>
                        </div>
                    </div>
            </div>
        </main>
</section>

<?php

get_footer( 'dashboard' );