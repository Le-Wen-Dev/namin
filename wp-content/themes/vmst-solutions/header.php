<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Serif:wght@300;400;500;600;700&family=Noto+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to main content', 'vmst-solutions'); ?></a>
    
    <header id="masthead" class="site-header" role="banner">
        <div class="header-container">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    // Use the logo from uploads
                    $logo_url = home_url('/wp-content/uploads/2025/12/logo-namin-1.webp');
                    ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="site-logo-img">
                    </a>
                    <?php
                }
                ?>
            </div>
            
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'vmst-solutions'); ?>">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <ul class="nav-menu">
                    <li class="menu-item-has-children">
                        <button class="nav-menu-link" data-menu="products">
                            Sản phẩm <span class="menu-caret">▼</span>
                        </button>
                        <div class="mega-menu" data-menu-content="products">
                            <div class="mega-menu-container">
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">WEBSITE</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/websites')); ?>">Websites</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/website-templates')); ?>">Website Templates</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/ai-website-builder')); ?>">AI Website Builder</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/design-intelligence')); ?>">Design Intelligence</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/portfolios')); ?>">Portfolios</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/blogs')); ?>">Blogs</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/analytics')); ?>">Analytics</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/enterprise')); ?>">Enterprise</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/features')); ?>" class="mega-menu-view-all">View All Features</a></li>
                                    </ul>
                                </div>
                                
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">COMMERCE</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/ecommerce')); ?>">Ecommerce</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/ecommerce-templates')); ?>">Ecommerce Templates</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/online-stores')); ?>">Online Stores</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/services')); ?>">Services</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/invoicing')); ?>">Invoicing</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/scheduling')); ?>">Scheduling</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/content-memberships')); ?>">Content & Memberships</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/donations')); ?>">Donations</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/financial-solutions')); ?>">Financial Solutions</a></li>
                                    </ul>
                                </div>
                                
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">MARKETING</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/marketing-tools')); ?>">Marketing Tools</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/email-campaigns')); ?>">Email Campaigns</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/seo-tools')); ?>">SEO Tools</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/free-tools')); ?>">Free Tools</a></li>
                                    </ul>
                                    
                                    <h3 class="mega-menu-title">BUSINESS TOOLS</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/domain-search')); ?>">Domain Search</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/domain-transfer')); ?>">Domain Transfer</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/business-email')); ?>">Business Email</a></li>
                                    </ul>
                                </div>
                                
                                <div class="mega-menu-column mega-menu-featured">
                                    <h3 class="mega-menu-title">FOR PROFESSIONALS</h3>
                                    <div class="mega-menu-card">
                                        <h4 class="mega-menu-card-title">Namin for Pros</h4>
                                        <p class="mega-menu-card-desc">Powerful enough for pros, easy enough for clients</p>
                                    </div>
                                    <div class="mega-menu-card">
                                        <h4 class="mega-menu-card-title">Circle</h4>
                                        <p class="mega-menu-card-desc">The partner program for freelancers and agencies</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="menu-item-has-children">
                        <button class="nav-menu-link" data-menu="solutions">
                            Giải pháp <span class="menu-caret">▼</span>
                        </button>
                        <div class="mega-menu" data-menu-content="solutions">
                            <div class="mega-menu-container">
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">Thông tin</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/tin-tuc')); ?>">Tin tức</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/tuyen-dung')); ?>">Tuyển dụng</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/bao-gia')); ?>">Báo giá</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/faq')); ?>">Câu hỏi thường gặp</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/lien-he')); ?>">Liên hệ</a></li>
                                    </ul>
                                </div>
                                
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">Sản phẩm</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/namin-collection')); ?>">Bộ sưu tập Namin</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/san-pham/bon-cau')); ?>">Bồn cầu</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/san-pham/voi-sen')); ?>">Vòi sen</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/san-pham/lavabo')); ?>">Lavabo</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/san-pham/phu-kien')); ?>">Phụ kiện</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="menu-item-has-children">
                        <button class="nav-menu-link" data-menu="resources">
                            Resources <span class="menu-caret">▼</span>
                        </button>
                        <div class="mega-menu" data-menu-content="resources">
                            <div class="mega-menu-container">
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">24/7 support</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/help-center')); ?>">Help Center</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/forum')); ?>">Forum</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/webinars')); ?>">Webinars</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/hire-an-expert')); ?>">Hire an Expert</a></li>
                                    </ul>
                                    
                                    <h3 class="mega-menu-title">Get inspired</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/made-with-namin')); ?>">Made with Namin</a></li>
                                    </ul>
                                </div>
                                
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-title">Resources</h3>
                                    <ul class="mega-menu-list">
                                        <li><a href="<?php echo esc_url(home_url('/extensions')); ?>">Extensions</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Namin Blog</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/free-tools')); ?>">Free Tools</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/business-name-generator')); ?>">Business Name Generator</a></li>
                                        <li><a href="<?php echo esc_url(home_url('/logo-maker')); ?>">Logo Maker</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <!-- Cart Icon with Mini Cart -->
                <div class="cart-wrapper">
                    <a href="<?php echo esc_url(home_url('/cart')); ?>" class="cart-icon-link" id="cart-icon-link">
                        <span class="cart-icon-wrapper">
                            <svg class="cart-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4m7 14h2a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-5 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2M9 7h6"/>
                            </svg>
                            <span class="cart-count" id="header-cart-count">0</span>
                        </span>
                    </a>
                    <div class="mini-cart" id="mini-cart">
                        <div class="mini-cart-header">
                            <h3>Giỏ hàng</h3>
                            <button class="mini-cart-close" id="mini-cart-close">×</button>
                        </div>
                        <div class="mini-cart-body" id="mini-cart-body">
                            <div class="mini-cart-empty">
                                <p>Giỏ hàng trống</p>
                                <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn-shop">Mua sắm ngay</a>
                            </div>
                        </div>
                        <div class="mini-cart-footer" id="mini-cart-footer" style="display:none;">
                            <div class="mini-cart-total">
                                <span>Tổng cộng:</span>
                                <span class="mini-cart-total-price" id="mini-cart-total">0 đ</span>
                            </div>
                            <a href="<?php echo esc_url(home_url('/cart')); ?>" class="btn-view-cart">Xem giỏ hàng</a>
                            <a href="<?php echo esc_url(home_url('/checkout')); ?>" class="btn-checkout">Thanh toán</a>
                        </div>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/get-started')); ?>" class="btn btn-primary">Nhận tư vấn</a>
                <a href="<?php echo esc_url(home_url('/login')); ?>" class="btn btn-secondary">Đăng nhập</a>
            </div>
        </div>
    </header>
    
    <div class="promo-banner">
        <div class="promo-banner-content">
            <p class="promo-banner-text">Take 20% off any new website plan</p>
            <p class="promo-banner-subtext">For a limited time, take 20% off any new website plan. Use code at checkout:</p>
            <button class="promo-banner-close" aria-label="Close banner">×</button>
        </div>
    </div>
    
    <!-- Simple Banner -->
    <div class="simple-banner">
        <img src="<?php echo esc_url(home_url('/wp-content/uploads/2025/12/collection2-2023.38b43e3.webp')); ?>" alt="Namin Banner" class="simple-banner-img">
    </div>

    <main id="main-content" class="site-main">

