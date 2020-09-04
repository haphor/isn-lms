<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

global $post;
?>



<div class="course-info d-flex flex-nowrap justify-content-between">
    <?php
    $course_duration = get_tutor_course_duration_context();
    $total_lesson = tutor_utils()->get_lesson_count_by_course( get_the_ID() );
    ?>
    <div class="d-flex flex-column align-items-center">
        <img src="<?php bloginfo( 'template_url' ) ?>/images/lesson.svg" alt="24 Lessons Icon" />
        <span class="course-des"><?php echo $total_lesson ?> Lessons</span>
    </div>

    <?php
    if(!empty($course_duration)) { ?>
        <div class="d-flex flex-column align-items-center">
            <img src="<?php bloginfo( 'template_url' ) ?>/images/time.svg" alt="5hrs 30mins Icon" />
            <span class="course-des"><?php echo $course_duration?></span>
        </div>
    <?php } ?>
</div>