<?php
/**
 * Single Job Template - Chi tiết Tuyển dụng
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="single-job-section">
    <div class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            <article id="job-<?php the_ID(); ?>" <?php post_class('single-job'); ?>>
                <header class="single-job-header">
                    <div class="single-job-meta">
                        <span class="job-category"><?php the_terms(get_the_ID(), 'job_category'); ?></span>
                        <span class="job-date"><?php echo get_the_date(); ?></span>
                    </div>
                    
                    <h1 class="single-job-title"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-job-featured-image">
                        <?php the_post_thumbnail('full', array('class' => 'featured-img')); ?>
                    </div>
                <?php endif; ?>
                
                <div class="single-job-content">
                    <?php the_content(); ?>
                </div>
                
                <div class="single-job-apply">
                    <h3>Ứng tuyển ngay</h3>
                    <a href="#apply-form" class="btn btn-primary">Nộp hồ sơ</a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();

