<?php
/**
 * Archive Template - Trang Tin tức
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="blog-section">
    <div class="content-area">
        <div class="blog-header">
            <h1 class="section-title">Tin tức</h1>
            <p class="section-subtitle">Cập nhật những tin tức mới nhất về thiết bị phòng tắm, nhà vệ sinh cao cấp</p>
        </div>
        
        <?php if (have_posts()) : ?>
            <div class="blog-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-card-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('class' => 'blog-thumbnail')); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="blog-card-content">
                            <div class="blog-card-meta">
                                <span class="blog-date"><?php echo get_the_date(); ?></span>
                                <span class="blog-category"><?php the_category(', '); ?></span>
                            </div>
                            
                            <h2 class="blog-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="blog-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="blog-card-link">Đọc thêm →</a>
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
                <h2>Không tìm thấy bài viết nào</h2>
                <p>Xin lỗi, không có bài viết nào được tìm thấy.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();

