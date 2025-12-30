<?php
/**
 * Archive Template - Trang Tuyển dụng
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="jobs-section">
    <div class="content-area">
        <div class="jobs-header">
            <h1 class="section-title">Tuyển dụng</h1>
            <p class="section-subtitle">Cơ hội nghề nghiệp tại Namin</p>
        </div>
        
        <?php
        // Get job categories
        $categories = get_terms(array(
            'taxonomy' => 'job_category',
            'hide_empty' => false,
        ));
        
        if (!empty($categories)) : ?>
            <div class="job-categories">
                <a href="<?php echo esc_url(get_post_type_archive_link('job')); ?>" class="category-link active">Tất cả</a>
                <?php foreach ($categories as $category) : ?>
                    <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (have_posts()) : ?>
            <div class="jobs-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="job-<?php the_ID(); ?>" <?php post_class('job-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="job-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'job-thumbnail')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="job-card-content">
                            <div class="job-card-meta">
                                <span class="job-category"><?php the_terms(get_the_ID(), 'job_category'); ?></span>
                                <span class="job-date"><?php echo get_the_date(); ?></span>
                            </div>
                            
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
            
            <div class="blog-pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('← Trước', 'vmst-solutions'),
                    'next_text' => __('Sau →', 'vmst-solutions'),
                ));
                ?>
            </div>
        <?php else : ?>
            <div class="no-results">
                <h2>Không có vị trí tuyển dụng nào</h2>
                <p>Hiện tại chúng tôi không có vị trí tuyển dụng nào. Vui lòng quay lại sau.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

