<?php
/**
 * Display the content
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

do_action('tutor_lesson/single/before/content');

$jsonData = array();
$jsonData['post_id'] = get_the_ID();
$jsonData['best_watch_time'] = 0;
$jsonData['autoload_next_course_content'] = (bool) get_tutor_option('autoload_next_course_content');

$best_watch_time = tutor_utils()->get_lesson_reading_info(get_the_ID(), 0, 'video_best_watched_time');
if ($best_watch_time > 0){
	$jsonData['best_watch_time'] = $best_watch_time;
}
?>


<?php do_action('tutor_lesson/single/before/content'); ?>

<div class="tutor-single-page-top-bar">
    <div class="tutor-topbar-item tutor-hide-sidebar-bar">
        <a href="javascript:;" class="tutor-lesson-sidebar-hide-bar"><i class="tutor-icon-angle-right"></i> </a>
        <?php $course_id = get_post_meta(get_the_ID(), '_tutor_course_id_for_lesson', true); ?>
    </div>

    <div class="tutor-topbar-item tutor-topbar-mark-to-done">
        <?php tutor_lesson_mark_complete_html(); ?>
    </div>

</div>


<div class="tutor-lesson-content-area">

    <input type="hidden" id="tutor_video_tracking_information" value="<?php echo esc_attr(json_encode($jsonData)); ?>">
	<?php tutor_lesson_video(); ?>
    <?php get_tutor_posts_attachments(); ?>
    <?php $attachments = tutor_utils()->get_attachments();
    if (is_array($attachments) && count($attachments)){ ?>
        <div class="tutor-page-segment tutor-attachments-wrap">
            <?php foreach ($attachments as $attachment){ ?>
                <h3><?php echo $attachment->name; ?></h3>
                <!-- <object data="<?php //echo $attachment->url; ?>" height="400" type="application/pdf" width="100%"></object> -->
                <iframe src="https://docs.google.com/gview?url=<?php echo $attachment->url; ?>" style="width:600px; height:500px;" frameborder="0"></iframe>
                <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={<?php //echo $attachment->url; ?>}' width='600px' height='500px' frameborder='0'></iframe> -->
            <?php } ?>
        </div>
    <?php } ?>
</div>

<?php do_action('tutor_lesson/single/after/content'); ?>
