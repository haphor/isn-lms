<?php

    $ongoing = \Inc\Base\SingleCourse::onGoingCourse( get_current_user_id(), $post->post_parent );
    $ids = array_column( $ongoing, 'ID' );
    $args = [
            'post__in' =>  [ implode( ',' , $ids ) ],
            'post_type' => 'course',
            'post_parent' => 0,
            'post_status' => 'publish',
            'orderby' => 'rand',
    ];
    $ongoingCourses = new WP_Query( $args );
?>
<section id="ongoing-courses" class="section-padding">
    <div class="section-header">
        <h3 class="section-heading">ONGOING COURSES</h3>
        <p>
            Here’s a look at all the courses you’re currently taking.
            Complete these courses so you can generate your certificate.
        </p>
    </div>

    <div class="section-body learning-list d-flex flex-wrap justify-content-between">
        <?php if ( $ongoingCourses->have_posts() ) : ?>
            <?php while ( $ongoingCourses->have_posts() ) : $ongoingCourses->the_post(); ?>
                <article class="learning-list-item d-flex flex-column mb-4">
                    <div class="learning-list-image hover-zoomin">
                        <?php the_post_thumbnail( 'medium' ) ?>
                    </div>
                    <div class="learning-list-content d-flex flex-column">
                        <h4><?php the_title() ?></h4>
                        <a href="<?php the_permalink();?>" class="btn btn-blue">
                            CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>

    </div>

</section>