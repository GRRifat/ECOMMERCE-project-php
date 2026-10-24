<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for Contact Page -->
<style>
  .contact-container {
    padding-top: 25px;
    padding-bottom: 50px;
  }
  .contact-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    padding: 0;
  }
  
  /* Hero Section */
  .contact-hero {
    background: linear-gradient(135deg, #090d16 0%, #1e293b 100%);
    padding: 40px 35px;
    color: #ffffff;
  }
  .contact-hero .badge-tag {
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
  .contact-hero h1 {
    font-size: 30px;
    font-weight: 800;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
    color: #ffffff !important;
  }
  .contact-hero p {
    color: #94a3b8;
    font-size: 14.5px;
    margin: 0;
  }

  .contact-body {
    padding: 35px;
  }

  /* Info Card */
  .info-panel {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    height: 100%;
  }
  .info-panel h4 {
    font-weight: 700;
    color: #0f172a;
    font-size: 16px;
    margin-top: 0;
    margin-bottom: 22px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e2e8f0;
  }
  .info-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 22px;
  }
  .info-icon {
    width: 42px;
    height: 42px;
    background: #eff6ff;
    border: 1px solid #dbeafe;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2563eb;
    font-size: 16px;
    flex-shrink: 0;
  }
  .info-content strong {
    display: block;
    font-size: 13.5px;
    color: #0f172a;
    margin-bottom: 2px;
  }
  .info-content a, .info-content span {
    font-size: 13px;
    color: #475569;
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .info-content a:hover {
    color: #2563eb;
  }

  /* Map Container */
  .map-wrapper {
    margin-top: 15px;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
  }
  .map-wrapper iframe {
    width: 100%;
    height: 190px;
    border: none;
    display: block;
  }
  .map-link-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px;
    background: #ffffff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none !important;
    border-top: 1px solid #e2e8f0;
    transition: all 0.2s ease;
  }
  .map-link-btn:hover {
    background: #eff6ff;
    color: #1d4ed8;
  }

  /* Form Inputs */
  .form-group label {
    font-weight: 600;
    color: #334155;
    font-size: 13px;
    margin-bottom: 6px;
  }
  .form-modern-input {
    border-radius: 8px !important;
    border: 1px solid #cbd5e1 !important;
    padding: 10px 14px !important;
    height: 44px;
    font-size: 13.5px;
    transition: all 0.2s ease;
  }
  .form-modern-input:focus {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
  }
  textarea.form-modern-input {
    height: auto;
  }
  .btn-send-message {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    border: none;
    border-radius: 8px;
    font-weight: 600;
    padding: 11px 26px;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.28);
    transition: all 0.2s ease;
  }
  .btn-send-message:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.38);
  }
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
    <div class="content-wrapper">
        <div class="container contact-container">
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="contact-card">
                            
                            <!-- Header Banner -->
                            <div class="contact-hero">
                                <span class="badge-tag"><i class="fa fa-envelope-o"></i> Direct Support</span>
                                <h1>Get In Touch With Us</h1>
                                <p>Have inquiries about orders, catalog availability, or deliveries? Reach out through the form or visit our outlet.</p>
                            </div>

                            <div class="contact-body">
                                <?php
                                    if(isset($_POST['send_contact'])){
                                        echo "
                                            <div class='alert alert-success' style='border-radius: 10px; margin-bottom: 25px; border: 1px solid #a7f3d0; background: #ecfdf5; color: #065f46;'>
                                                <i class='fa fa-check-circle' style='margin-right: 6px;'></i> Thank you! Your message has been sent successfully. We will respond shortly.
                                            </div>
                                        ";
                                    }
                                ?>

                                <div class="row">
                                    <!-- Left Column: Store Details & Google Map -->
                                    <div class="col-md-5" style="margin-bottom: 25px;">
                                        <div class="info-panel">
                                            <h4>Store Information</h4>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="info-content">
                                                    <strong>Store Address</strong>
                                                    <span>60 Fit, Amtola Bazar, Mirpur 2, Dhaka 1207</span>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <div class="info-content">
                                                    <strong>Email Support</strong>
                                                    <a href="mailto:gawshilrifat@gmail.com">gawshilrifat@gmail.com</a>
                                                </div>
                                            </div>

                                            <div class="info-item" style="margin-bottom: 15px;">
                                                <div class="info-icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <div class="info-content">
                                                    <strong>Helpline</strong>
                                                    <a href="tel:01323xxxxxxx">01323xxxxxxx</a>
                                                    <small style="display:block; color:#94a3b8; margin-top:2px;">Sat – Thu: 10:00 AM – 9:00 PM</small>
                                                </div>
                                            </div>

                                            <!-- Interactive Google Map Embed -->
                                            <div class="map-wrapper">
                                                <iframe 
                                                    src="https://maps.google.com/maps?q=Amtola+Bazar+60+feet+Road+Mirpur+Dhaka&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                                                    loading="lazy" 
                                                    allowfullscreen>
                                                </iframe>
                                                <a href="https://maps.app.goo.gl/6giCjcy3P98ux2bd7" target="_blank" rel="noopener noreferrer" class="map-link-btn">
                                                    <i class="fa fa-external-link"></i> Open in Google Maps
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Right Column: Interactive Contact Form -->
                                    <div class="col-md-7">
                                        <form method="POST" action="">
                                            <div class="form-group">
                                                <label>Your Name</label>
                                                <input type="text" name="name" class="form-control form-modern-input" placeholder="e.g. John Doe" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" name="email" class="form-control form-modern-input" placeholder="e.g. name@example.com" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input type="text" name="subject" class="form-control form-modern-input" placeholder="What is your query about?" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea name="message" class="form-control form-modern-input" rows="5" placeholder="Write down your detailed message here..." required></textarea>
                                            </div>

                                            <button type="submit" name="send_contact" class="btn btn-send-message">
                                                <i class="fa fa-paper-plane" style="margin-right: 6px;"></i> Send Message
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Component -->
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