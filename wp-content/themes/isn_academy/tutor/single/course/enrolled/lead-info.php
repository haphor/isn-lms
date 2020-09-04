<?php
/**
 * Template for displaying lead info
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.5
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $wp_query;
global $post, $authordata;

$profile_url = tutor_utils()->profile_url($authordata->ID);
$course_id = get_the_ID();
?>
<div class="tutor-single-course-segment tutor-single-course-lead-info">

	<?php
	$disable = get_tutor_option('disable_course_review');

	if ( ! $disable){
		?>
        <div class="tutor-leadinfo-top-meta">
            <span class="tutor-single-course-rating">
            <?php
            $course_rating = tutor_utils()->get_course_rating();
            tutor_utils()->star_rating_generator($course_rating->rating_avg);
            ?>
                <span class="tutor-single-rating-count">
                    <?php
                    echo $course_rating->rating_avg;
                    echo '<i>('.$course_rating->rating_count.')</i>';
                    ?>
                </span>
            </span>
        </div>
	<?php } ?>


    <h1 class="tutor-course-header-h1">
        <?php the_title();

        $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
        $tutor_course_duration = get_tutor_course_duration_context($course_id);

        if($tutor_lesson_count) {
            echo "<span> ($tutor_lesson_count";
            _e(' Lessons .', 'tutor');
        }
        if($tutor_course_duration){
            echo " $tutor_course_duration)</span>";
        }

            ?>
    </h1>

	<?php do_action('tutor_course/single/title/after'); ?>

	<?php do_action('tutor_course/single/lead_meta/before'); ?>



	<?php do_action('tutor_course/single/lead_meta/after'); ?>
	<?php do_action('tutor_course/single/excerpt/before'); ?>

	<?php
    $excerpt = tutor_get_the_excerpt();
    $disable_about = get_tutor_option('disable_course_about');
	if (! empty($excerpt) && ! $disable_about){
		?>
        <div class="tutor-course-summery">
			<?php echo $excerpt; ?>
        </div>
		<?php
	}
	?>

	<?php do_action('tutor_course/single/excerpt/after'); ?>

</div>