<?php
/**
 * The front page template
 * Mimics Squarespace homepage design
 *
 * @package VMST_Solutions
 */

get_header();
?>

<div class="hero-section">
    <div class="hero-background">
        <div class="hero-video-wrapper">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="https://media-www.sqspcdn.com/videos/pages/homepage-2025/hero/plants-mobile.webm" type="video/webm">
            </video>
            <div class="hero-overlay"></div>
        </div>
    </div>
    
    <div class="hero-content-wrapper">
        <div class="hero-cards">
            <div class="hero-card hero-card-1">
                <div class="card-content">
                    <div class="card-header">
                        <span class="card-logo">NAMIN</span>
                        <button class="card-menu-btn">SẢN PHẨM</button>
                    </div>
                </div>
            </div>
            
            <div class="hero-card hero-card-2 active">
                <div class="card-content">
                    <div class="card-header">
                        <span class="card-logo">NAMIN</span>
                        <nav class="card-nav">
                            <a href="#">SẢN PHẨM</a>
                            <a href="#">BỘ SƯU TẬP</a>
                            <a href="#">CỬA HÀNG</a>
                            <a href="#">GIỚI THIỆU</a>
                            <a href="#">GIỎ HÀNG (0)</a>
                        </nav>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title">THIẾT BỊ PHÒNG TẮM<br>CAO CẤP NHẬP KHẨU.</h2>
                        <button class="card-cta">XEM SẢN PHẨM</button>
                    </div>
                    <div class="card-badges">
                        <span class="badge badge-1">BỒN CẦU</span>
                        <span class="badge badge-2">VÒI SEN</span>
                        <span class="badge badge-3">& LAVABO</span>
                    </div>
                </div>
            </div>
            
            <div class="hero-card hero-card-3">
                <div class="card-content">
                    <div class="card-header">
                        <span class="card-logo">NAMIN</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hero-text">
            <p class="hero-intro">Thiết bị phòng tắm cao cấp nhập khẩu<br>cho không gian sống sang trọng.</p>
        </div>
    </div>
</div>

<div class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number">50K+</div>
            <div class="stat-label">Khách Hàng Tin Dùng</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">500+</div>
            <div class="stat-label">Sản Phẩm Cao Cấp</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">30+</div>
            <div class="stat-label">Thương Hiệu Quốc Tế</div>
        </div>
    </div>
</div>

<section class="grow-business-section">
    <div class="content-area">
        <h2 class="section-title">Sản phẩm đa dạng cho mọi nhu cầu</h2>
        <p class="section-subtitle">Thiết bị phòng tắm và nhà vệ sinh cao cấp nhập khẩu từ các thương hiệu hàng đầu thế giới.</p>
        
        <div class="feature-tabs">
            <button class="tab-btn active" data-tab="services">Bồn Cầu</button>
            <button class="tab-btn" data-tab="store">Vòi Sen</button>
            <button class="tab-btn" data-tab="invoicing">Lavabo</button>
            <button class="tab-btn" data-tab="scheduling">Phụ Kiện</button>
            <button class="tab-btn" data-tab="donations">Gương</button>
            <button class="tab-btn" data-tab="memberships">Bồn Tắm</button>
            <button class="tab-btn" data-tab="blog">Thiết Bị Thông Minh</button>
            <button class="tab-btn" data-tab="portfolio">Bộ Sưu Tập</button>
        </div>
        
        <div class="feature-cards-container">
            <!-- Services Card -->
            <div class="feature-card active" data-feature="services">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Bồn cầu thông minh cao cấp</h3>
                    <p class="feature-card-desc">Bồn cầu nhật khẩu với công nghệ hiện đại, thiết kế sang trọng và tính năng thông minh cho không gian phòng tắm đẳng cấp.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Bồn Cầu Thông Minh</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Online Store Card -->
            <div class="feature-card" data-feature="store">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Vòi sen cao cấp nhập khẩu</h3>
                    <p class="feature-card-desc">Vòi sen thiết kế hiện đại với nhiều chế độ xịt, công nghệ tiết kiệm nước và độ bền cao từ các thương hiệu hàng đầu.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Vòi Sen Nhập Khẩu</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Invoicing Card -->
            <div class="feature-card" data-feature="invoicing">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Lavabo đá tự nhiên cao cấp</h3>
                    <p class="feature-card-desc">Lavabo được chế tác từ đá tự nhiên và composite cao cấp, thiết kế tinh tế phù hợp với mọi không gian phòng tắm hiện đại.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Lavabo Đá Tự Nhiên</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Scheduling Card -->
            <div class="feature-card" data-feature="scheduling">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Phụ kiện phòng tắm sang trọng</h3>
                    <p class="feature-card-desc">Bộ phụ kiện phòng tắm đầy đủ từ giá treo khăn, kệ đựng đồ đến vòi nước, tất cả đều được thiết kế đồng bộ và tinh tế.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Phụ Kiện Cao Cấp</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Donations Card -->
            <div class="feature-card" data-feature="donations">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Gương phòng tắm thông minh</h3>
                    <p class="feature-card-desc">Gương phòng tắm tích hợp đèn LED, chống mờ hơi nước và thiết kế hiện đại, tạo điểm nhấn cho không gian phòng tắm.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Gương Thông Minh</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Memberships Card -->
            <div class="feature-card" data-feature="memberships">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Bồn tắm sang trọng nhập khẩu</h3>
                    <p class="feature-card-desc">Bồn tắm cao cấp với nhiều kiểu dáng từ truyền thống đến hiện đại, chất liệu cao cấp và thiết kế tinh tế cho không gian thư giãn hoàn hảo.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Bồn Tắm Nhập Khẩu</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Blog Card -->
            <div class="feature-card" data-feature="blog">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Thiết bị phòng tắm thông minh</h3>
                    <p class="feature-card-desc">Hệ thống thiết bị thông minh với điều khiển tự động, cảm biến thông minh và tích hợp công nghệ IoT cho trải nghiệm hiện đại.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Thiết Bị Thông Minh</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Portfolio Card -->
            <div class="feature-card" data-feature="portfolio">
                <div class="feature-card-header">
                    <h3 class="feature-card-title">Bộ sưu tập thiết bị cao cấp</h3>
                    <p class="feature-card-desc">Bộ sưu tập đầy đủ các thiết bị phòng tắm được thiết kế đồng bộ, từ bồn cầu, lavabo đến phụ kiện, tạo nên không gian hoàn hảo.</p>
                </div>
                <div class="feature-card-preview">
                    <div class="preview-carousel">
                        <div class="preview-item preview-item-left" data-index="0">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800&h=600&fit=crop" alt="Bathroom 1" class="preview-image">
                        </div>
                        <div class="preview-item preview-item-center active" data-index="1">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800&h=600&fit=crop" alt="Bathroom 2" class="preview-image">
                            <div class="preview-overlay">
                                <div class="preview-badge">Bộ Sưu Tập</div>
                            </div>
                        </div>
                        <div class="preview-item preview-item-right" data-index="2">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=800&h=600&fit=crop" alt="Bathroom 3" class="preview-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="platform-section">
    <div class="content-area">
        <div class="platform-header">
            <h2 class="platform-title">Tất cả thiết bị bạn cần trong một bộ sưu tập</h2>
            <p class="platform-subtitle">Thiết bị phòng tắm và nhà vệ sinh cao cấp nhập khẩu từ các thương hiệu hàng đầu, được tích hợp hoàn hảo cho không gian sống của bạn.</p>
        </div>
        
        <div class="platform-cards-wrapper">
            <div class="platform-cards" id="platform-cards-carousel">
                <div class="platform-card" data-bg="gradient-1">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Bồn Cầu Thông Minh</h3>
                        <p class="platform-card-desc">Bồn cầu nhật khẩu với công nghệ tự động, vệ sinh bằng nước ấm và sấy khô.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=600&h=400&fit=crop" alt="Beautiful bathroom" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="gradient-2">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Vòi Sen Thông Minh</h3>
                        <p class="platform-card-desc">Vòi sen cao cấp với nhiều chế độ xịt, điều chỉnh nhiệt độ và áp lực nước thông minh.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=600&h=400&fit=crop" alt="Modern bathroom interior" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="gradient-3">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Lavabo Đá Tự Nhiên</h3>
                        <p class="platform-card-desc">Lavabo được chế tác từ đá tự nhiên cao cấp, thiết kế tinh tế và độ bền vượt trội.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600&h=400&fit=crop" alt="Luxury bathroom" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="gradient-4">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Phụ Kiện Đồng Bộ</h3>
                        <p class="platform-card-desc">Bộ phụ kiện phòng tắm được thiết kế đồng bộ, từ giá treo khăn, kệ đựng đồ đến vòi nước.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600&h=400&fit=crop" alt="Elegant bathroom design" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="solid-1">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Gương Phòng Tắm</h3>
                        <p class="platform-card-desc">Gương phòng tắm tích hợp đèn LED, chống mờ hơi nước và thiết kế hiện đại.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=600&h=400&fit=crop" alt="Bathroom mirror" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="solid-2">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Bồn Tắm Cao Cấp</h3>
                        <p class="platform-card-desc">Bồn tắm cao cấp với nhiều kiểu dáng từ truyền thống đến hiện đại, chất liệu cao cấp.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=600&h=400&fit=crop" alt="Luxury bathtub" class="platform-preview-img" onerror="this.src='https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=600&h=400&fit=crop'">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="solid-3">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Thiết Bị Thông Minh</h3>
                        <p class="platform-card-desc">Hệ thống thiết bị thông minh với điều khiển tự động, cảm biến và tích hợp IoT.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?w=600&h=400&fit=crop" alt="Smart bathroom" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
                
                <div class="platform-card" data-bg="solid-4">
                    <div class="platform-card-content">
                        <h3 class="platform-card-title">Bộ Sưu Tập</h3>
                        <p class="platform-card-desc">Bộ sưu tập đầy đủ các thiết bị phòng tắm được thiết kế đồng bộ và tinh tế.</p>
                        <div class="platform-card-preview">
                            <img src="https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=600&h=400&fit=crop" alt="Bathroom collection" class="platform-preview-img">
                            <div class="platform-card-arrow">→</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="platform-carousel-btn platform-carousel-prev" aria-label="Previous">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="platform-carousel-btn platform-carousel-next" aria-label="Next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        
        <div class="platform-dots">
            <span class="dot active" data-slide="0"></span>
            <span class="dot" data-slide="1"></span>
            <span class="dot" data-slide="2"></span>
            <span class="dot" data-slide="3"></span>
            <span class="dot" data-slide="4"></span>
            <span class="dot" data-slide="5"></span>
            <span class="dot" data-slide="6"></span>
            <span class="dot" data-slide="7"></span>
        </div>
        
        <div class="time-badge">
            <span class="badge-ribbon">Namin</span>
        </div>
    </div>
</section>

<section class="ai-starter-section">
    <div class="content-area">
        <div class="ai-starter-header">
            <div class="ai-logo">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
            <h2 class="ai-starter-title">Bắt đầu với thiết bị phòng tắm cao cấp chưa bao giờ dễ dàng hơn</h2>
            <p class="ai-starter-subtitle">Không cần kinh nghiệm, chỉ cần lựa chọn.</p>
        </div>
        
        <div class="ai-panels">
            <!-- Blueprint AI Builder Panel -->
            <div class="ai-panel ai-panel-left">
                <div class="time-badge-panel">
                    <span class="badge-ribbon">Namin</span>
                </div>
                <div class="ai-panel-content">
                    <div class="ai-input-wrapper">
                        <div class="ai-input-icon">⋯</div>
                        <input type="text" class="ai-input" placeholder="Bạn đang tìm kiếm gì?" id="site-name-input">
                    </div>
                    <h3 class="ai-panel-title">Tư Vấn Thiết Kế Chuyên Nghiệp</h3>
                    <p class="ai-panel-desc">Trả lời một vài câu hỏi và để đội ngũ chuyên gia của chúng tôi tư vấn giải pháp phù hợp nhất cho bạn.</p>
                    <a href="<?php echo esc_url(home_url('/get-started')); ?>" class="ai-panel-btn">
                        Nhận Tư Vấn Miễn Phí →
                    </a>
                </div>
            </div>
            
            <!-- Professional Templates Panel -->
            <div class="ai-panel ai-panel-right">
                <div class="templates-grid">
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=300&h=300&fit=crop" alt="Bathroom template 4">
                        <div class="template-overlay">ELEVATED</div>
                    </div>
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=300&h=300&fit=crop" alt="Bathroom template 5">
                        <div class="template-overlay">SPATIAL</div>
                    </div>
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=300&h=300&fit=crop" alt="Bathroom template 6">
                        <div class="template-overlay">DESIGN</div>
                    </div>
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?w=300&h=300&fit=crop" alt="Bathroom template 7">
                        <div class="template-overlay">BEAUTY</div>
                    </div>
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=300&h=300&fit=crop" alt="Bathroom template 8">
                        <div class="template-overlay">FORMS</div>
                    </div>
                    <div class="template-item">
                        <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=300&h=300&fit=crop" alt="Bathroom template 9">
                        <div class="template-overlay">healer</div>
                    </div>
                </div>
                <div class="ai-panel-content">
                    <h3 class="ai-panel-title">Bộ Sưu Tập Chuyên Nghiệp</h3>
                    <p class="ai-panel-desc">Được thiết kế bởi các chuyên gia, tùy chỉnh theo nhu cầu—dành riêng cho không gian của bạn.</p>
                    <a href="<?php echo esc_url(home_url('/templates')); ?>" class="ai-panel-btn">
                        Xem Bộ Sưu Tập →
                    </a>
                </div>
            </div>
        </div>
        
        <div class="time-badge-bottom">
            <span class="badge-ribbon">Namin</span>
        </div>
    </div>
</section>

<section class="domain-search-section">
    <div class="content-area">
        <h2 class="domain-title">Tìm kiếm thiết bị phòng tắm phù hợp với bạn</h2>
        
        <div class="domain-search-wrapper">
            <form class="domain-search-form" action="<?php echo esc_url(home_url('/search')); ?>" method="get">
                <div class="domain-search-bar">
                    <svg class="search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19 19L14.65 14.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <input type="text" class="domain-search-input" name="q" placeholder="Bắt đầu tìm kiếm sản phẩm của bạn" autocomplete="off">
                    <button type="submit" class="domain-search-submit" aria-label="Search domain">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </form>
            
            <p class="domain-transfer-text">
                Cần tư vấn? <a href="<?php echo esc_url(home_url('/transfer')); ?>" class="domain-transfer-link">Liên hệ với chúng tôi</a>
            </p>
        </div>
        
        <div class="domain-avatars">
            <div class="avatar-item">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=faces" alt="Customer avatar 1" class="avatar-img">
            </div>
            <div class="avatar-item">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&crop=faces" alt="Customer avatar 2" class="avatar-img">
            </div>
            <div class="avatar-item">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=faces" alt="Customer avatar 3" class="avatar-img">
            </div>
            <div class="avatar-item">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=faces" alt="Customer avatar 4" class="avatar-img">
            </div>
            <div class="avatar-item">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=faces" alt="Customer avatar 5" class="avatar-img">
            </div>
        </div>
    </div>
</section>

<section class="made-with-section">
    <div class="made-with-container">
        <h2 class="made-with-title">Thiết Bị Phòng Tắm Cao Cấp</h2>
        
        <div class="website-showcase" id="sphere-showcase">
            <div class="showcase-item" data-index="0">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=400&h=500&fit=crop" alt="Website showcase 1" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">NAMIN COLLECTION</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="1">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400&h=500&fit=crop" alt="Website showcase 2" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">POTTED</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="2">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=400&h=500&fit=crop" alt="Website showcase 3" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">SecondStory</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="3">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&h=500&fit=crop" alt="Website showcase 4" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">FLANEUR</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="4">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=400&h=500&fit=crop" alt="Website showcase 5" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">NAUGHTY NANCY</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="5">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400&h=500&fit=crop" alt="Website showcase 6" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">FAT CHOY</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="6">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1631889993954-7b945d5693e5?w=400&h=500&fit=crop" alt="Website showcase 7" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">AHA AMN</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="7">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=400&h=500&fit=crop" alt="Website showcase 8" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">Green Mug</span>
                    </div>
                </div>
            </div>
            
            <div class="showcase-item" data-index="8">
                <div class="showcase-card">
                    <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?w=400&h=500&fit=crop" alt="Website showcase 9" class="showcase-img">
                    <div class="showcase-overlay">
                        <span class="showcase-label">Studio</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="time-badge-showcase">
            <span class="badge-ribbon">Namin</span>
        </div>
    </div>
</section>

<section class="faq-section">
    <div class="content-area">
        <div class="faq-header">
            <h2 class="faq-title">Câu hỏi thường gặp</h2>
        </div>
        
        <div class="faq-container">
            <div class="faq-item">
                <button class="faq-question" aria-expanded="true">
                    <span class="faq-question-text">Namin cung cấp những sản phẩm trang thiết bị nhà tắm, nhà vệ sinh nào?</span>
                    <span class="faq-icon">−</span>
                </button>
                <div class="faq-answer active">
                    <p>Namin chuyên cung cấp trang thiết bị nhà tắm, nhà vệ sinh cao cấp nhập khẩu bao gồm: bồn cầu thông minh, vòi sen cao cấp, lavabo đá tự nhiên, bồn tắm sang trọng, gương phòng tắm thông minh, phụ kiện đồng bộ và các thiết bị thông minh tích hợp công nghệ hiện đại.</p>
                    <p>Tất cả sản phẩm của Namin đều được nhập khẩu trực tiếp từ các thương hiệu hàng đầu thế giới, đảm bảo chất lượng cao cấp và tiêu chuẩn quốc tế cho không gian phòng tắm và nhà vệ sinh của bạn.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Tại sao nên chọn trang thiết bị nhà tắm, nhà vệ sinh của Namin?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Namin tự hào là đơn vị chuyên cung cấp trang thiết bị nhà tắm, nhà vệ sinh cao cấp với nhiều ưu điểm vượt trội: chất lượng nhập khẩu chính hãng, thiết kế sang trọng hiện đại, công nghệ tiên tiến, độ bền cao và dịch vụ tư vấn chuyên nghiệp. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm tốt nhất với giá cả hợp lý nhất.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Bồn cầu thông minh của Namin có những tính năng gì?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Bồn cầu thông minh Namin được trang bị nhiều tính năng hiện đại: vệ sinh tự động bằng nước ấm, sấy khô, điều chỉnh nhiệt độ và áp lực nước, cảm biến tự động, chống mùi, tiết kiệm nước và thiết kế sang trọng. Tất cả được điều khiển thông qua bảng điều khiển hoặc ứng dụng điện thoại thông minh.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Làm thế nào để chọn vòi sen phù hợp với không gian nhà tắm?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Đội ngũ tư vấn chuyên nghiệp của Namin sẽ giúp bạn chọn vòi sen phù hợp dựa trên: kích thước không gian nhà tắm, phong cách thiết kế, nhu cầu sử dụng và ngân sách. Chúng tôi cung cấp đa dạng các loại vòi sen từ truyền thống đến hiện đại với nhiều chế độ xịt khác nhau như massage, mưa, tiết kiệm nước.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Lavabo đá tự nhiên của Namin có ưu điểm gì so với lavabo thông thường?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Lavabo đá tự nhiên Namin có nhiều ưu điểm vượt trội: độ bền cao, chống thấm nước tốt, dễ vệ sinh, thiết kế tinh tế sang trọng, màu sắc tự nhiên độc đáo và giá trị thẩm mỹ cao. Đá tự nhiên được chọn lọc kỹ càng và chế tác bởi các nghệ nhân lành nghề, đảm bảo chất lượng và độ hoàn thiện cao nhất.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Namin có dịch vụ lắp đặt trang thiết bị nhà tắm, nhà vệ sinh không?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Có, Namin cung cấp dịch vụ lắp đặt chuyên nghiệp với đội ngũ kỹ thuật viên giàu kinh nghiệm. Chúng tôi hỗ trợ từ khâu tư vấn thiết kế, đo đạc, lắp đặt đến bảo hành và bảo trì. Dịch vụ lắp đặt của Namin đảm bảo an toàn, chính xác và hoàn thiện, giúp bạn có không gian phòng tắm, nhà vệ sinh hoàn hảo nhất.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Chế độ bảo hành cho trang thiết bị nhà tắm, nhà vệ sinh Namin như thế nào?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Tất cả sản phẩm trang thiết bị nhà tắm, nhà vệ sinh của Namin đều có chế độ bảo hành chính hãng từ nhà sản xuất. Thời gian bảo hành từ 2-5 năm tùy theo từng sản phẩm. Namin cũng cung cấp dịch vụ bảo trì định kỳ và sửa chữa chuyên nghiệp, đảm bảo thiết bị luôn hoạt động tốt nhất trong suốt thời gian sử dụng.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Làm thế nào để đặt hàng trang thiết bị nhà tắm, nhà vệ sinh từ Namin?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Bạn có thể đặt hàng trang thiết bị nhà tắm, nhà vệ sinh Namin qua nhiều cách: đặt hàng trực tuyến trên website, gọi điện hotline, đến showroom hoặc liên hệ qua email. Chúng tôi cung cấp dịch vụ giao hàng tận nơi trên toàn quốc và hỗ trợ lắp đặt tại nhà. Đội ngũ tư vấn của Namin luôn sẵn sàng hỗ trợ bạn chọn sản phẩm phù hợp nhất.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Namin có cung cấp bộ sưu tập thiết bị đồng bộ cho phòng tắm không?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Có, Namin cung cấp các bộ sưu tập thiết bị đồng bộ cho phòng tắm và nhà vệ sinh, bao gồm bồn cầu, lavabo, vòi sen, phụ kiện được thiết kế đồng bộ về màu sắc, phong cách và chất liệu. Bộ sưu tập đồng bộ giúp tạo nên không gian hài hòa, sang trọng và chuyên nghiệp. Chúng tôi cũng hỗ trợ tư vấn thiết kế để tạo bộ sưu tập riêng theo yêu cầu của bạn.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question" aria-expanded="false">
                    <span class="faq-question-text">Thiết bị nhà tắm, nhà vệ sinh Namin có tiết kiệm nước không?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Có, các sản phẩm trang thiết bị nhà tắm, nhà vệ sinh của Namin đều được thiết kế với công nghệ tiết kiệm nước tiên tiến. Bồn cầu thông minh có chế độ tiết kiệm nước, vòi sen có van điều tiết lưu lượng, và tất cả thiết bị đều tuân thủ các tiêu chuẩn tiết kiệm nước quốc tế. Sử dụng sản phẩm Namin không chỉ mang lại trải nghiệm cao cấp mà còn góp phần bảo vệ môi trường.</p>
                </div>
            </div>
        </div>
        
        <div class="time-badge-faq">
            <span class="badge-ribbon">Namin</span>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="cta-background">
        <div class="globe-container">
            <div class="globe-sphere" id="rotating-globe">
                <!-- Dots will be generated by JavaScript -->
            </div>
        </div>
    </div>
    
    <div class="content-area">
        <h2 class="cta-title">Bắt đầu với thiết bị phòng tắm cao cấp ngay hôm nay</h2>
        <p class="cta-subtitle">Tư vấn miễn phí. Hỗ trợ 24/7.</p>
        <div class="cta-actions">
            <a href="<?php echo esc_url(home_url('/get-started')); ?>" class="cta-button">NHẬN TƯ VẤN MIỄN PHÍ</a>
        </div>
    </div>
    
    <div class="time-badge-cta">
        <span class="badge-ribbon">Namin</span>
    </div>
</section>

<?php
get_footer();

