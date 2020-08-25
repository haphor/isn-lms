<?php

/* 
Template Name: Archive Template
*/



get_header();
?>


    <main class="course-archive">
        <div class="container">
            <div class="archive-wrap">
            <?php
            
                $args = array(
                    'post_parent' => 0,
                    'post_status' => 'published',
                    'order'     => 'ASC',
                    'post_type' => 'course' //custom_post_type
                );
                $the_query = new WP_Query( $args );
                // The Loop
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                
                    ?>

                    <div class="parent-post">
                        <?php the_post_thumbnail();?>
                        <div class="parent-post-content">
                            <?php
                                the_title('<h4>', '</h4>');
                                the_excerpt('<p>','</p>');
                                $childArgs = array(
                                    'post_type' => 'course',
                                    'order' => 'ASC',
                                    'post_parent' => $post->ID
                                );

                                $allChildren = get_children($childArgs);
                                $numberOfChildren = count( $allChildren );
                                ?>
                            <div class="">                        
                                <p><span><?php echo $numberOfChildren ?> </span> Modules</p>
                                <a href="<?php the_permalink(); ?>" class="button btn">Start Course</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                endif;
                // Reset Post Data
                wp_reset_postdata();
                ?>
                
            </div>
        </div>
    </main>

    
<?php

get_footer();
