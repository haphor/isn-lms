<?php
get_header( 'dashboard' );
$meta = get_post_meta( $post->ID, 'youtube_fields', true );
?>
<section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' );?>

    <main class="l-main">
        <div class="content-wrapper content-wrapper--with-bg">
            <section id="popular-courses" class="section-padding">
            <?php
                if( is_array( $meta ) && isset( $meta['text'] ) !== '') {
                    $videoId = $meta['text'];
            ?>
            <div class="col-6">
                <iframe title="" width="100%" height="400"
                    src="https://www.youtube.com/embed/<?= $videoId ?>?disablekb=1&loop=1&modestbranding=1"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
            <?php } ?>
            <div class="col-6">
                <h4><?php the_title() ?></h4>
                <?php
                    if( $post->post_parent ) :
                        $args = [
                            'post_type' => 'course',
                            'order' => 'ASC',
                            'post_parent' => $post->post_parent
                        ];
                        $otherCourses = get_children($args);

                        foreach ($otherCourses as $course) {
                            echo '<li><a href="'.get_the_permalink($course).'"> ' . $course->post_title.'</a></li>';
                        }
                    ?>
                <?php endif; ?>
            </div>
            </section>
        </div>
    </main>
</section>

<?php
get_footer( 'dashboard' );
?>