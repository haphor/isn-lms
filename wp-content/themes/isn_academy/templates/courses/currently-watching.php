<?php $active_courses = tutor_utils()->get_active_courses_by_user(1);  ?>
<section id="last-section" class="section-padding d-flex flex-column">
    <div class="section-header">
        <h3 class="section-heading">CONTINUE READING</h3>
        <p>Pick up where you left off:</p>
    </div>
    <?php if ( $active_courses && $active_courses->have_posts() ): ?>
    <?php while ($active_courses->have_posts()): $active_courses->the_post();
    $avg_rating = tutor_utils()->get_course_rating()->rating_avg;
    $tutor_course_img = get_tutor_course_thumbnail_src();
    ?>
    <div class="d-flex flex-row">
        <div class="col-12 col-sm-6 section-img hover-zoomin pr-sm-0">
            <img src="<?php echo esc_url($tutor_course_img); ?>" alt="<?php the_title() ?>" />
        </div>
        <div class="d-flex align-items-center pl-3 last-section-content" style="background-color: #fff;">
            <div class="d-flex flex-column">
                <h4><?php the_title() ?></h4>
                <?php the_content() ?>
                <div class="course-info d-flex flex-row flex-nowrap align-items-center justify-content-between">

                    <div class="d-flex flex-row justify-content-center">
                        <img src="<?= bloginfo('template_url');?>/images/lesson.svg" alt="24 Lessons Icon" />
                        <span class="course-des">24 Lessons</span>
                    </div>

                    <div class="d-flex flex-row align-items-center">
                        <img src="<?= bloginfo('template_url');?>/images/time.svg" alt="5hrs 30mins Icon" />
                        <span class="course-des">5hrs 30mins</span>
                    </div>

                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-blue">CONTINUE COURSE
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>