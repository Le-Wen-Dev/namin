<?php
/**
 * Projects Archive
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="projects-page">
        <!-- Projects Header -->
        <section class="projects-header">
            <div class="projects-header-content">
                <h1 class="projects-title">Dự án</h1>
                <p class="projects-subtitle">Khám phá các dự án thiết kế phòng tắm cao cấp của chúng tôi</p>
            </div>
        </section>

        <!-- Projects Content -->
        <section class="projects-content">
            <div class="container">
                <!-- Filters -->
                <div class="projects-filters">
                    <div class="filter-categories">
                        <h3 class="filter-title">Danh mục</h3>
                        <ul class="category-list">
                            <li><a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>" class="<?php echo !is_tax() ? 'active' : ''; ?>">Tất cả</a></li>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'project_category',
                                'hide_empty' => true,
                            ));
                            if ($categories && !is_wp_error($categories)) {
                                foreach ($categories as $category) {
                                    $active = is_tax('project_category', $category->slug) ? 'active' : '';
                                    echo '<li><a href="' . esc_url(get_term_link($category)) . '" class="' . $active . '">' . esc_html($category->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Projects Grid -->
                <div class="projects-grid">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); 
                            $project_image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=600';
                            $project_client = get_post_meta(get_the_ID(), '_project_client', true);
                            $project_date = get_post_meta(get_the_ID(), '_project_date', true);
                        ?>
                            <div class="project-card">
                                <a href="<?php the_permalink(); ?>" class="project-link">
                                    <div class="project-image-wrapper">
                                        <img src="<?php echo esc_url($project_image); ?>" alt="<?php the_title(); ?>" class="project-image">
                                        <div class="project-overlay">
                                            <span class="view-project">Xem dự án →</span>
                                        </div>
                                    </div>
                                    <div class="project-info">
                                        <h3 class="project-title"><?php the_title(); ?></h3>
                                        <div class="project-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                        </div>
                                        <?php if ($project_client || $project_date) : ?>
                                            <div class="project-meta">
                                                <?php if ($project_client) : ?>
                                                    <span class="project-client">👤 <?php echo esc_html($project_client); ?></span>
                                                <?php endif; ?>
                                                <?php if ($project_date) : ?>
                                                    <span class="project-date">📅 <?php echo esc_html($project_date); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="no-projects">
                            <p>Không tìm thấy dự án nào.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="projects-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '← Trước',
                        'next_text' => 'Sau →',
                    ));
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.projects-page {
    padding-top: 100px;
}

.projects-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 20px;
    text-align: center;
    color: white;
}

.projects-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 15px;
}

.projects-subtitle {
    font-size: 20px;
    opacity: 0.9;
}

.projects-content {
    padding: 60px 20px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.projects-filters {
    margin-bottom: 50px;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 12px;
}

.filter-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
}

.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.category-list li a {
    padding: 10px 20px;
    background: white;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
}

.category-list li a:hover,
.category-list li a.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transform: translateY(-2px);
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 40px;
    margin-bottom: 50px;
}

.project-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.project-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.project-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 70%;
    overflow: hidden;
    background: #f8f9fa;
}

.project-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(102, 126, 234, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-card:hover .project-image {
    transform: scale(1.1);
}

.view-project {
    color: white;
    font-size: 20px;
    font-weight: 600;
}

.project-info {
    padding: 30px;
}

.project-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #1a1a1a;
}

.project-excerpt {
    font-size: 15px;
    color: #666;
    margin-bottom: 15px;
    line-height: 1.6;
}

.project-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
    font-size: 14px;
    color: #666;
}

.project-client,
.project-date {
    display: flex;
    align-items: center;
    gap: 5px;
}

.no-projects {
    text-align: center;
    padding: 60px 20px;
    color: #666;
    font-size: 18px;
}

.projects-pagination {
    margin-top: 50px;
    text-align: center;
}

@media (max-width: 768px) {
    .projects-title {
        font-size: 36px;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}
</style>

<?php
get_footer();
?>

