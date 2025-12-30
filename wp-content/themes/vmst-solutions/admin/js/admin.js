/**
 * Namin Admin Dashboard JavaScript
 */

jQuery(document).ready(function($) {
    // Product Variants Management
    if ($('.product-variants').length) {
        // Add new variant
        $(document).on('click', '.add-variant', function(e) {
            e.preventDefault();
            var variantHtml = `
                <div class="variant-item">
                    <div class="variant-item-header">
                        <strong>Biến thể mới</strong>
                        <button type="button" class="button remove-variant">Xóa</button>
                    </div>
                    <div class="variant-fields">
                        <div>
                            <label>Tên biến thể</label>
                            <input type="text" name="variants[][name]" placeholder="VD: Màu đen, Size L">
                        </div>
                        <div>
                            <label>SKU</label>
                            <input type="text" name="variants[][sku]" placeholder="SKU-001">
                        </div>
                        <div>
                            <label>Giá</label>
                            <input type="number" name="variants[][price]" placeholder="0">
                        </div>
                        <div>
                            <label>Số lượng</label>
                            <input type="number" name="variants[][stock]" placeholder="0">
                        </div>
                    </div>
                </div>
            `;
            $('.variants-list').append(variantHtml);
        });
        
        // Remove variant
        $(document).on('click', '.remove-variant', function(e) {
            e.preventDefault();
            if (confirm('Bạn có chắc muốn xóa biến thể này?')) {
                $(this).closest('.variant-item').remove();
            }
        });
    }
    
    // Tab switching
    $('.namin-tabs .nav-tab').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('.nav-tab').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        $('.namin-tab-content').removeClass('active');
        $(target).addClass('active');
    });
    
    // Order items management
    if ($('.order-items').length) {
        // Add new order item
        $(document).on('click', '.add-order-item', function(e) {
            e.preventDefault();
            var index = $('.order-item').length;
            var itemHtml = `
                <div class="order-item">
                    <input type="text" name="order_items[${index}][name]" placeholder="Tên sản phẩm" class="regular-text">
                    <input type="number" name="order_items[${index}][quantity]" placeholder="Số lượng" value="1" min="1">
                    <input type="number" name="order_items[${index}][price]" placeholder="Giá" value="0" min="0">
                    <button type="button" class="button remove-order-item">Xóa</button>
                </div>
            `;
            $('.order-items').append(itemHtml);
        });
        
        // Remove order item
        $(document).on('click', '.remove-order-item', function(e) {
            e.preventDefault();
            $(this).closest('.order-item').remove();
        });
    }
});

