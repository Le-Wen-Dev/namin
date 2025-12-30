<?php
/**
 * Single Product Template
 * Template Name: Single Product
 */

// Debug: Check if we're on a product page
if (!is_singular('product')) {
    // If not a product, try to get the post
    global $wp_query;
    if (isset($wp_query->queried_object) && $wp_query->queried_object->post_type === 'product') {
        // Force it to be recognized as product
    } else {
        // Fallback to single.php if not product
        // But first, let's check if this is actually a product
    }
}

get_header();

// Check if we have posts
if (have_posts()) :
    while (have_posts()) : the_post();
        $product_id = get_the_ID();
        $product_price = get_post_meta($product_id, '_product_price', true);
        $product_sale_price = get_post_meta($product_id, '_product_sale_price', true);
        $product_sku = get_post_meta($product_id, '_product_sku', true);
        $product_stock = get_post_meta($product_id, '_product_stock', true);
        $product_variants = get_post_meta($product_id, '_product_variants', true);
        $product_gallery = get_post_meta($product_id, '_product_gallery', true);
        
        // Get featured image
        $product_image = '';
        if (has_post_thumbnail($product_id)) {
            $product_image = get_the_post_thumbnail_url($product_id, 'full');
        }
        if (!$product_image) {
            $product_image = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800';
        }
        
        // Ensure variants is array
        if (!is_array($product_variants)) {
            $product_variants = array();
        }
        
        // Ensure gallery is array
        if (!is_array($product_gallery)) {
            $product_gallery = array();
        }
?>

<main id="main-content" class="site-main">
    <div class="product-page">
        <div class="container">
            <div class="product-wrapper">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="product-main-image">
                        <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" id="main-product-image">
                    </div>
                    <?php if (!empty($product_gallery)) : ?>
                        <div class="product-gallery">
                            <?php foreach ($product_gallery as $gallery_image) : 
                                if (!empty($gallery_image)) :
                            ?>
                                <div class="gallery-thumb" onclick="changeMainImage('<?php echo esc_js($gallery_image); ?>')">
                                    <img src="<?php echo esc_url($gallery_image); ?>" alt="Gallery">
                                </div>
                            <?php 
                                endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-title"><?php the_title(); ?></h1>
                    
                    <div class="product-meta">
                        <?php if (!empty($product_sku)) : ?>
                            <div class="product-sku">
                                <span class="meta-label">Mã sản phẩm:</span>
                                <span class="meta-value"><?php echo esc_html($product_sku); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-stock">
                            <span class="meta-label">Tình trạng:</span>
                            <span class="meta-value <?php echo ($product_stock && intval($product_stock) > 0) ? 'in-stock' : 'out-of-stock'; ?>">
                                <?php echo ($product_stock && intval($product_stock) > 0) ? 'Còn hàng (' . intval($product_stock) . ')' : 'Hết hàng'; ?>
                            </span>
                        </div>
                    </div>

                    <div class="product-price-section">
                        <?php if (!empty($product_sale_price) && floatval($product_sale_price) > 0) : ?>
                            <span class="price-sale"><?php echo number_format(floatval($product_sale_price), 0, ',', '.'); ?> đ</span>
                            <?php if (!empty($product_price) && floatval($product_price) > 0) : ?>
                                <span class="price-original"><?php echo number_format(floatval($product_price), 0, ',', '.'); ?> đ</span>
                            <?php endif; ?>
                        <?php elseif (!empty($product_price) && floatval($product_price) > 0) : ?>
                            <span class="price-current"><?php echo number_format(floatval($product_price), 0, ',', '.'); ?> đ</span>
                        <?php else : ?>
                            <span class="price-contact">Liên hệ để biết giá</span>
                        <?php endif; ?>
                    </div>

                    <div class="product-description">
                        <?php the_content(); ?>
                    </div>

                    <!-- Product Variants -->
                    <?php if (!empty($product_variants)) : ?>
                        <div class="product-variants-section">
                            <h3 class="variants-title">Tùy chọn sản phẩm</h3>
                            <div class="variants-list">
                                <?php foreach ($product_variants as $variant) : 
                                    if (!empty($variant['name'])) :
                                        $variant_price = isset($variant['price']) ? floatval($variant['price']) : 0;
                                ?>
                                    <div class="variant-item">
                                        <label>
                                            <input type="radio" name="product_variant" value="<?php echo esc_attr($variant['name']); ?>" data-price="<?php echo esc_attr($variant_price); ?>">
                                            <span class="variant-name"><?php echo esc_html($variant['name']); ?></span>
                                            <?php if ($variant_price > 0) : ?>
                                                <span class="variant-price"><?php echo number_format($variant_price, 0, ',', '.'); ?> đ</span>
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                <?php 
                                    endif;
                                endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Add to Cart -->
                    <div class="product-actions">
                        <div class="quantity-selector">
                            <button type="button" class="qty-btn" onclick="changeQuantity(-1)">-</button>
                            <input type="number" id="product-quantity" value="1" min="1" max="<?php echo $product_stock ? intval($product_stock) : 999; ?>">
                            <button type="button" class="qty-btn" onclick="changeQuantity(1)">+</button>
                        </div>
                        <button type="button" class="add-to-cart-btn" id="add-to-cart-btn" data-product-id="<?php echo intval($product_id); ?>" data-product-title="<?php echo esc_attr(get_the_title()); ?>" data-product-image="<?php echo esc_url($product_image); ?>">
                            <span class="cart-icon">🛒</span>
                            <span class="btn-text">Thêm vào giỏ hàng</span>
                        </button>
                    </div>

                    <!-- Product Categories -->
                    <div class="product-categories">
                        <span class="categories-label">Danh mục:</span>
                        <?php
                        $categories = get_the_terms($product_id, 'product_category');
                        if ($categories && !is_wp_error($categories)) {
                            foreach ($categories as $category) {
                                echo '<a href="' . esc_url(get_term_link($category)) . '" class="category-tag">' . esc_html($category->name) . '</a>';
                            }
                        } else {
                            echo '<span class="no-category">Chưa có danh mục</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <?php
            $related_products = get_posts(array(
                'post_type' => 'product',
                'posts_per_page' => 4,
                'post__not_in' => array($product_id),
                'orderby' => 'rand',
                'post_status' => 'publish'
            ));
            if (!empty($related_products)) :
            ?>
                <div class="related-products">
                    <h2 class="related-title">Sản phẩm liên quan</h2>
                    <div class="related-grid">
                        <?php foreach ($related_products as $related) : 
                            $related_price = get_post_meta($related->ID, '_product_price', true);
                            $related_image = '';
                            if (has_post_thumbnail($related->ID)) {
                                $related_image = get_the_post_thumbnail_url($related->ID, 'medium');
                            }
                            if (!$related_image) {
                                $related_image = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400';
                            }
                        ?>
                            <div class="related-card">
                                <a href="<?php echo esc_url(get_permalink($related->ID)); ?>">
                                    <img src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr(get_the_title($related->ID)); ?>">
                                    <h3><?php echo esc_html(get_the_title($related->ID)); ?></h3>
                                    <?php if (!empty($related_price) && floatval($related_price) > 0) : ?>
                                        <p class="related-price"><?php echo number_format(floatval($related_price), 0, ',', '.'); ?> đ</p>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
function changeMainImage(imageUrl) {
    const mainImg = document.getElementById('main-product-image');
    if (mainImg) {
        mainImg.src = imageUrl;
    }
}

function changeQuantity(change) {
    const input = document.getElementById('product-quantity');
    if (!input) return;
    
    let value = parseInt(input.value) + change;
    const max = parseInt(input.max) || 999;
    const min = parseInt(input.min) || 1;
    if (value < min) value = min;
    if (value > max) value = max;
    input.value = value;
}

// Add to Cart with AJAX (Flatsome Style)
document.addEventListener('DOMContentLoaded', function() {
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', async function() {
            const productId = parseInt(this.dataset.productId);
            const productTitle = this.dataset.productTitle;
            const productImage = this.dataset.productImage;
            const quantityInput = document.getElementById('product-quantity');
            const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;
            const variantInput = document.querySelector('input[name="product_variant"]:checked');
            
            // Get price from page
            let price = null;
            const priceEl = document.querySelector('.price-current, .price-sale');
            if (priceEl) {
                const priceText = priceEl.textContent.replace(/[^\d]/g, '');
                price = parseInt(priceText) || null;
            }
            if (variantInput && variantInput.dataset.price) {
                price = parseFloat(variantInput.dataset.price);
            }
            
            // If no price found, fetch from database
            if (!price && window.NaminCart) {
                try {
                    const product = await window.NaminCart.fetchSingleProduct(productId);
                    if (product && product.price) {
                        price = product.price;
                    }
                } catch (error) {
                    console.error('Error fetching product price:', error);
                }
            }
            
            const variant = variantInput ? variantInput.value : null;
            
            // Add to cart using NaminCart
            if (window.NaminCart) {
                window.NaminCart.addItem(productId, quantity, variant, price, productTitle, productImage);
                
                // Show success message
                const btnText = this.querySelector('.btn-text');
                const originalText = btnText ? btnText.textContent : 'Thêm vào giỏ hàng';
                
                if (btnText) {
                    btnText.textContent = 'Đã thêm!';
                    this.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
                    
                    setTimeout(() => {
                        btnText.textContent = originalText;
                        this.style.background = '';
                    }, 2000);
                }
                
                // Open mini cart
                const miniCart = document.getElementById('mini-cart');
                if (miniCart) {
                    miniCart.classList.add('active');
                }
            }
        });
    }
});
</script>

<style>
.product-page {
    padding-top: 100px;
    padding-bottom: 80px;
    min-height: 60vh;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.product-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 80px;
}

.product-images {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.product-main-image {
    width: 100%;
    margin-bottom: 20px;
    border-radius: 12px;
    overflow: hidden;
    background: #f8f9fa;
}

.product-main-image img {
    width: 100%;
    height: auto;
    display: block;
}

.product-gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.gallery-thumb {
    cursor: pointer;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid transparent;
    transition: border-color 0.3s ease;
}

.gallery-thumb:hover {
    border-color: #087bb5;
}

.gallery-thumb img {
    width: 100%;
    height: auto;
    display: block;
}

.product-info {
    padding: 20px 0;
}

.product-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 30px;
    color: #1a1a1a;
}

.product-meta {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e9ecef;
}

.meta-label {
    font-weight: 600;
    color: #666;
    margin-right: 8px;
}

.meta-value {
    color: #1a1a1a;
}

.meta-value.in-stock {
    color: #28a745;
    font-weight: 600;
}

.meta-value.out-of-stock {
    color: #dc3545;
    font-weight: 600;
}

.product-price-section {
    margin-bottom: 30px;
}

.price-current,
.price-sale {
    font-size: 36px;
    font-weight: 700;
    color: #087bb5;
    display: block;
    margin-bottom: 10px;
}

.price-original {
    font-size: 24px;
    color: #999;
    text-decoration: line-through;
    margin-left: 15px;
}

.price-contact {
    font-size: 24px;
    color: #087bb5;
    font-weight: 600;
}

.product-description {
    margin-bottom: 30px;
    line-height: 1.8;
    color: #333;
}

.product-variants-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
}

.variants-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 15px;
}

.variants-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.variant-item label {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: white;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.variant-item label:hover {
    background: #e9ecef;
}

.variant-item input[type="radio"] {
    margin-right: 10px;
}

.variant-name {
    flex: 1;
}

.variant-price {
    font-weight: 600;
    color: #087bb5;
}

.product-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
}

.quantity-selector {
    display: flex;
    align-items: center;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
}

.qty-btn {
    width: 40px;
    height: 50px;
    border: none;
    background: #f8f9fa;
    cursor: pointer;
    font-size: 20px;
    font-weight: 600;
    transition: background 0.3s ease;
}

.qty-btn:hover {
    background: #e9ecef;
}

#product-quantity {
    width: 60px;
    height: 50px;
    border: none;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
}

.add-to-cart-btn {
    flex: 1;
    padding: 15px 30px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(8, 123, 181, 0.3);
}

.product-categories {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.categories-label {
    font-weight: 600;
    color: #666;
}

.category-tag {
    padding: 6px 15px;
    background: #f8f9fa;
    border-radius: 20px;
    text-decoration: none;
    color: #087bb5;
    font-size: 14px;
    transition: background 0.3s ease;
}

.category-tag:hover {
    background: #e9ecef;
}

.no-category {
    color: #999;
    font-size: 14px;
}

.related-products {
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
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
    height: 200px;
    object-fit: cover;
}

.related-card h3 {
    padding: 15px;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.related-price {
    padding: 0 15px 15px;
    font-size: 20px;
    font-weight: 700;
    color: #087bb5;
}

@media (max-width: 968px) {
    .product-wrapper {
        grid-template-columns: 1fr;
    }
    
    .product-images {
        position: static;
    }
    
    .product-title {
        font-size: 28px;
    }
}
</style>

<?php
    endwhile;
else :
    // No posts found
    ?>
    <main id="main-content" class="site-main">
        <div class="product-page">
            <div class="container">
                <div style="text-align: center; padding: 100px 20px;">
                    <h1>Sản phẩm không tìm thấy</h1>
                    <p>Sản phẩm này có thể đã bị xóa hoặc không tồn tại.</p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" style="display: inline-block; margin-top: 20px; padding: 12px 30px; background: #087bb5; color: white; text-decoration: none; border-radius: 8px;">Về trang sản phẩm</a>
                </div>
            </div>
        </div>
    </main>
    <?php
endif;

get_footer();
?>
