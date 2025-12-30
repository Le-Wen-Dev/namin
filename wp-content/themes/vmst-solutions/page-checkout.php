<?php
/**
 * Template Name: Checkout Page
 * Checkout - Flatsome/WooCommerce Style
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="checkout-page">
        <div class="container">
            <div class="checkout-header">
                <h1 class="checkout-title">Thanh toán</h1>
                <div class="checkout-steps">
                    <div class="step active">
                        <span class="step-number">1</span>
                        <span class="step-label">Giỏ hàng</span>
                    </div>
                    <div class="step active">
                        <span class="step-number">2</span>
                        <span class="step-label">Thanh toán</span>
                    </div>
                    <div class="step">
                        <span class="step-number">3</span>
                        <span class="step-label">Hoàn tất</span>
                    </div>
                </div>
            </div>
            
            <div class="checkout-wrapper">
                <div class="checkout-form-section">
                    <form id="checkout-form" class="checkout-form" novalidate>
                        <!-- Billing Information -->
                        <div class="checkout-section">
                            <h2 class="section-title">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Thông tin giao hàng
                            </h2>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Họ và tên *</label>
                                    <input type="text" name="customer_name" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="email" name="customer_email" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Số điện thoại *</label>
                                    <input type="tel" name="customer_phone" required pattern="[0-9]{10,11}">
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tỉnh/Thành phố *</label>
                                    <select name="customer_city" required>
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        <option value="hanoi">Hà Nội</option>
                                        <option value="hcm">Hồ Chí Minh</option>
                                        <option value="danang">Đà Nẵng</option>
                                        <option value="haiphong">Hải Phòng</option>
                                        <option value="cantho">Cần Thơ</option>
                                        <option value="other">Tỉnh/Thành phố khác</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Địa chỉ chi tiết *</label>
                                <input type="text" name="customer_address" required placeholder="Số nhà, tên đường, phường/xã">
                                <span class="error-message"></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Ghi chú đơn hàng</label>
                                <textarea name="customer_note" rows="4" placeholder="Ghi chú về đơn hàng của bạn (tùy chọn)"></textarea>
                            </div>
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="checkout-section">
                            <h2 class="section-title">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                                Phương thức thanh toán
                            </h2>
                            
                            <div class="payment-methods">
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="bank_transfer" checked>
                                    <div class="payment-option-content">
                                        <div class="payment-icon">🏦</div>
                                        <div>
                                            <span class="payment-name">Chuyển khoản ngân hàng</span>
                                            <span class="payment-desc">Chuyển khoản trực tiếp vào tài khoản ngân hàng</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="cod">
                                    <div class="payment-option-content">
                                        <div class="payment-icon">📦</div>
                                        <div>
                                            <span class="payment-name">Thanh toán khi nhận hàng (COD)</span>
                                            <span class="payment-desc">Thanh toán khi nhận được hàng</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="momo">
                                    <div class="payment-option-content">
                                        <div class="payment-icon">💳</div>
                                        <div>
                                            <span class="payment-name">Ví điện tử (MoMo)</span>
                                            <span class="payment-desc">Thanh toán qua ví điện tử MoMo</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="submit-order-btn" id="submit-order-btn">
                            <span class="btn-text">Đặt hàng</span>
                            <span class="btn-loader" style="display:none;">⏳</span>
                        </button>
                    </form>
                </div>
                
                <div class="checkout-summary">
                    <div class="summary-card">
                        <h2 class="summary-title">Đơn hàng của bạn</h2>
                        
                        <div id="checkout-items" class="checkout-items-list">
                            <!-- Items loaded via JS -->
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-content">
                            <div class="summary-row">
                                <span>Tạm tính:</span>
                                <span id="checkout-subtotal">0 đ</span>
                            </div>
                            <div class="summary-row">
                                <span>Phí vận chuyển:</span>
                                <span>30,000 đ</span>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="summary-row summary-total">
                                <span>Tổng cộng:</span>
                                <span id="checkout-total">0 đ</span>
                            </div>
                        </div>
                        
                        <div class="checkout-security">
                            <div class="security-badges">
                                <div class="security-badge">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                    <span>Bảo mật</span>
                                </div>
                                <div class="security-badge">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                    <span>Hỗ trợ 24/7</span>
                                </div>
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
const nonce = '<?php echo wp_create_nonce('vmst-nonce'); ?>';

document.addEventListener('DOMContentLoaded', function() {
    loadCheckoutItems();
    
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        submitOrder();
    });
    
    // Real-time validation
    const inputs = document.querySelectorAll('#checkout-form input[required], #checkout-form select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
    });
});

async function loadCheckoutItems() {
    if (!window.NaminCart) {
        console.error('NaminCart not loaded');
        return;
    }
    
    const cart = window.NaminCart.getCart();
    const container = document.getElementById('checkout-items');
    
    if (cart.length === 0) {
        window.location.href = homeUrl + '/cart';
        return;
    }
    
    // Fetch product data
    const products = await fetchProductData(cart);
    
    let html = '';
    let subtotal = 0;
    
    cart.forEach(item => {
        const product = products[item.id] || {};
        const productPrice = item.price || product.price || 0;
        const productTitle = item.title || product.title || `Sản phẩm #${item.id}`;
        const productImage = item.image || product.image || 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=80';
        const itemTotal = productPrice * item.quantity;
        subtotal += itemTotal;
        
        html += `
            <div class="checkout-item">
                <div class="checkout-item-image">
                    <img src="${productImage}" alt="${productTitle}">
                </div>
                <div class="checkout-item-info">
                    <h4 class="checkout-item-title">${productTitle}</h4>
                    ${item.variant ? `<p class="checkout-item-variant">${item.variant}</p>` : ''}
                    <span class="checkout-item-qty">Số lượng: ${item.quantity}</span>
                </div>
                <div class="checkout-item-price">${formatPrice(itemTotal)} đ</div>
            </div>
        `;
    });
    
    container.innerHTML = html;
    
    const shipping = 30000;
    const total = subtotal + shipping;
    
    document.getElementById('checkout-subtotal').textContent = formatPrice(subtotal) + ' đ';
    document.getElementById('checkout-total').textContent = formatPrice(total) + ' đ';
}

async function fetchProductData(cart) {
    const productIds = [...new Set(cart.map(item => item.id))];
    const products = {};
    
    if (productIds.length === 0) return products;
    
    // Fetch all products at once
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
                        image: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=80',
                    };
                }
            })
            .catch(() => {
                products[id] = {
                    id: id,
                    title: `Sản phẩm #${id}`,
                    price: 0,
                    image: 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=80',
                };
            });
    });
    
    await Promise.all(promises);
    return products;
}

function validateField(field) {
    const errorMsg = field.parentElement.querySelector('.error-message');
    
    if (!field.validity.valid) {
        field.classList.add('error');
        if (errorMsg) {
            if (field.validity.valueMissing) {
                errorMsg.textContent = 'Trường này là bắt buộc';
            } else if (field.validity.typeMismatch) {
                errorMsg.textContent = 'Định dạng không đúng';
            } else if (field.validity.patternMismatch) {
                errorMsg.textContent = 'Số điện thoại không hợp lệ';
            }
        }
        return false;
    } else {
        field.classList.remove('error');
        if (errorMsg) errorMsg.textContent = '';
        return true;
    }
}

function submitOrder() {
    const form = document.getElementById('checkout-form');
    const submitBtn = document.getElementById('submit-order-btn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');
    
    // Validate all fields
    const inputs = form.querySelectorAll('input[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        alert('Vui lòng điền đầy đủ thông tin bắt buộc');
        return;
    }
    
    if (!window.NaminCart) {
        alert('Lỗi: Giỏ hàng không khả dụng');
        return;
    }
    
    const cart = window.NaminCart.getCart();
    if (cart.length === 0) {
        alert('Giỏ hàng trống!');
        window.location.href = homeUrl + '/cart';
        return;
    }
    
    // Disable submit button
    submitBtn.disabled = true;
    btnText.style.display = 'none';
    btnLoader.style.display = 'inline-block';
    
    const formData = new FormData(form);
    const orderData = {
        customer_name: formData.get('customer_name'),
        customer_email: formData.get('customer_email'),
        customer_phone: formData.get('customer_phone'),
        customer_city: formData.get('customer_city'),
        customer_address: formData.get('customer_address'),
        customer_note: formData.get('customer_note') || '',
        payment_method: formData.get('payment_method'),
        items: cart,
        total: calculateTotal()
    };
    
    // Submit via AJAX
    fetch(ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'vmst_submit_order',
            nonce: nonce,
            order_data: JSON.stringify(orderData)
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear cart
            localStorage.removeItem('namin_cart');
            if (window.NaminCart) {
                window.NaminCart.updateCartCount();
            }
            
            // Redirect to success page
            window.location.href = homeUrl + '/account?order=' + data.data.order_id;
        } else {
            alert('Có lỗi xảy ra: ' + (data.data || 'Vui lòng thử lại'));
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoader.style.display = 'none';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra. Vui lòng thử lại.');
        submitBtn.disabled = false;
        btnText.style.display = 'inline';
        btnLoader.style.display = 'none';
    });
}

function calculateTotal() {
    if (!window.NaminCart) return 0;
    return window.NaminCart.getTotal() + 30000;
}

function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.checkout-page {
    padding-top: 120px;
    padding-bottom: 80px;
    background: #f8f9fa;
    min-height: 80vh;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.checkout-header {
    text-align: center;
    margin-bottom: 50px;
}

.checkout-title {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 30px;
    color: #1a1a1a;
}

.checkout-steps {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    max-width: 600px;
    margin: 0 auto;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    flex: 1;
    position: relative;
}

.step::after {
    content: '';
    position: absolute;
    top: 15px;
    left: 60%;
    width: 80%;
    height: 2px;
    background: #e9ecef;
    z-index: 0;
}

.step:last-child::after {
    display: none;
}

.step.active::after {
    background: #087bb5;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e9ecef;
    color: #999;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    position: relative;
    z-index: 1;
}

.step.active .step-number {
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
}

.step-label {
    font-size: 13px;
    color: #666;
    font-weight: 500;
}

.step.active .step-label {
    color: #087bb5;
    font-weight: 600;
}

.checkout-wrapper {
    display: grid;
    grid-template-columns: 1fr 450px;
    gap: 40px;
}

.checkout-form-section {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.checkout-section {
    margin-bottom: 40px;
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #1a1a1a;
}

.section-title svg {
    color: #087bb5;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
    font-size: 14px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s ease;
    font-family: inherit;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #087bb5;
    box-shadow: 0 0 0 3px rgba(8, 123, 181, 0.1);
}

.form-group input.error,
.form-group select.error {
    border-color: #dc3545;
}

.error-message {
    display: block;
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    min-height: 18px;
}

.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.payment-option {
    display: block;
    cursor: pointer;
}

.payment-option input[type="radio"] {
    display: none;
}

.payment-option-content {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 20px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.payment-option input[type="radio"]:checked + .payment-option-content {
    border-color: #087bb5;
    background: #f0f8ff;
    box-shadow: 0 0 0 3px rgba(8, 123, 181, 0.1);
}

.payment-option:hover .payment-option-content {
    border-color: #087bb5;
}

.payment-icon {
    font-size: 32px;
    flex-shrink: 0;
}

.payment-name {
    display: block;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.payment-desc {
    display: block;
    font-size: 13px;
    color: #666;
}

.submit-order-btn {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.submit-order-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(8, 123, 181, 0.3);
}

.submit-order-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.checkout-summary {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.summary-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.summary-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e9ecef;
}

.checkout-items-list {
    margin-bottom: 20px;
    max-height: 400px;
    overflow-y: auto;
}

.checkout-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.checkout-item:last-child {
    border-bottom: none;
}

.checkout-item-image {
    width: 70px;
    height: 70px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
}

.checkout-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.checkout-item-info {
    flex: 1;
    min-width: 0;
}

.checkout-item-title {
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #1a1a1a;
}

.checkout-item-variant {
    font-size: 12px;
    color: #666;
    margin: 0 0 5px 0;
}

.checkout-item-qty {
    font-size: 12px;
    color: #666;
}

.checkout-item-price {
    font-size: 16px;
    font-weight: 700;
    color: #087bb5;
    align-self: flex-start;
}

.summary-divider {
    height: 1px;
    background: #e9ecef;
    margin: 20px 0;
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

.summary-total {
    font-size: 22px;
    font-weight: 700;
    color: #087bb5;
    margin-top: 10px;
}

.checkout-security {
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.security-badges {
    display: flex;
    gap: 20px;
    justify-content: center;
}

.security-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #28a745;
    font-size: 13px;
    font-weight: 500;
}

.security-badge svg {
    flex-shrink: 0;
}

@media (max-width: 968px) {
    .checkout-wrapper {
        grid-template-columns: 1fr;
    }
    
    .checkout-summary {
        position: static;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .checkout-steps {
        flex-direction: column;
        gap: 15px;
    }
    
    .step::after {
        display: none;
    }
}
</style>

<?php
get_footer();
?>
