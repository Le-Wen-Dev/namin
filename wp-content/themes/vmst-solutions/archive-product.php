<?php
/**
 * Shop Archive - Products Listing
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="shop-page">
        <!-- Shop Header -->
        <section class="shop-header">
            <div class="shop-header-content">
                <h1 class="shop-title">Cửa hàng</h1>
                <p class="shop-subtitle">Khám phá bộ sưu tập thiết bị phòng tắm cao cấp</p>
            </div>
        </section>

        <!-- Shop Content -->
        <section class="shop-content">
            <div class="container">
                <!-- Filters -->
                <div class="shop-filters">
                    <div class="filter-categories">
                        <h3 class="filter-title">Danh mục</h3>
                        <ul class="category-list">
                            <li><a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="<?php echo !is_tax() ? 'active' : ''; ?>">Tất cả</a></li>
                            <?php
                            $categories = get_terms(array(
                                'taxonomy' => 'product_category',
                                'hide_empty' => true,
                            ));
                            if ($categories && !is_wp_error($categories)) {
                                foreach ($categories as $category) {
                                    $active = is_tax('product_category', $category->slug) ? 'active' : '';
                                    echo '<li><a href="' . esc_url(get_term_link($category)) . '" class="' . $active . '">' . esc_html($category->name) . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-grid">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); 
                            $product_price = get_post_meta(get_the_ID(), '_product_price', true);
                            $product_sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
                            $product_image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400';
                        ?>
                            <div class="product-card">
                                <a href="<?php the_permalink(); ?>" class="product-link">
                                    <div class="product-image-wrapper">
                                        <img src="<?php echo esc_url($product_image); ?>" alt="<?php the_title(); ?>" class="product-image">
                                        <?php if ($product_sale_price) : ?>
                                            <span class="product-badge">Giảm giá</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><?php the_title(); ?></h3>
                                        <div class="product-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                        </div>
                                        <div class="product-price">
                                            <?php if ($product_sale_price) : ?>
                                                <span class="price-sale"><?php echo number_format($product_sale_price, 0, ',', '.'); ?> đ</span>
                                                <span class="price-original"><?php echo number_format($product_price, 0, ',', '.'); ?> đ</span>
                                            <?php elseif ($product_price) : ?>
                                                <span class="price-current"><?php echo number_format($product_price, 0, ',', '.'); ?> đ</span>
                                            <?php else : ?>
                                                <span class="price-contact">Liên hệ</span>
                                            <?php endif; ?>
                                        </div>
                                        <button class="product-button">Xem chi tiết</button>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <div class="no-products">
                            <p>Không tìm thấy sản phẩm nào.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="shop-pagination">
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
.shop-page {
    padding-top: 100px;
}

.shop-header {
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    padding: 80px 20px;
    text-align: center;
    color: white;
}

.shop-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 15px;
}

.shop-subtitle {
    font-size: 20px;
    opacity: 0.9;
}

.shop-content {
    padding: 60px 20px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.shop-filters {
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
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    transform: translateY(-2px);
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.product-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.product-image-wrapper {
    position: relative;
    width: 100%;
    padding-top: 75%;
    overflow: hidden;
    background: #f8f9fa;
}

.product-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #dc3545;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.product-info {
    padding: 25px;
}

.product-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #1a1a1a;
}

.product-excerpt {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
    line-height: 1.6;
}

.product-price {
    margin-bottom: 15px;
}

.price-current,
.price-sale {
    font-size: 24px;
    font-weight: 700;
    color: #087bb5;
}

.price-original {
    font-size: 18px;
    color: #999;
    text-decoration: line-through;
    margin-left: 10px;
}

.price-contact {
    font-size: 18px;
    color: #087bb5;
    font-weight: 600;
}

.product-button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(8, 123, 181, 0.3);
}

.no-products {
    text-align: center;
    padding: 60px 20px;
    color: #666;
    font-size: 18px;
}

.shop-pagination {
    margin-top: 50px;
    text-align: center;
}

@media (max-width: 768px) {
    .shop-title {
        font-size: 36px;
    }
    
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }
}
</style>

<?php
get_footer();
?>

