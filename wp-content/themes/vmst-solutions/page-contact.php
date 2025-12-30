<?php
/**
 * Template Name: Trang Liên hệ
 * 
 * @package VMST_Solutions
 */

get_header();
?>

<div class="contact-section">
    <div class="content-area">
        <div class="contact-header">
            <h1 class="section-title">Liên hệ với chúng tôi</h1>
            <p class="section-subtitle">Hãy để lại thông tin, chúng tôi sẽ liên hệ với bạn sớm nhất</p>
        </div>
        
        <div class="contact-wrapper">
            <div class="contact-info">
                <div class="contact-info-item">
                    <h3>Thông tin liên hệ</h3>
                    <p><strong>Điện thoại:</strong> <?php echo get_theme_mod('vmst_contact_phone', '0832 57 59 05'); ?></p>
                    <p><strong>Email:</strong> info@namin.com</p>
                    <p><strong>Địa chỉ:</strong> Việt Nam</p>
                </div>
                
                <div class="contact-info-item">
                    <h3>Giờ làm việc</h3>
                    <p>Thứ 2 - Thứ 6: 8:00 - 17:00</p>
                    <p>Thứ 7: 8:00 - 12:00</p>
                    <p>Chủ nhật: Nghỉ</p>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <form id="contact-form" class="contact-form">
                    <div class="form-group">
                        <label for="contact-name">Họ và tên *</label>
                        <input type="text" id="contact-name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-email">Email *</label>
                        <input type="email" id="contact-email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-phone">Số điện thoại *</label>
                        <input type="tel" id="contact-phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message">Tin nhắn *</label>
                        <textarea id="contact-message" name="message" rows="6" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                    
                    <div class="form-message"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    formData.append('action', 'vmst_contact_form');
    formData.append('nonce', vmstAjax.nonce);
    
    fetch(vmstAjax.ajaxurl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = form.querySelector('.form-message');
        if (data.success) {
            messageDiv.innerHTML = '<p class="success">' + data.data.message + '</p>';
            form.reset();
        } else {
            messageDiv.innerHTML = '<p class="error">Có lỗi xảy ra. Vui lòng thử lại.</p>';
        }
    });
});
</script>

<?php
get_footer();

