<?php
$active_courses = tutor_utils()->get_active_courses_by_user();

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
        <?php if ( $active_courses && $active_courses->have_posts() ): ?>
            <?php while ($active_courses->have_posts()): $active_courses->the_post();
                $avg_rating = tutor_utils()->get_course_rating()->rating_avg;
                $tutor_course_img = get_tutor_course_thumbnail_src();
            ?>
                <article class="learning-list-item d-flex flex-column mb-4">
                    <div class="learning-list-image hover-zoomin">
                        <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title() ?>" />
                    </div>
                    <div class="learning-list-content d-flex flex-column">
                        <h4><?php the_title(); ?></h4>
                        <a href="<?php the_permalink(); ?>" class="btn btn-blue">
                            CONTINUE COURSE  <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>