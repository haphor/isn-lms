<?php
/**
 * Display Topics and Lesson lists for learn
 *
 * @since v.1.0.0
 * @author themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $post;

$currentPost = $post;

$course_id = 0;
if ($post->post_type === 'tutor_quiz'){
	$course = tutor_utils()->get_course_by_quiz(get_the_ID());
	$course_id = $course->ID;
}elseif($post->post_type === 'tutor_assignments'){
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_assignments', true);

} else{
	$course_id = get_post_meta($post->ID, '_tutor_course_id_for_lesson', true);
}

$enable_q_and_a_on_course = tutor_utils()->get_option('enable_q_and_a_on_course');


?>

<?php do_action('tutor_lesson/single/before/lesson_sidebar'); ?>

    <div class="tutor-sidebar-tabs-wrap">


        <div class="tutor-sidebar-tabs-content">

            <div id="tutor-lesson-sidebar-tab-content" class="tutor-lesson-sidebar-tab-item">
                <h3 class="single-lesson-title">
                    <?php
                    tutor_utils()->get_lesson_type_icon(get_the_ID(), true, true);
                    the_title();
                    ?>
                </h3>
                <?php
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post();
                        the_content();
                        endwhile;
                    endif;
                ?>


				<?php
                $topics = tutor_utils()->get_topics($course_id);
				if ($topics->have_posts()){
					while ($topics->have_posts()){ $topics->the_post();
						$topic_id = get_the_ID();
						$topic_summery = get_the_content();
						?>

                        <div class="tutor-topics-in-single-lesson tutor-topics-<?php echo $topic_id; ?>">

                            <ul class="tutor-lessons-under-topic sub-courses d-flex flex-column flex-wrap">
								<?php
								do_action('tutor/lesson_list/before/topic', $topic_id);

								$lessons = tutor_utils()->get_course_contents_by_topic(get_the_ID(), -1);
								if ($lessons->have_posts()){
									while ($lessons->have_posts()){
										$lessons->the_post();

										if ($post->post_type === 'tutor_quiz') {
											$quiz = $post;
											?>
                                            <li class="d-flex flex-row justify-content-between quiz-single-item-<?php echo $quiz->ID; ?> <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>" data-quiz-id="<?php echo $quiz->ID; ?>">
                                                <a href="<?php echo get_permalink($quiz->ID); ?>" class="sidebar-single-quiz-a" data-quiz-id="<?php echo $quiz->ID; ?>">
                                                    <span class="lesson_title"><?php echo $quiz->post_title; ?></span>
                                                    <span class="tutor-lesson-right-icons">
                                                    <?php
                                                    do_action('tutor/lesson_list/right_icon_area', $post);

                                                    $time_limit = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_value');
                                                    if ($time_limit){
	                                                    $time_type = tutor_utils()->get_quiz_option($quiz->ID, 'time_limit.time_type');
	                                                    echo "<span class='quiz-time-limit'>{$time_limit} {$time_type}</span>";
                                                    }
                                                    ?>
                                                    </span>
                                                </a>
                                            </li>
											<?php
										}elseif($post->post_type === 'tutor_assignments'){
											/**
											 * Assignments
											 * @since this block v.1.3.3
											 */

											?>
                                            <div class="tutor-single-lesson-items assignments-single-item assignment-single-item-<?php echo $post->ID; ?> <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>"
                                                 data-assignment-id="<?php echo $post->ID; ?>">
                                                <a href="<?php echo get_permalink($post->ID); ?>" class="sidebar-single-assignment-a" data-assignment-id="<?php echo $post->ID; ?>">
                                                    <i class="tutor-icon-clipboard"></i>
                                                    <span class="lesson_title"> <?php echo $post->post_title; ?> </span>
                                                    <span class="tutor-lesson-right-icons">
                                                        <?php do_action('tutor/lesson_list/right_icon_area', $post); ?>
                                                    </span>
                                                </a>
                                            </div>
											<?php

										}else{

											/**
											 * Lesson
											 */

											$video = tutor_utils()->get_video_info();

											$play_time = false;
											if ( $video ) {
												$play_time = $video->playtime;
											}
											$is_completed_lesson = tutor_utils()->is_completed_lesson();
											?>

                                            <li class="d-flex flex-row justify-content-between <?php echo ( $currentPost->ID === get_the_ID() ) ? 'active' : ''; ?>">
                                                <a href="<?php the_permalink(); ?>" class="tutor-single-lesson-a" data-lesson-id="<?php the_ID(); ?>">
                                                    <span class="lesson_title"><?php the_title(); ?></span>
                                                    <span class="tutor-lesson-right-icons">
                                                        <?php
                                                        do_action('tutor/lesson_list/right_icon_area', $post);
                                                        if ( $play_time ) {
	                                                        echo "<i class='tutor-play-duration'>$play_time</i>";
                                                        }
                                                        $lesson_complete_icon = $is_completed_lesson ? 'tutor-icon-mark tutor-done' : '';
                                                        echo "<i class='tutor-lesson-complete $lesson_complete_icon'></i>";
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>

											<?php
										}
									}
									$lessons->reset_postdata();
								}
								?>

								<?php do_action('tutor/lesson_list/after/topic', $topic_id); ?>
                            </ul>
                        </div>

						<?php
					}
					$topics->reset_postdata();
					wp_reset_postdata();
				}
				?>
            </div>

            <div id="tutor-lesson-sidebar-qa-tab-content" class="tutor-lesson-sidebar-tab-item" style="display: none;">
				<?php
				tutor_lesson_sidebar_question_and_answer();
				?>
            </div>

        </div>

        <?php tutor_next_previous_pagination(); ?>
    </div>

<?php do_action('tutor_lesson/single/after/lesson_sidebar'); ?>