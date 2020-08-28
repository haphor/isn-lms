<?php

/* 
Template Name: Parent Template
*/



get_header();
?>


    <main class="parent-course">
        <div class="container">
            <div class="parent-wrap">
                
                <div class="video-course">
                    <?php
                        $meta = get_post_meta( $post->ID, 'youtube_fields', true );
                        
                        the_title('<h3>','</h3>');
                        if(is_array($meta) && isset($meta["text"]) != '') {

                            $videoId = $meta["text"];

                            echo '<div class="col-6">
                                    <iframe width="50%" height="500" src="https://www.youtube.com/embed/'.$videoId.'?disablekb=1&loop=1&modestbranding=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>';
                            } else{
                                echo 'Check video ID';
                            }
                    ?>
                    <div class="video-description">
                        <h4>Description</h4>
                        <p>
                            <?php
                            if (is_array($meta) && isset($meta["textarea"])){ echo $meta["textarea"]; } else { echo "Can't Display The Content";} 
                            ?>
                        </p>

                    </div>
                </div>
                <div class="video-modules">
                    <div>
                        <?php  

                            if ($post->post_parent)	{
                                $ancestors=get_post_ancestors($post->ID);
                                $root=count($ancestors)-1;
                                $parent = $ancestors[$root];
                                echo $parent;
                            } else {
                                $parent = $post->ID;
                            }

                            $childArgs = array(
                                'post_type' => 'course',
                                'order' => 'ASC',
                                'post_parent' => $post->ID
                            );

                            $children_posts = get_children($childArgs);
                            if ( !empty($children_posts))	{
                        
                                echo do_shortcode('[progress-bar]');
                            }
                            ?>
                    </div>
                    <h5>Modules</h5>
                    <ul class="course-modules">
                        <?php  

                            if ($post->post_parent)	{
                                $ancestors=get_post_ancestors($post->ID);
                                $root=count($ancestors)-1;
                                $parent = $ancestors[$root];
                                echo $parent;
                            } else {
                                $parent = $post->ID;
                            }

                            $childArgs = array(
                                'post_type' => 'course',
                                'order' => 'ASC',
                                'post_parent' => $post->ID
                            );

                            $children_posts = get_children($childArgs);
                            
                            foreach ($children_posts as $children_post) {
                                echo '<li><a href="'.get_the_permalink($children_post).'"> ' . $children_post->post_title.'</a></li>';

                            }
                        ?>
                    </ul>
                        <?php
                             if ( !empty($children_posts))	{
                                echo do_shortcode('[course-navigation]');
                             } elseif (empty($children_posts)) {
                                 echo do_shortcode('[eCertificate]' );
                             }
                        ?>
                </div>
            </div>
        </div>
                


    </main>
<?php
get_footer();