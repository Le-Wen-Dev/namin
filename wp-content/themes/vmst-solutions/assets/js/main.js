/**
 * VMST Solutions - Main JavaScript
 * Cloned from Squarespace design
 * Contact: 0832 57 59 05
 */

(function() {
    'use strict';

    // Promo Banner Close
    const promoBannerClose = document.querySelector('.promo-banner-close');
    const promoBanner = document.querySelector('.promo-banner');
    
    if (promoBannerClose && promoBanner) {
        promoBannerClose.addEventListener('click', function() {
            promoBanner.style.display = 'none';
            // Update scroll padding
            document.documentElement.style.scrollPaddingTop = 'var(--global-nav-height)';
        });
    }

    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            const isExpanded = navMenu.classList.contains('active');
            menuToggle.setAttribute('aria-expanded', isExpanded);
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Mega Menu Dropdown
    const menuItems = document.querySelectorAll('.menu-item-has-children');
    const megaMenus = document.querySelectorAll('.mega-menu');
    
    menuItems.forEach(item => {
        const menuLink = item.querySelector('.nav-menu-link');
        const megaMenu = item.querySelector('.mega-menu');
        
        if (menuLink && megaMenu) {
            // Hover to open
            item.addEventListener('mouseenter', function() {
                // Close all other menus
                menuItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                // Open current menu
                item.classList.add('active');
            });
            
            // Keep open when hovering over menu
            megaMenu.addEventListener('mouseenter', function() {
                item.classList.add('active');
            });
            
            // Close when leaving
            item.addEventListener('mouseleave', function() {
                item.classList.remove('active');
            });
        }
    });
    
    // Close mega menus when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.menu-item-has-children')) {
            menuItems.forEach(item => {
                item.classList.remove('active');
            });
        }
    });

    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Header Scroll Effect
    let lastScroll = 0;
    const header = document.querySelector('.site-header');
    
    if (header) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 100) {
                header.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
            
            lastScroll = currentScroll;
        });
    }

    // Intersection Observer for Fade-in Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements with fade-in class
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Lazy Loading Images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Form Validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Feature Tabs Functionality
    const tabButtons = document.querySelectorAll('.tab-btn');
    const featureCards = document.querySelectorAll('.feature-card');
    
    if (tabButtons.length > 0 && featureCards.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                
                // Remove active class from all buttons and cards
                tabButtons.forEach(btn => btn.classList.remove('active'));
                featureCards.forEach(card => card.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Show corresponding card
                const targetCard = document.querySelector(`.feature-card[data-feature="${targetTab}"]`);
                if (targetCard) {
                    targetCard.classList.add('active');
                    // Reset carousel to center when switching tabs
                    resetCarousel(targetCard);
                }
            });
        });
    }
    
    // Preview Carousel Functionality
    function resetCarousel(card) {
        const carousel = card.querySelector('.preview-carousel');
        if (carousel) {
            const items = carousel.querySelectorAll('.preview-item');
            items.forEach((item, index) => {
                item.classList.remove('preview-item-left', 'preview-item-center', 'preview-item-right', 'active');
                if (index === 0) {
                    item.classList.add('preview-item-left');
                } else if (index === 1) {
                    item.classList.add('preview-item-center', 'active');
                } else if (index === 2) {
                    item.classList.add('preview-item-right');
                }
            });
        }
    }
    
    // Initialize carousels for all feature cards
    featureCards.forEach(card => {
        const carousel = card.querySelector('.preview-carousel');
        if (carousel) {
            const items = Array.from(carousel.querySelectorAll('.preview-item'));
            
            items.forEach((item) => {
                item.addEventListener('click', function() {
                    if (item.classList.contains('preview-item-center')) return;
                    
                    // Get current positions
                    const leftItem = carousel.querySelector('.preview-item-left');
                    const centerItem = carousel.querySelector('.preview-item-center');
                    const rightItem = carousel.querySelector('.preview-item-right');
                    
                    // Determine direction
                    const isLeft = item === leftItem;
                    
                    // Rotate items
                    if (isLeft) {
                        // Move left to right, center to left, right to center
                        leftItem.classList.remove('preview-item-left');
                        leftItem.classList.add('preview-item-right');
                        
                        centerItem.classList.remove('preview-item-center', 'active');
                        centerItem.classList.add('preview-item-left');
                        
                        rightItem.classList.remove('preview-item-right');
                        rightItem.classList.add('preview-item-center', 'active');
                    } else {
                        // Move right to left, center to right, left to center
                        rightItem.classList.remove('preview-item-right');
                        rightItem.classList.add('preview-item-left');
                        
                        centerItem.classList.remove('preview-item-center', 'active');
                        centerItem.classList.add('preview-item-right');
                        
                        leftItem.classList.remove('preview-item-left');
                        leftItem.classList.add('preview-item-center', 'active');
                    }
                });
            });
        }
    });

    // 3D Sphere Rotation Effect
    const sphereShowcase = document.getElementById('sphere-showcase');
    const showcaseItems = document.querySelectorAll('.showcase-item');
    
    if (sphereShowcase && showcaseItems.length > 0) {
        const totalItems = showcaseItems.length;
        const radius = 500; // Sphere radius
        let rotationY = 0;
        let rotationX = 0;
        let autoRotate = true;
        let mouseX = 0;
        let mouseY = 0;
        let targetRotationY = 0;
        let targetRotationX = 0;
        
        // Position items in sphere formation
        showcaseItems.forEach((item, index) => {
            const phi = Math.acos(-1 + (2 * index) / totalItems); // Vertical angle
            const theta = Math.sqrt(totalItems * Math.PI) * phi; // Horizontal angle
            
            const x = radius * Math.cos(theta) * Math.sin(phi);
            const y = radius * Math.sin(theta) * Math.sin(phi);
            const z = radius * Math.cos(phi);
            
            item.style.setProperty('--x', x + 'px');
            item.style.setProperty('--y', y + 'px');
            item.style.setProperty('--z', z + 'px');
            item.style.setProperty('--angle-y', theta * (180 / Math.PI) + 'deg');
            item.style.setProperty('--angle-x', (phi * (180 / Math.PI) - 90) + 'deg');
            item.style.setProperty('--radius', radius + 'px');
        });
        
        // Mouse interaction
        sphereShowcase.addEventListener('mousemove', function(e) {
            const rect = sphereShowcase.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            mouseX = (e.clientX - centerX) / (rect.width / 2);
            mouseY = (e.clientY - centerY) / (rect.height / 2);
            
            targetRotationY = mouseX * 30;
            targetRotationX = -mouseY * 30;
            autoRotate = false;
        });
        
        sphereShowcase.addEventListener('mouseleave', function() {
            autoRotate = true;
            targetRotationY = rotationY;
            targetRotationX = rotationX;
        });
        
        // Animation loop
        function animate() {
            if (autoRotate) {
                rotationY += 0.3;
                rotationX += 0.1;
            } else {
                rotationY += (targetRotationY - rotationY) * 0.1;
                rotationX += (targetRotationX - rotationX) * 0.1;
            }
            
            sphereShowcase.style.transform = `translateZ(-${radius}px) rotateY(${rotationY}deg) rotateX(${rotationX}deg)`;
            
            requestAnimationFrame(animate);
        }
        
        animate();
        
        // Individual item hover effect
        showcaseItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                autoRotate = false;
            });
        });
    }

    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            const answer = this.nextElementSibling;
            const icon = this.querySelector('.faq-icon');
            
            // Close all other items
            faqQuestions.forEach(q => {
                if (q !== this) {
                    q.setAttribute('aria-expanded', 'false');
                    q.nextElementSibling.classList.remove('active');
                    q.querySelector('.faq-icon').textContent = '+';
                }
            });
            
            // Toggle current item
            if (isExpanded) {
                this.setAttribute('aria-expanded', 'false');
                answer.classList.remove('active');
                icon.textContent = '+';
            } else {
                this.setAttribute('aria-expanded', 'true');
                answer.classList.add('active');
                icon.textContent = '−';
            }
        });
    });

    // Rotating Globe Effect - Generate dots dynamically
    function initGlobe() {
        const globeSphere = document.getElementById('rotating-globe');
        if (globeSphere) {
            const dotCount = 600; // 4x more dots (150 * 4 = 600)
            const radius = 350;
            
            // Clear existing dots
            globeSphere.innerHTML = '';
            
            // Generate dots in sphere formation using Fibonacci sphere algorithm
            for (let i = 0; i < dotCount; i++) {
                const phi = Math.acos(-1 + (2 * i) / dotCount); // Vertical angle
                const theta = Math.sqrt(dotCount * Math.PI) * phi; // Horizontal angle
                
                const x = radius * Math.cos(theta) * Math.sin(phi);
                const y = radius * Math.sin(theta) * Math.sin(phi);
                const z = radius * Math.cos(phi);
                
                const dot = document.createElement('div');
                dot.className = 'globe-dot';
                dot.style.setProperty('--x', x + 'px');
                dot.style.setProperty('--y', y + 'px');
                dot.style.setProperty('--z', z + 'px');
                dot.style.setProperty('--index', i);
                
                globeSphere.appendChild(dot);
            }
            
            console.log('✅ Globe initialized with', dotCount, 'dots');
        } else {
            console.log('❌ Globe sphere element not found');
        }
    }
    
    // Initialize globe when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGlobe);
    } else {
        initGlobe();
    }

    // ============================================
    // CART FUNCTIONALITY (WooCommerce/Flatsome Style)
    // ============================================
    
    // Cart Management
    const NaminCart = {
        // Get cart from localStorage
        getCart: function() {
            return JSON.parse(localStorage.getItem('namin_cart') || '[]');
        },
        
        // Save cart to localStorage
        saveCart: function(cart) {
            localStorage.setItem('namin_cart', JSON.stringify(cart));
            this.updateCartCount();
            this.updateMiniCart();
        },
        
        // Add item to cart
        addItem: function(productId, quantity, variant, price, title, image) {
            const cart = this.getCart();
            const itemKey = variant ? `${productId}_${variant}` : productId.toString();
            
            const existingItem = cart.find(item => {
                const itemKey2 = item.variant ? `${item.id}_${item.variant}` : item.id.toString();
                return itemKey2 === itemKey;
            });
            
            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                cart.push({
                    id: productId,
                    quantity: quantity,
                    variant: variant || null,
                    price: price || null,
                    title: title || `Sản phẩm #${productId}`,
                    image: image || ''
                });
            }
            
            this.saveCart(cart);
            return cart;
        },
        
        // Remove item from cart
        removeItem: function(index) {
            const cart = this.getCart();
            cart.splice(index, 1);
            this.saveCart(cart);
            return cart;
        },
        
        // Update item quantity
        updateQuantity: function(index, quantity) {
            const cart = this.getCart();
            if (cart[index]) {
                cart[index].quantity = Math.max(1, quantity);
                this.saveCart(cart);
            }
            return cart;
        },
        
        // Get cart count
        getCount: function() {
            const cart = this.getCart();
            return cart.reduce((sum, item) => sum + (item.quantity || 0), 0);
        },
        
        // Get cart total
        getTotal: function() {
            const cart = this.getCart();
            return cart.reduce((sum, item) => {
                const price = item.price || 0;
                return sum + (price * item.quantity);
            }, 0);
        },
        
        // Update cart count in header
        updateCartCount: function() {
            const count = this.getCount();
            const countEl = document.getElementById('header-cart-count');
            if (countEl) {
                countEl.textContent = count;
                countEl.style.display = count > 0 ? 'block' : 'none';
            }
            
            // Also update other cart count elements
            document.querySelectorAll('.cart-count').forEach(el => {
                el.textContent = count;
                el.style.display = count > 0 ? 'block' : 'none';
            });
        },
        
        // Update mini cart
        updateMiniCart: function() {
            const cart = this.getCart();
            const miniCartBody = document.getElementById('mini-cart-body');
            const miniCartFooter = document.getElementById('mini-cart-footer');
            const miniCartTotal = document.getElementById('mini-cart-total');
            
            if (!miniCartBody) return;
            
            if (cart.length === 0) {
                miniCartBody.innerHTML = `
                    <div class="mini-cart-empty">
                        <p>Giỏ hàng trống</p>
                        <a href="${this.getHomeUrl()}/san-pham" class="btn-shop">Mua sắm ngay</a>
                    </div>
                `;
                if (miniCartFooter) miniCartFooter.style.display = 'none';
            } else {
                // Fetch product data from database
                this.fetchProductsForCart(cart).then(products => {
                    let html = '<div class="mini-cart-items">';
                    let total = 0;
                    
                    cart.forEach((item, index) => {
                        const product = products[item.id] || {};
                        const productPrice = item.price || product.price || 0;
                        const productTitle = item.title || product.title || `Sản phẩm #${item.id}`;
                        const productImage = item.image || product.image || 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=80';
                        const itemTotal = productPrice * item.quantity;
                        total += itemTotal;
                        
                        html += `
                            <div class="mini-cart-item" data-index="${index}">
                                <div class="mini-cart-item-image">
                                    <a href="${product.permalink || '#'}">
                                        <img src="${productImage}" alt="${productTitle}">
                                    </a>
                                </div>
                                <div class="mini-cart-item-info">
                                    <h4 class="mini-cart-item-title">
                                        <a href="${product.permalink || '#'}">${productTitle}</a>
                                    </h4>
                                    ${item.variant ? `<p class="mini-cart-item-variant">${item.variant}</p>` : ''}
                                    <div class="mini-cart-item-meta">
                                        <span class="mini-cart-item-qty">Số lượng: ${item.quantity}</span>
                                        <span class="mini-cart-item-price">${this.formatPrice(itemTotal)} đ</span>
                                    </div>
                                </div>
                                <button class="mini-cart-item-remove" onclick="NaminCart.removeItem(${index})">×</button>
                            </div>
                        `;
                    });
                    
                    html += '</div>';
                    miniCartBody.innerHTML = html;
                    
                    if (miniCartFooter) {
                        miniCartFooter.style.display = 'block';
                        if (miniCartTotal) {
                            miniCartTotal.textContent = this.formatPrice(total) + ' đ';
                        }
                    }
                });
            }
        },
        
        // Fetch products data from database
        fetchProductsForCart: async function(cart) {
            const productIds = [...new Set(cart.map(item => item.id))];
            const products = {};
            
            if (productIds.length === 0) return products;
            
            try {
                const ajaxurl = (typeof vmstAjax !== 'undefined' && vmstAjax.ajaxurl) ? vmstAjax.ajaxurl : '/wp-admin/admin-ajax.php';
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
                return this.fetchSingleProduct(id).then(product => {
                    if (product) products[id] = product;
                });
            });
            
            await Promise.all(promises);
            return products;
        },
        
        // Fetch single product
        fetchSingleProduct: async function(productId) {
            try {
                const ajaxurl = (typeof vmstAjax !== 'undefined' && vmstAjax.ajaxurl) ? vmstAjax.ajaxurl : '/wp-admin/admin-ajax.php';
                const response = await fetch(`${ajaxurl}?action=vmst_get_product_data&product_id=${productId}`);
                const data = await response.json();
                
                if (data.success && data.data) {
                    return data.data;
                }
            } catch (error) {
                console.error('Error fetching product:', error);
            }
            return null;
        },
        
        // Get home URL
        getHomeUrl: function() {
            if (typeof vmstAjax !== 'undefined' && vmstAjax.homeUrl) {
                return vmstAjax.homeUrl.replace(/\/$/, '');
            }
            return window.location.origin;
        },
        
        // Format price
        formatPrice: function(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    };
    
    // Mini Cart Toggle
    const cartIconLink = document.getElementById('cart-icon-link');
    const miniCart = document.getElementById('mini-cart');
    const miniCartClose = document.getElementById('mini-cart-close');
    
    if (cartIconLink && miniCart) {
        cartIconLink.addEventListener('click', function(e) {
            e.preventDefault();
            miniCart.classList.toggle('active');
        });
        
        // Close mini cart
        if (miniCartClose) {
            miniCartClose.addEventListener('click', function(e) {
                e.stopPropagation();
                miniCart.classList.remove('active');
            });
        }
        
        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!cartIconLink.contains(e.target) && !miniCart.contains(e.target)) {
                miniCart.classList.remove('active');
            }
        });
    }
    
    // Initialize cart on page load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            NaminCart.updateCartCount();
            NaminCart.updateMiniCart();
        });
    } else {
        NaminCart.updateCartCount();
        NaminCart.updateMiniCart();
    }
    
    // Make NaminCart available globally
    window.NaminCart = NaminCart;
    
    // Global home URL for cart (from localized script)
    window.homeUrl = (typeof vmstAjax !== 'undefined' && vmstAjax.homeUrl) ? vmstAjax.homeUrl : window.location.origin + '/';

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    function init() {
        console.log('VMST Solutions theme loaded');
        initBannerSlider();
        initCurvedSlider();
        initPlatformCarousel();
    }
    
    // Curved Slider at 500px
    function initCurvedSlider() {
        const slider = document.getElementById('curved-slider');
        const slides = slider ? slider.querySelectorAll('.curved-slide') : [];
        
        if (!slider || slides.length === 0) return;
        
        let currentIndex = 0;
        const totalSlides = slides.length;
        
        function updateSlides() {
            slides.forEach((slide, i) => {
                // Remove all position classes and reset styles
                slide.classList.remove('curved-slide-left', 'curved-slide-center', 'curved-slide-right');
                slide.style.opacity = '';
                slide.style.pointerEvents = '';
                
                // Calculate relative position (circular)
                let position = i - currentIndex;
                if (position < 0) position += totalSlides;
                if (position >= totalSlides) position -= totalSlides;
                
                // Show only 3 slides: left, center, right
                if (position === 0) {
                    // Previous slide (left)
                    slide.classList.add('curved-slide-left');
                } else if (position === 1) {
                    // Current slide (center)
                    slide.classList.add('curved-slide-center');
                } else if (position === 2) {
                    // Next slide (right)
                    slide.classList.add('curved-slide-right');
                } else {
                    // Hide other slides
                    slide.style.opacity = '0';
                    slide.style.pointerEvents = 'none';
                }
            });
        }
        
        function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlides();
        }
        
        // Initialize
        updateSlides();
        
        // Auto slide every 4 seconds
        setInterval(nextSlide, 4000);
    }
    
    // Banner Slider
    function initBannerSlider() {
        const slider = document.getElementById('banner-slider');
        const slides = slider ? slider.querySelectorAll('.banner-slide') : [];
        const prevBtn = document.querySelector('.banner-slider-prev');
        const nextBtn = document.querySelector('.banner-slider-next');
        const dots = document.querySelectorAll('.banner-dot');
        
        if (!slider || slides.length === 0) return;
        
        let currentSlide = 0;
        const totalSlides = slides.length;
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            
            currentSlide = index;
        }
        
        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }
        
        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }
        
        if (prevBtn) {
            prevBtn.addEventListener('click', prevSlide);
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', nextSlide);
        }
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => showSlide(index));
        });
        
        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
    }
    
    // Platform Cards Carousel
    function initPlatformCarousel() {
        const carousel = document.getElementById('platform-cards-carousel');
        const prevBtn = document.querySelector('.platform-carousel-prev');
        const nextBtn = document.querySelector('.platform-carousel-next');
        const dots = document.querySelectorAll('.platform-dots .dot');
        
        if (!carousel || !prevBtn || !nextBtn) return;
        
        const cards = carousel.querySelectorAll('.platform-card');
        const totalCards = cards.length;
        let cardsPerView = 4;
        
        // Calculate cards per view based on screen size
        function getCardsPerView() {
            if (window.innerWidth <= 768) {
                return 1;
            } else if (window.innerWidth <= 1024) {
                return 2;
            }
            return 4;
        }
        
        let currentIndex = 0;
        
        function updateCarousel() {
            cardsPerView = getCardsPerView();
            const cardWidth = cards[0] ? cards[0].offsetWidth + 24 : 0; // card width + gap
            const translateX = -currentIndex * cardWidth;
            carousel.style.transform = `translateX(${translateX}px)`;
            
            // Update dots - each dot represents one card position
            // Map currentIndex to dot (considering we can scroll from 0 to totalCards - cardsPerView)
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            const activeDotIndex = Math.min(currentIndex, dots.length - 1);
            
            dots.forEach((dot, index) => {
                if (index === activeDotIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
            
            // Update button states
            prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
            prevBtn.style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
            nextBtn.style.pointerEvents = currentIndex >= maxIndex ? 'none' : 'auto';
        }
        
        function nextSlide() {
            cardsPerView = getCardsPerView();
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            if (currentIndex < maxIndex) {
                currentIndex = Math.min(currentIndex + 1, maxIndex); // Trượt 1 card mỗi lần
                updateCarousel();
            }
        }
        
        function prevSlide() {
            if (currentIndex > 0) {
                currentIndex = Math.max(currentIndex - 1, 0); // Trượt 1 card mỗi lần
                updateCarousel();
            }
        }
        
        function goToSlide(dotIndex) {
            cardsPerView = getCardsPerView();
            const maxIndex = Math.max(0, totalCards - cardsPerView);
            // Mỗi dot tương ứng với việc đưa card đó vào vị trí đầu tiên
            // Dot 0 = card 0, Dot 1 = card 1, ..., Dot 7 = card 7 (nếu có thể)
            const targetIndex = Math.min(dotIndex, maxIndex);
            if (targetIndex >= 0 && targetIndex <= maxIndex) {
                currentIndex = targetIndex;
                updateCarousel();
            }
        }
        
        // Event listeners
        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);
        
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });
        
        // Touch/swipe support
        let startX = 0;
        let currentX = 0;
        let isDragging = false;
        
        carousel.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
        });
        
        carousel.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
        });
        
        carousel.addEventListener('touchend', () => {
            if (!isDragging) return;
            isDragging = false;
            
            const diffX = startX - currentX;
            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        });
        
        // Mouse drag support
        let mouseStartX = 0;
        let mouseCurrentX = 0;
        let isMouseDragging = false;
        
        carousel.addEventListener('mousedown', (e) => {
            mouseStartX = e.clientX;
            isMouseDragging = true;
            carousel.style.cursor = 'grabbing';
        });
        
        carousel.addEventListener('mousemove', (e) => {
            if (!isMouseDragging) return;
            mouseCurrentX = e.clientX;
        });
        
        carousel.addEventListener('mouseup', () => {
            if (!isMouseDragging) return;
            isMouseDragging = false;
            carousel.style.cursor = 'grab';
            
            const diffX = mouseStartX - mouseCurrentX;
            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        });
        
        carousel.addEventListener('mouseleave', () => {
            isMouseDragging = false;
            carousel.style.cursor = 'grab';
        });
        
        // Initialize
        updateCarousel();
        
        // Responsive handling
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                updateCarousel();
            }, 250);
        });
    }

})();

