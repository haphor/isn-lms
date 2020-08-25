<?php

/* 
Template Name: Single Template
*/

get_header();
?>


    <main class="single-course">
        <div class="container">
            <div class="single-wrap">
                <div class="video-course">
                    <?php
                        $meta = get_post_meta( $post->ID, 'youtube_fields', true );?>
                        <div class="course-header">                        
                            <?php the_title('<h3>','</h3>'); ?>
                            <div class="single-progress">
                                <?php echo do_shortcode("[progress-bar]"); ?>
                            </div>
                        </div>
                        <?php
                        if(is_array($meta) && isset($meta["text"]) != '') {

                            $videoId = $meta["text"];

                            echo '<div class="col-6">
                                    <iframe width="50%" height="500" src="https://www.youtube.com/embed/'.$videoId.'?disablekb=1&loop=1&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>';
                            } else{
                            
                                echo "Check video ID";

                            }
                        ?>
                        <h2>Description</h2>
                        <p>
                            <?php
                            if (is_array($meta) && isset($meta["textarea"])){ echo $meta["textarea"]; } else { echo "Can't Display The Content";} 
                            ?>
                        </p>
                </div>                
                    <?php echo do_shortcode("[course-navigation]"); ?>
                </div>
            </div>

        </div>

    </main>
<?php
get_footer();