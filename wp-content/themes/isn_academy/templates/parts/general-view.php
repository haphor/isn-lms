<section id="popular-courses" class="section-padding">
    <div class="section-header">
        <h3 class="section-heading">GET STARTED NOW</h3>
        <p>
            Here’s a list of all the other courses available on the ISN
            Academy Platform.
        </p>
    </div>

    <div class="section-body learning-list d-flex flex-wrap justify-content-between">
        <?php if ( $courses->have_posts() ) : ?>
        <?php while ( $courses->have_posts() ) : $courses->the_post(); ?>
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
                                <img src="<?= bloginfo( 'template_url' ) ?>/images/cert.svg" alt="Course Certificate Icon" />
                                <span class="course-des">Course Certificate</span>
                            </div>
                        <?php endif;?>
                        <div class="d-flex flex-column align-items-center">
                            <img src="<?= bloginfo( 'template_url' ) ?>/images/lesson.svg" alt="24 Lessons Icon" />
                            <span class="course-des"><?= $total ?> Lessons</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <img src="<?= bloginfo( 'template_url' ) ?>/images/time.svg" alt="5hrs 30mins Icon" />
                            <span class="course-des"><?= $meta['length']?></span>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
        <?php endif; ?>

    </div>

</section>