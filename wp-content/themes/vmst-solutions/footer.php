    </main><!-- #main-content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-container">
            <div class="footer-links">
                <div class="footer-column footer-company-info">
                    <div class="footer-logo">
                        <?php
                        $logo_url = home_url('/wp-content/uploads/2025/12/logo-namin-1.webp');
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-link">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="footer-logo-img">
                        </a>
                    </div>
                    <div class="footer-contact-info">
                        <p class="footer-address">Địa chỉ: 06-08 Bạch Đông Ôn, Phường An Khánh, Tp. Thủ Đức, Thành Phố Hồ Chí Minh</p>
                        <p class="footer-phone">Số điện thoại: (028) 2.228.5678</p>
                        <p class="footer-email">Email: info@namin.com.vn</p>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-column-title">Hỗ Trợ</h3>
                    <ul class="footer-menu-list">
                        <li><a href="<?php echo esc_url(home_url('/help-center')); ?>">Trung Tâm Trợ Giúp</a></li>
                        <li><a href="<?php echo esc_url(home_url('/forum')); ?>">Diễn Đàn</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-column-title">Tài Nguyên</h3>
                    <ul class="footer-menu-list">
                        <li><a href="<?php echo esc_url(home_url('/extensions')); ?>">Tiện Ích Mở Rộng</a></li>
                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog Namin</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-column-title">Công Ty</h3>
                    <ul class="footer-menu-list">
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>">Giới Thiệu</a></li>
                        <li><a href="<?php echo esc_url(home_url('/careers')); ?>">Tuyển Dụng</a></li>
                        <li><a href="<?php echo esc_url(home_url('/our-brand')); ?>">Thương Hiệu</a></li>
                        <li><a href="<?php echo esc_url(home_url('/newsroom')); ?>">Tin Tức</a></li>
                        <li><a href="<?php echo esc_url(home_url('/press-media')); ?>">Báo Chí & Truyền Thông</a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact-us')); ?>">Liên Hệ</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-column-title">Follow</h3>
                    <ul class="footer-menu-list">
                        <li><a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a></li>
                        <li><a href="https://youtube.com" target="_blank" rel="noopener">Youtube</a></li>
                        <li><a href="https://linkedin.com" target="_blank" rel="noopener">Linkedin</a></li>
                        <li><a href="https://facebook.com" target="_blank" rel="noopener">Facebook</a></li>
                        <li><a href="https://x.com" target="_blank" rel="noopener">X</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-left">
                    <div class="footer-selector">
                        <span class="selector-icon">🌐</span>
                        <span class="selector-text">English</span>
                        <span class="selector-arrow">▼</span>
                    </div>
                    <div class="footer-selector">
                        <span class="selector-icon">₫</span>
                        <span class="selector-text">VND</span>
                        <span class="selector-arrow">▼</span>
                    </div>
                </div>
                
                <div class="footer-bottom-right">
                    <div class="footer-legal-links">
                        <a href="<?php echo esc_url(home_url('/terms')); ?>">Terms</a>
                        <a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy</a>
                        <a href="<?php echo esc_url(home_url('/security-measures')); ?>">Security Measures</a>
                        <a href="<?php echo esc_url(home_url('/sitemap')); ?>">Sitemap</a>
                    </div>
                    <div class="footer-copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, Inc.</p>
                        <p class="time-license">From TIME. &copy; <?php echo date('Y'); ?> TIME USA LLC. All rights reserved. Used under license.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>

