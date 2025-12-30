<?php
/**
 * Template Name: Trang Báo giá
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="pricing-section">
    <div class="content-area">
        <div class="pricing-header">
            <h1 class="section-title">Báo giá</h1>
            <p class="section-subtitle">Tham khảo giá thiết bị phòng tắm, nhà vệ sinh cao cấp</p>
        </div>
        
        <?php if (current_user_can('manage_options')) : ?>
            <div class="pricing-admin-controls">
                <button id="add-pricing-group" class="btn btn-primary">Thêm nhóm báo giá</button>
            </div>
        <?php endif; ?>
        
        <div id="pricing-groups" class="pricing-groups">
            <?php
            $pricing_groups = get_posts(array(
                'post_type' => 'pricing_group',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            ));
            
            foreach ($pricing_groups as $group) :
                $images = get_post_meta($group->ID, '_pricing_images', true);
                if (!is_array($images)) $images = array();
            ?>
                <div class="pricing-group" data-id="<?php echo $group->ID; ?>">
                    <?php if (current_user_can('manage_options')) : ?>
                        <div class="pricing-group-actions">
                            <button class="edit-group">Sửa</button>
                            <button class="delete-group">Xóa</button>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="pricing-group-title"><?php echo get_the_title($group->ID); ?></h2>
                    
                    <div class="pricing-group-images">
                        <?php foreach ($images as $image) : ?>
                            <div class="pricing-image-item">
                                <img src="<?php echo esc_url($image); ?>" alt="Báo giá">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if (current_user_can('manage_options')) : ?>
<script>
// Admin CRUD functionality
document.getElementById('add-pricing-group')?.addEventListener('click', function() {
    const title = prompt('Nhập tên nhóm báo giá:');
    if (title) {
        // Add pricing group via AJAX
        const formData = new FormData();
        formData.append('action', 'vmst_pricing_crud');
        formData.append('nonce', vmstAjax.nonce);
        formData.append('pricing_action', 'add');
        formData.append('title', title);
        formData.append('images', JSON.stringify([]));
        
        fetch(vmstAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
});

document.querySelectorAll('.delete-group').forEach(btn => {
    btn.addEventListener('click', function() {
        if (confirm('Bạn có chắc muốn xóa nhóm này?')) {
            const groupId = this.closest('.pricing-group').dataset.id;
            const formData = new FormData();
            formData.append('action', 'vmst_pricing_crud');
            formData.append('nonce', vmstAjax.nonce);
            formData.append('pricing_action', 'delete');
            formData.append('id', groupId);
            
            fetch(vmstAjax.ajaxurl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }
    });
});
</script>
<?php endif; ?>

<?php
get_footer();

