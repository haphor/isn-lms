<?php
if($post->post_parent === 0) {
    return ;
}
$meta = get_post_meta( $post->post_parent, 'youtube_fields', true );

if( is_array( $meta ) && isset( $meta['assessment'] ) ) {
    $query = get_post( $meta['assessment'] );
}
?>
<section id="assessment" class="section-padding">
    <div class="section-header">
        <h3 class="section-heading">ASSESSMENTS</h3>
        <p>
            Complete this course to unlock its assessment and get a course
            certificate all for free!
        </p>
    </div>

    <div class="section-body learning-list assessment-list d-flex flex-wrap justify-content-between">
        <article class="assessment-list-item locked-assessment d-flex flex-column mb-4">
            <div class="assessment-list-content d-flex flex-column">
                <div class="d-flex flex-row align-items-center justify-content-between">
                    <h5><?php echo $query->post_title; ?></h5>
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <a href="#" class="btn btn-blue disabled">UNLOCK QUIZ</a>
            </div>
        </article>
    </div>
</section>