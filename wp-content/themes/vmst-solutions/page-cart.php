<?php
/**
 * Template Name: Cart Page
 * Shopping Cart - Flatsome/WooCommerce Style
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="cart-page">
        <div class="container">
            <div class="cart-header">
                <h1 class="cart-title">Giỏ hàng</h1>
                <p class="cart-subtitle"><?php echo esc_html(get_bloginfo('name')); ?></p>
            </div>
            
            <div class="cart-wrapper">
                <div class="cart-items-section">
                    <div class="cart-table-header">
                        <div class="cart-col-product">Sản phẩm</div>
                        <div class="cart-col-price">Giá</div>
                        <div class="cart-col-quantity">Số lượng</div>
                        <div class="cart-col-total">Tổng</div>
                        <div class="cart-col-remove"></div>
                    </div>
                    
                    <div id="cart-items-container" class="cart-items-list">
                        <!-- Cart items loaded via JS -->
                    </div>
                    
                    <div class="cart-actions">
                        <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn-continue-shopping">
                            ← Tiếp tục mua sắm
                        </a>
                        <button type="button" class="btn-update-cart" id="update-cart-btn" style="display:none;">
                            Cập nhật giỏ hàng
                        </button>
                    </div>
                </div>
                
                <div class="cart-summary">
                    <div class="cart-summary-card">
                        <h2 class="summary-title">Tóm tắt đơn hàng</h2>
                        
                        <div class="summary-content">
                            <div class="summary-row">
                                <span>Tạm tính:</span>
                                <span id="cart-subtotal">0 đ</span>
                            </div>
                            <div class="summary-row">
                                <span>Phí vận chuyển:</span>
                                <span id="cart-shipping">30,000 đ</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-row summary-total">
                                <span>Tổng cộng:</span>
                                <span id="cart-total">0 đ</span>
                            </div>
                        </div>
                        
                        <div class="summary-actions">
                            <a href="<?php echo esc_url(home_url('/checkout')); ?>" class="btn-checkout" id="checkout-btn">
                                Thanh toán
                            </a>
                            <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn-continue">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                        
                        <div class="cart-security">
                            <div class="security-badge">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                <span>Thanh toán an toàn & bảo mật</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
const homeUrl = '<?php echo esc_url(home_url()); ?>';
const ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    
    // Update cart button
    document.getElementById('update-cart-btn')?.addEventListener('click', function() {
        loadCart();
        this.style.display = 'none';
    });
});

function loadCart() {
    if (!window.NaminCart) {
        console.error('NaminCart not loaded');
        return;
    }
    
    const cart = window.NaminCart.getCart();
    const container = document.getElementById('cart-items-container');
    const checkoutBtn = document.getElementById('checkout-btn');
    const updateBtn = document.getElementById('update-cart-btn');
    
    if (cart.length === 0) {
        container.innerHTML = `
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M9 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4m7 14h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-5 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M9 7h6"/>
                    </svg>
                </div>
                <h2>Giỏ hàng trống</h2>
                <p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                <a href="${homeUrl}/san-pham" class="btn-shop-now">Mua sắm ngay</a>
            </div>
        `;
        if (checkoutBtn) checkoutBtn.style.display = 'none';
        updateSummary(0);
        return;
    }
    
    // Fetch product data via AJAX
    fetchProductData(cart).then(products => {
        let html = '';
        let subtotal = 0;
        
        cart.forEach((item, index) => {
            const product = products[item.id] || {};
            const productPrice = item.price || product.price || 0;
            const productTitle = item.title || product.title || `Sản phẩm #${item.id}`;
            const productImage = item.image || product.image || 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=150';
            const itemTotal = productPrice * item.quantity;
            subtotal += itemTotal;
            
            html += `
                <div class="cart-item" data-index="${index}">
                    <div class="cart-col-product">
                        <div class="cart-item-image">
                            <a href="${product.permalink || '#'}">
                                <img src="${productImage}" alt="${productTitle}">
                            </a>
                        </div>
                        <div class="cart-item-info">
                            <h3 class="cart-item-title">
                                <a href="${product.permalink || '#'}">${productTitle}</a>
                            </h3>
                            ${item.variant ? `<p class="cart-item-variant">${item.variant}</p>` : ''}
                            ${product.sku ? `<p class="cart-item-sku">SKU: ${product.sku}</p>` : ''}
                        </div>
                    </div>
                    <div class="cart-col-price">
                        <span class="cart-item-price">${formatPrice(productPrice)} đ</span>
                    </div>
                    <div class="cart-col-quantity">
                        <div class="quantity-controls">
                            <button type="button" class="qty-btn qty-minus" onclick="updateCartQty(${index}, -1)">−</button>
                            <input type="number" class="qty-input" value="${item.quantity}" min="1" 
                                   onchange="updateCartQty(${index}, 0, this.value)" 
                                   data-index="${index}">
                            <button type="button" class="qty-btn qty-plus" onclick="updateCartQty(${index}, 1)">+</button>
                        </div>
                    </div>
                    <div class="cart-col-total">
                        <span class="cart-item-total">${formatPrice(itemTotal)} đ</span>
                    </div>
                    <div class="cart-col-remove">
                        <button type="button" class="cart-item-remove" onclick="removeCartItem(${index})" title="Xóa">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        });
        
        container.innerHTML = html;
        updateSummary(subtotal);
        if (checkoutBtn) checkoutBtn.style.display = 'block';
    });
}

async function fetchProductData(cart) {
    const productIds = [...new Set(cart.map(item => item.id))];
    const products = {};
    
    if (productIds.length === 0) return products;
    
    // Fetch all products at once
    const ajaxurl = (typeof vmstAjax !== 'undefined' && vmstAjax.ajaxurl) ? vmstAjax.ajaxurl : homeUrl + '/wp-admin/admin-ajax.php';
    
    try {
        const response = await fetch(`${ajaxurl}?action=vmst_get_products_data&product_ids=${JSON.stringify(productIds)}`);
        const data = await response.json();
        
        if (data.success && data.data) {
            return data.data;
        }
    } catch (error) {
        console.error('Error fetching products:', error);
    }
    
    // Fallback: fetch individually
    const promises = productIds.map(id => {
        return fetch(`${ajaxurl}?action=vmst_get_product_data&product_id=${id}`)
            .then(res => res.json())
            .then(data => {
                if (data.success && data.data) {
                    products[id] = data.data;
                } else {
                    products[id] = {
                        id: id,
                        title: `Sản phẩm #${id}`,
                        price: 0,
                        image: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=150',
                        permalink: `${homeUrl}/san-pham/`
                    };
                }
            })
            .catch(() => {
                products[id] = {
                    id: id,
                    title: `Sản phẩm #${id}`,
                    price: 0,
                    image: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=150',
                    permalink: `${homeUrl}/san-pham/`
                };
            });
    });
    
    await Promise.all(promises);
    return products;
}

function updateCartQty(index, change, newValue) {
    if (!window.NaminCart) return;
    
    const cart = window.NaminCart.getCart();
    if (!cart[index]) return;
    
    let quantity = cart[index].quantity;
    if (newValue !== undefined) {
        quantity = Math.max(1, parseInt(newValue) || 1);
    } else {
        quantity = Math.max(1, quantity + change);
    }
    
    window.NaminCart.updateQuantity(index, quantity);
    loadCart();
    
    // Show update button
    const updateBtn = document.getElementById('update-cart-btn');
    if (updateBtn) updateBtn.style.display = 'inline-block';
}

function removeCartItem(index) {
    if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) return;
    
    if (window.NaminCart) {
        window.NaminCart.removeItem(index);
        loadCart();
    }
}

function updateSummary(subtotal) {
    const shipping = 30000;
    const total = subtotal + shipping;
    
    document.getElementById('cart-subtotal').textContent = formatPrice(subtotal) + ' đ';
    document.getElementById('cart-total').textContent = formatPrice(total) + ' đ';
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.cart-page {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: 70vh;
    background: #f8f9fa;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.cart-header {
    text-align: center;
    margin-bottom: 50px;
}

.cart-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #1a1a1a;
}

.cart-subtitle {
    font-size: 18px;
    color: #666;
}

.cart-wrapper {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 40px;
}

.cart-items-section {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.cart-table-header {
    display: grid;
    grid-template-columns: 2fr 1fr 150px 1fr 50px;
    gap: 20px;
    padding: 15px 0;
    border-bottom: 2px solid #e9ecef;
    font-weight: 600;
    font-size: 14px;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.cart-items-list {
    margin: 20px 0;
}

.cart-item {
    display: grid;
    grid-template-columns: 2fr 1fr 150px 1fr 50px;
    gap: 20px;
    align-items: center;
    padding: 25px 0;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.2s ease;
}

.cart-item:hover {
    background: #f8f9fa;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-col-product {
    display: flex;
    gap: 20px;
    align-items: center;
}

.cart-item-image {
    width: 100px;
    height: 100px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
}

.cart-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-item-info {
    flex: 1;
}

.cart-item-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

.cart-item-title a {
    color: #1a1a1a;
    text-decoration: none;
    transition: color 0.2s ease;
}

.cart-item-title a:hover {
    color: #087bb5;
}

.cart-item-variant,
.cart-item-sku {
    font-size: 13px;
    color: #666;
    margin: 4px 0;
}

.cart-item-price {
    font-size: 16px;
    font-weight: 600;
    color: #087bb5;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    width: fit-content;
}

.qty-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: #f8f9fa;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    color: #666;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: #e9ecef;
    color: #087bb5;
}

.qty-input {
    width: 50px;
    height: 36px;
    border: none;
    text-align: center;
    font-size: 15px;
    font-weight: 600;
}

.cart-item-total {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
}

.cart-item-remove {
    width: 36px;
    height: 36px;
    border: none;
    background: transparent;
    color: #999;
    cursor: pointer;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.cart-item-remove:hover {
    background: #fee;
    color: #dc3545;
}

.cart-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 30px;
    border-top: 1px solid #e9ecef;
}

.btn-continue-shopping {
    color: #087bb5;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}

.btn-continue-shopping:hover {
    color: #065a87;
}

.btn-update-cart {
    padding: 12px 24px;
    background: #087bb5;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-update-cart:hover {
    background: #065a87;
    transform: translateY(-2px);
}

.empty-cart {
    text-align: center;
    padding: 80px 20px;
}

.empty-cart-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 30px;
    color: #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-cart h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #1a1a1a;
}

.empty-cart p {
    color: #666;
    margin-bottom: 30px;
    font-size: 16px;
}

.btn-shop-now {
    display: inline-block;
    padding: 15px 40px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-shop-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(8, 123, 181, 0.3);
}

.cart-summary {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.cart-summary-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.summary-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
}

.summary-content {
    margin-bottom: 25px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 16px;
    color: #333;
}

.summary-divider {
    height: 1px;
    background: #e9ecef;
    margin: 20px 0;
}

.summary-total {
    font-size: 20px;
    font-weight: 700;
    color: #087bb5;
    margin-top: 10px;
}

.summary-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 25px;
}

.btn-checkout {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    text-decoration: none;
    text-align: center;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(8, 123, 181, 0.3);
}

.btn-continue {
    width: 100%;
    padding: 14px;
    background: white;
    color: #087bb5;
    text-decoration: none;
    text-align: center;
    border: 2px solid #087bb5;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-continue:hover {
    background: #087bb5;
    color: white;
}

.cart-security {
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.security-badge {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #28a745;
    font-size: 14px;
    font-weight: 500;
}

.security-badge svg {
    flex-shrink: 0;
}

@media (max-width: 968px) {
    .cart-wrapper {
        grid-template-columns: 1fr;
    }
    
    .cart-summary {
        position: static;
    }
    
    .cart-table-header,
    .cart-item {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .cart-col-product {
        grid-column: 1;
    }
    
    .cart-col-price,
    .cart-col-quantity,
    .cart-col-total,
    .cart-col-remove {
        grid-column: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
}
</style>

<?php
get_footer();
?>
