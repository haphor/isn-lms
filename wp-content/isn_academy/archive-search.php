<?php
/**
 * Template Name: Custom Search
 * Description: A page template for Custom Search Page
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package isn
 *
 */
get_header( 'dashboard' );
?>
 <section id="dashboard-content">
    <?php get_template_part( 'templates/parts/sidebar', 'menu' ); ?>
    <main class="l-main">
        <div class="content-wrapper content-wrapper--with-bg">
            <div class="contentarea">
                <div id="content" class="content_right">  
                     <h3>Search Result for : <?php echo "$s"; ?> </h3>       
                     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>    
                        <div id="post-<?php the_ID(); ?>" class="posts">        
                            <article>        
                                <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>        
                                <p><?php the_exerpt(); ?></p>        
                                <p align="right"><a href="<?php the_permalink(); ?>">Read     More</a></p>     

                            </article><!-- #post -->   
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
                        </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div><!-- content -->    
            </div><!-- contentarea -->  
        </div>
    </main>
 </section>


<?php
get_footer( 'dashboard' );
?>