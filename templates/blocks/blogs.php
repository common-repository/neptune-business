<?php 
    $blogstitle = get_field('blogs_title');
    $blogssubtitle = get_field('blogs_subtitle');
    //$blog_no = get_field('number_of_articles');
    $blogBg = get_field('blogs_bg');
    $blogtoggle = get_field('blogs_toggle');
if($blogtoggle == 'On'):
?>
<div class="section clear blogs pro-blog"  style="background-color:<?php echo $blogBg; ?>">

    <div class="grid-wide">

        <header class="col-5-12 mobile-col-1-1 clear">
            <?php
            echo '<h2>'. $blogstitle .'</h2>';

            if(!empty($blogssubtitle)) {
                echo '<h4>'. $blogssubtitle .'</h4>';
            }
            ?>
        </header>
        <div class="col-1-1">
        <?php

            global $post;
            $arr = array(
            'post_type' => 'post',
            'posts_per_page'  => '5',
             );
            $blog = new WP_Query( $arr );
        
            if($blog->have_posts()):
                $i = 0;
                while($blog->have_posts()): $blog->the_post();
                $i++;

                if ( $i == 1 ) {?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('clear col-6-12 first-blog'); ?>>
                   
                    <a href="<?php the_permalink(); ?>">
                    <?php   if ( has_post_thumbnail() ) { ?>
                            <?php $thumb = get_the_post_thumbnail_url(get_the_ID(),'large'); ?>
                            <div class="blog-thumb" style="background-image: url('<?php echo $thumb; ?>');">
                                
                            </div>

                    <?php }else { ?>
                        <?php $default = get_template_directory_uri().'/img/default-image.jpg'; ?>
                        
                        <div class="blog-thumb" style="background-image: url('<?php echo $default; ?>');"></div>
                    <?php } ?>
                    </a>
                    
                    <header class="entry-header">
                        <?php
                    
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                         ?>
                        <div class="entry-meta">
                            <?php neptune_wp_posted_on(); ?>
                        </div><!-- .entry-meta -->

                    <?php the_excerpt(); ?>
                    </header><!-- .entry-header -->

                    
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php } else { ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('clear col-6-12 side-blog'); ?>>
                   
                    <a href="<?php the_permalink(); ?>">
                    <?php   if ( has_post_thumbnail() ) { ?>
                            <?php $thumb = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>
                            <div class="small-blog-thumb col-3-12" style="background-image: url('<?php echo $thumb; ?>');">
                                
                            </div>

                    <?php }else {
                        $default = get_template_directory_uri().'/img/default-image.jpg';
                        echo '<div class="small-blog-thumb col-3-12" style="background-image: url('.$default.');"></div>';
                    } ?>
                    </a>                    
                    <header class="entry-header col-9-12">
                        <?php
                    
                            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                         ?>
                        <div class="entry-meta">
                            <?php neptune_wp_posted_on(); ?>
                        </div><!-- .entry-meta -->

                    <?php //the_excerpt(); ?>
                    </header><!-- .entry-header -->

                    
                </article><!-- #post-<?php the_ID(); ?> -->
                <?php }
                endwhile;
            wp_reset_postdata();
            endif;
           
        
        ?>
        </div>
    </div>
</div>
<?php endif;