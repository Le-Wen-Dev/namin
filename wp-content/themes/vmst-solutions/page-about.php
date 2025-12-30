<?php
/**
 * Template Name: About Page
 * About Us Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="page-about">
        <!-- Hero Section -->
        <section class="about-hero">
            <div class="about-hero-content">
                <h1 class="about-hero-title">Về Namin</h1>
                <p class="about-hero-subtitle">Thiết bị phòng tắm cao cấp nhập khẩu cho không gian sống sang trọng</p>
            </div>
        </section>

        <!-- About Content -->
        <section class="about-content">
            <div class="container">
                <div class="about-intro">
                    <h2 class="section-title">Chúng tôi là ai?</h2>
                    <div class="about-text">
                        <p>Namin là thương hiệu chuyên cung cấp các sản phẩm trang thiết bị phòng tắm, nhà vệ sinh cao cấp nhập khẩu. Với hơn 10 năm kinh nghiệm trong ngành, chúng tôi tự hào mang đến cho khách hàng những sản phẩm chất lượng cao, thiết kế hiện đại và sang trọng.</p>
                        <p>Đội ngũ của chúng tôi luôn tận tâm, chuyên nghiệp và cam kết mang đến trải nghiệm tốt nhất cho khách hàng. Từ khâu tư vấn, thiết kế đến lắp đặt, chúng tôi đảm bảo mọi chi tiết đều hoàn hảo.</p>
                    </div>
                </div>

                <!-- Values Section -->
                <div class="about-values">
                    <h2 class="section-title">Giá trị cốt lõi</h2>
                    <div class="values-grid">
                        <div class="value-card">
                            <div class="value-icon">✓</div>
                            <h3 class="value-title">Chất lượng</h3>
                            <p class="value-description">Sản phẩm nhập khẩu chính hãng, đảm bảo chất lượng cao nhất</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">✓</div>
                            <h3 class="value-title">Thiết kế</h3>
                            <p class="value-description">Thiết kế hiện đại, sang trọng, phù hợp mọi không gian</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">✓</div>
                            <h3 class="value-title">Dịch vụ</h3>
                            <p class="value-description">Tư vấn chuyên nghiệp, lắp đặt tận nơi, bảo hành dài hạn</p>
                        </div>
                        <div class="value-card">
                            <div class="value-icon">✓</div>
                            <h3 class="value-title">Uy tín</h3>
                            <p class="value-description">Hơn 10 năm kinh nghiệm, được hàng nghìn khách hàng tin tưởng</p>
                        </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="about-team">
                    <h2 class="section-title">Đội ngũ của chúng tôi</h2>
                    <p class="team-description">Đội ngũ chuyên nghiệp, giàu kinh nghiệm và tận tâm với khách hàng</p>
                </div>

                <!-- Contact CTA -->
                <div class="about-cta">
                    <h2 class="cta-title">Liên hệ với chúng tôi</h2>
                    <p class="cta-description">Bạn có câu hỏi hoặc cần tư vấn? Hãy liên hệ với chúng tôi ngay hôm nay!</p>
                    <a href="<?php echo esc_url(home_url('/lien-he')); ?>" class="cta-button">Liên hệ ngay</a>
                </div>
            </div>
        </section>
    </div>
</main>

<style>
.page-about {
    padding-top: 100px;
}

.about-hero {
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    padding: 100px 20px;
    text-align: center;
    color: white;
}

.about-hero-title {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.about-hero-subtitle {
    font-size: 20px;
    opacity: 0.9;
    max-width: 800px;
    margin: 0 auto;
}

.about-content {
    padding: 80px 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.about-intro {
    margin-bottom: 80px;
}

.section-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
}

.about-text {
    max-width: 900px;
    margin: 0 auto;
    font-size: 18px;
    line-height: 1.8;
}

.about-text p {
    margin-bottom: 20px;
}

.about-values {
    margin-bottom: 80px;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.value-card {
    background: #f8f9fa;
    padding: 40px 30px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.value-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    font-weight: bold;
    margin: 0 auto 20px;
}

.value-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 15px;
}

.value-description {
    color: #666;
    line-height: 1.6;
}

.about-team {
    margin-bottom: 80px;
    text-align: center;
}

.team-description {
    font-size: 18px;
    color: #666;
    max-width: 700px;
    margin: 20px auto 0;
}

.about-cta {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 60px 40px;
    border-radius: 16px;
    text-align: center;
}

.cta-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-description {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
}

.cta-button {
    display: inline-block;
    padding: 16px 40px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 18px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.cta-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(8, 123, 181, 0.3);
}

@media (max-width: 768px) {
    .about-hero-title {
        font-size: 36px;
    }
    
    .about-hero-subtitle {
        font-size: 18px;
    }
    
    .section-title {
        font-size: 28px;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
get_footer();
?>

