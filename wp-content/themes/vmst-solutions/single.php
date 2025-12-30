<?php
/**
 * Single Post Template - Trang chi tiết tin
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="single-post-section">
    <div class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="single-post-header">
                    <div class="single-post-meta">
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                        <span class="post-author">Bởi <?php the_author(); ?></span>
                        <span class="post-category"><?php the_category(', '); ?></span>
                    </div>
                    
                    <h1 class="single-post-title"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post-featured-image">
                        <?php the_post_thumbnail('full', array('class' => 'featured-img')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>
                
                <footer class="single-post-footer">
                    <div class="post-tags">
                        <?php the_tags('<span class="tags-label">Tags: </span>', ', ', ''); ?>
                    </div>
                    
                    <div class="post-navigation">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        <?php if ($prev_post) : ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post); ?>">
                                    ← <?php echo get_the_title($prev_post); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post); ?>">
                                    <?php echo get_the_title($next_post); ?> →
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </footer>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();

