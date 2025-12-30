<?php
/**
 * Taxonomy Template - Danh mục Tuyển dụng
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="jobs-section">
    <div class="content-area">
        <div class="jobs-header">
            <h1 class="section-title"><?php single_term_title('Tuyển dụng: '); ?></h1>
            <p class="section-subtitle"><?php echo term_description(); ?></p>
        </div>
        
        <?php
        $args = array(
            'post_type' => 'job',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'job_category',
                    'field' => 'term_id',
                    'terms' => get_queried_object()->term_id,
                ),
            ),
        );
        $jobs_query = new WP_Query($args);
        
        if ($jobs_query->have_posts()) : ?>
            <div class="jobs-grid">
                <?php while ($jobs_query->have_posts()) : $jobs_query->the_post(); ?>
                    <article id="job-<?php the_ID(); ?>" <?php post_class('job-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="job-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'job-thumbnail')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="job-card-content">
                            <h2 class="job-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="job-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="job-card-link">Xem chi tiết →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="no-results">
                <h2>Không có vị trí tuyển dụng nào</h2>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

