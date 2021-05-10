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
$media = get_post_meta( $post->ID, 'isn_media_file', true );
$is_member = \Inc\Base\SingleCourse::isMember( $post->ID );

if( !$is_member ) {
    $parentId = $post->post_parent ?? 0 ;
    $course = new \Inc\Base\SingleCourse();
    $course->add( $parentId, $post->ID, false );
}
$courseType = 'video';
if( is_array( $meta ) && $meta['type'] === 'video' ) {
    $videoId = $meta['text'] ?? '';
}
if(  $media &&  $meta['type'] !== 'video' ) {
    $courseType = 'media';
    $file = $media;
}
?>
<section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' );?>

    <main class="l-main single-course-page">
        <div class="content-wrapper content-wrapper--with-bg">
            <section id="last-section" class="section-padding d-flex flex-row">
                <div class="col-7">
                    <?php if( $courseType === 'video' ){ ?>
                        <iframe title="" width="100%" height="400"
                                src="https://www.youtube.com/embed/<?= $videoId ?>?disablekb=1&loop=1&modestbranding=1"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    <?php } else { ?>
                        <object data="<?= $media ?>" height="400" type="application/pdf" width="100%"></object>
                    <?php } ?>
                </div>
                <div class="col-5">
                    <div class="col-100" style="display: flex; justify-content: space-between">
                        <h4>
                            <?php the_title() ?>
                        </h4>
                    </div>
                    <div class="single-progress">
                        <?php //echo do_shortcode('[progress-bar]' ); ?>
                    </div>
                    <?php
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    ?>
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
                                    $meta = get_post_meta( $course->ID, 'youtube_fields', true );
                                    if( is_array( $meta ) && $meta['type'] === 'video' ) {
                                        $stamp = $meta['length'];
                                    } else {
                                        $stamp = $meta['type'];
                                    }
                                    echo
                                        '<li class="d-flex flex-row justify-content-between">' .
                                        $course->post_title.
                                        '<span>'. $stamp .'</span></li>';
                                }
                            ?>
                        <?php endif; ?>
                    </ul>

                    <div class="course-action col-12 d-flex flex-row justify-content-between align-items-center mt-4 p-0">
                        <?php echo do_shortcode('[course-navigation]'); ?>
                    </div>
                </div>
            </section>

            <?php
                get_template_part( 'templates/courses/course', 'assessment' );
            ?>

            <?php
                set_query_var( 'courses', $query );
                get_template_part( 'templates/parts/general', 'view' );
            ?>

        </div>
    </main>
</section>

<?php
get_footer( 'dashboard' );
?>
