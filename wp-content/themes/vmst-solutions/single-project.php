<?php
/**
 * Single Project Template
 */

get_header();

while (have_posts()) : the_post();
    $project_client = get_post_meta(get_the_ID(), '_project_client', true);
    $project_date = get_post_meta(get_the_ID(), '_project_date', true);
    $project_location = get_post_meta(get_the_ID(), '_project_location', true);
    $project_gallery = get_post_meta(get_the_ID(), '_project_gallery', true);
    $project_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=1200';
?>

<main id="main-content" class="site-main">
    <div class="project-page">
        <!-- Project Hero -->
        <section class="project-hero">
            <img src="<?php echo esc_url($project_image); ?>" alt="<?php the_title(); ?>" class="hero-image">
            <div class="hero-overlay">
                <div class="hero-content">
                    <h1 class="project-title"><?php the_title(); ?></h1>
                    <?php if ($project_client || $project_date || $project_location) : ?>
                        <div class="project-hero-meta">
                            <?php if ($project_client) : ?>
                                <span>👤 <?php echo esc_html($project_client); ?></span>
                            <?php endif; ?>
                            <?php if ($project_date) : ?>
                                <span>📅 <?php echo esc_html($project_date); ?></span>
                            <?php endif; ?>
                            <?php if ($project_location) : ?>
                                <span>📍 <?php echo esc_html($project_location); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Project Content -->
        <section class="project-content">
            <div class="container">
                <div class="project-wrapper">
                    <div class="project-main">
                        <div class="project-description">
                            <?php the_content(); ?>
                        </div>

                        <!-- Project Gallery -->
                        <?php if ($project_gallery && is_array($project_gallery)) : ?>
                            <div class="project-gallery">
                                <h2 class="gallery-title">Hình ảnh dự án</h2>
                                <div class="gallery-grid">
                                    <?php foreach ($project_gallery as $gallery_image) : ?>
                                        <div class="gallery-item">
                                            <img src="<?php echo esc_url($gallery_image); ?>" alt="Gallery" onclick="openLightbox('<?php echo esc_url($gallery_image); ?>')">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="project-sidebar">
                        <div class="project-info-card">
                            <h3 class="info-card-title">Thông tin dự án</h3>
                            <div class="info-list">
                                <?php if ($project_client) : ?>
                                    <div class="info-item">
                                        <span class="info-label">Khách hàng:</span>
                                        <span class="info-value"><?php echo esc_html($project_client); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($project_date) : ?>
                                    <div class="info-item">
                                        <span class="info-label">Ngày hoàn thành:</span>
                                        <span class="info-value"><?php echo esc_html($project_date); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($project_location) : ?>
                                    <div class="info-item">
                                        <span class="info-label">Địa điểm:</span>
                                        <span class="info-value"><?php echo esc_html($project_location); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'project_category');
                                if ($categories && !is_wp_error($categories)) :
                                ?>
                                    <div class="info-item">
                                        <span class="info-label">Danh mục:</span>
                                        <div class="info-value">
                                            <?php foreach ($categories as $category) : ?>
                                                <span class="category-tag"><?php echo esc_html($category->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="project-cta">
                            <h3 class="cta-title">Bạn có dự án tương tự?</h3>
                            <p class="cta-description">Liên hệ với chúng tôi để được tư vấn và báo giá</p>
                            <a href="<?php echo esc_url(home_url('/lien-he')); ?>" class="cta-button">Liên hệ ngay</a>
                        </div>
                    </div>
                </div>

                <!-- Related Projects -->
                <?php
                $related_projects = get_posts(array(
                    'post_type' => 'project',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                ));
                if ($related_projects) :
                ?>
                    <div class="related-projects">
                        <h2 class="related-title">Dự án liên quan</h2>
                        <div class="related-grid">
                            <?php foreach ($related_projects as $related) : 
                                $related_image = get_the_post_thumbnail_url($related->ID, 'medium') ?: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400';
                            ?>
                                <div class="related-card">
                                    <a href="<?php echo get_permalink($related->ID); ?>">
                                        <img src="<?php echo esc_url($related_image); ?>" alt="<?php echo get_the_title($related->ID); ?>">
                                        <h3><?php echo get_the_title($related->ID); ?></h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<!-- Lightbox -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close">&times;</span>
    <img id="lightbox-image" src="" alt="Lightbox">
</div>

<script>
function openLightbox(imageUrl) {
    document.getElementById('lightbox-image').src = imageUrl;
    document.getElementById('lightbox').style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>

<style>
.project-page {
    padding-top: 0;
}

.project-hero {
    position: relative;
    width: 100%;
    height: 70vh;
    min-height: 500px;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
    display: flex;
    align-items: flex-end;
}

.hero-content {
    width: 100%;
    padding: 60px 20px;
    color: white;
}

.project-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.project-hero-meta {
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
    font-size: 18px;
}

.project-content {
    padding: 80px 20px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.project-wrapper {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 60px;
    margin-bottom: 80px;
}

.project-main {
    min-width: 0;
}

.project-description {
    font-size: 18px;
    line-height: 1.8;
    color: #333;
    margin-bottom: 60px;
}

.project-description p {
    margin-bottom: 20px;
}

.project-gallery {
    margin-top: 60px;
}

.gallery-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 30px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.gallery-item {
    position: relative;
    padding-top: 75%;
    overflow: hidden;
    border-radius: 12px;
    cursor: pointer;
}

.gallery-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.project-sidebar {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.project-info-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.info-card-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.info-label {
    font-weight: 600;
    color: #666;
    font-size: 14px;
}

.info-value {
    color: #1a1a1a;
    font-size: 16px;
}

.category-tag {
    display: inline-block;
    padding: 5px 12px;
    background: #f8f9fa;
    border-radius: 20px;
    font-size: 14px;
    margin-right: 8px;
}

.project-cta {
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    border-radius: 12px;
    padding: 30px;
    color: white;
    text-align: center;
}

.cta-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-description {
    margin-bottom: 25px;
    opacity: 0.9;
}

.cta-button {
    display: inline-block;
    padding: 12px 30px;
    background: white;
    color: #087bb5;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: transform 0.3s ease;
}

.cta-button:hover {
    transform: translateY(-2px);
}

.related-projects {
    margin-top: 80px;
    padding-top: 60px;
    border-top: 2px solid #e9ecef;
}

.related-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

.related-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.related-card:hover {
    transform: translateY(-5px);
}

.related-card a {
    text-decoration: none;
    color: inherit;
    display: block;
}

.related-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.related-card h3 {
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    margin: 0;
}

.lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.9);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.lightbox-close {
    position: absolute;
    top: 30px;
    right: 40px;
    color: white;
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    z-index: 10000;
}

#lightbox-image {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
}

@media (max-width: 968px) {
    .project-wrapper {
        grid-template-columns: 1fr;
    }
    
    .project-sidebar {
        position: static;
    }
    
    .project-title {
        font-size: 36px;
    }
}
</style>

<?php
endwhile;
get_footer();
?>

