<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for About Page -->
<style>
  .about-container {
    padding-top: 25px;
    padding-bottom: 50px;
  }
  .about-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    padding: 0;
  }
  
  /* Hero Banner */
  .about-hero {
    background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);
    padding: 45px 35px;
    color: #ffffff;
    position: relative;
  }
  .about-hero .badge-tag {
    background: rgba(37, 99, 235, 0.25);
    border: 1px solid rgba(96, 165, 250, 0.4);
    color: #60a5fa;
    padding: 4px 14px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    display: inline-block;
    margin-bottom: 12px;
  }
  .about-hero h1 {
    font-size: 32px;
    font-weight: 800;
    margin: 0 0 10px 0;
    letter-spacing: -0.5px;
    color: #ffffff !important;
  }
  .about-hero p {
    color: #94a3b8;
    font-size: 15px;
    max-width: 600px;
    line-height: 1.6;
    margin: 0;
  }

  /* Content Body */
  .about-body {
    padding: 35px;
  }
  .intro-lead {
    font-size: 16px;
    line-height: 1.8;
    color: #334155;
    margin-bottom: 30px;
  }

  /* Value Feature Cards */
  .feature-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px 20px;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
  }
  .feature-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06);
    border-color: #cbd5e1;
  }
  .feature-icon-wrapper {
    width: 55px;
    height: 55px;
    background: #eff6ff;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    border: 1px solid #dbeafe;
  }
  .feature-icon-wrapper i {
    font-size: 22px;
    color: #2563eb;
  }
  .feature-box h4 {
    font-weight: 700;
    color: #0f172a;
    font-size: 16px;
    margin-bottom: 8px;
  }
  .feature-box p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
  }

  /* Metrics Ribbon */
  .stats-ribbon {
    background: #0f172a;
    border-radius: 14px;
    padding: 28px 20px;
    margin: 35px 0;
    color: #ffffff;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
    text-align: center;
  }
  .stat-item h3 {
    margin: 0;
    font-size: 28px;
    font-weight: 800;
    color: #38bdf8;
  }
  .stat-item span {
    font-size: 12px;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.6px;
  }

  /* Vision Section */
  .vision-box {
    border-left: 4px solid #2563eb;
    background: #eff6ff;
    padding: 20px 24px;
    border-radius: 0 12px 12px 0;
    margin-top: 15px;
  }
  .vision-box h4 {
    margin-top: 0;
    font-weight: 700;
    color: #1e3a8a;
  }
  .vision-box p {
    margin: 0;
    color: #1e40af;
    line-height: 1.7;
    font-size: 14px;
  }
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
    <div class="content-wrapper">
        <div class="container about-container">
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="about-card">
                            <!-- Hero Section Header -->
                            <div class="about-hero">
                                <span class="badge-tag"><i class="fa fa-sparkles"></i> Established 2026</span>
                                <h1>About The Casualists</h1>
                                <p>Refining every day lifestyles with quality-crafted wardrobe essentials, cutting-edge gear, and dependable modern aesthetics.</p>
                            </div>

                            <div class="about-body">
                                <p class="intro-lead">
                                    Welcome to <strong>The Casualists</strong> — your curated storefront for modern, effortless apparel and smart consumer tech. Born out of an appreciation for minimalism, durable build quality, and timeless palettes, we bridge the gap between everyday functionality and polished streetwear.
                                </p>

                                <!-- Three Pillars Grid -->
                                <div class="row">
                                    <div class="col-md-4" style="margin-bottom: 15px;">
                                        <div class="feature-box">
                                            <div class="feature-icon-wrapper">
                                                <i class="fa fa-diamond"></i>
                                            </div>
                                            <h4>Quality First</h4>
                                            <p>Every product catalogued undergoes verified sourcing for structural durability and fabric feel.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="margin-bottom: 15px;">
                                        <div class="feature-box">
                                            <div class="feature-icon-wrapper">
                                                <i class="fa fa-paper-plane"></i>
                                            </div>
                                            <h4>Swift Transit</h4>
                                            <p>Fast-track courier fulfillment designed to reach your doorstep safely with full live tracking.</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="margin-bottom: 15px;">
                                        <div class="feature-box">
                                            <div class="feature-icon-wrapper">
                                                <i class="fa fa-shield"></i>
                                            </div>
                                            <h4>Authentic Warranty</h4>
                                            <p>Comprehensive buyer protection, transparent exchange windows, and verified checkout flows.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Key Metrics -->
                                <div class="stats-ribbon">
                                    <div class="stat-item">
                                        <h3>100%</h3>
                                        <span>Verified Products</span>
                                    </div>
                                    <div class="stat-item">
                                        <h3>24/7</h3>
                                        <span>Query Assistance</span>
                                    </div>
                                    <div class="stat-item">
                                        <h3>Fast</h3>
                                        <span>Nationwide Logistics</span>
                                    </div>
                                </div>

                                <!-- Vision Statement -->
                                <div class="vision-box">
                                    <h4>Our Guiding Vision</h4>
                                    <p>
                                        We believe that choosing comfortable, dependable essentials shouldn't mean sacrificing design. Whether browsing our seasonal catalogs or upgrading your device accessories, our platform delivers an intuitive, secure, and satisfying retail journey.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Section -->
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
  
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>