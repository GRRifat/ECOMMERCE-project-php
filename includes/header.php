<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THE CASUALISTS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Magnify -->
    <link rel="stylesheet" href="magnify/magnify.min.css">

    <!-- Google Font: Inter (Clean, Modern, Luxury feel) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Paypal Express -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <!-- Google Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Aesthetic Minimalist Luxe Styling -->
    <style type="text/css">
      * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      body, .content-wrapper, .box, .table, p, span, h1, h2, h3, h4, h5, h6, input, button {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
      }

      /* ========================================================
         HEADER: Pure Luxury Carbon Black with Frosted Accents
         ======================================================== */
      .main-header, 
      .main-header .navbar,
      .layout-top-nav .main-header > .navbar {
        background: #292d39 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.22) !important;
        min-height: 60px;
      }

      /* Logo Branding */
      .main-header .navbar-brand,
      .main-header .logo {
        color: #ffffff !important;
        font-weight: 800 !important;
        letter-spacing: 1px;
        font-size: 17px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
      }

      /* Navigation Links */
      .main-header .navbar .nav > li > a {
        color: #e2e8f0 !important;
        font-weight: 500 !important;
        font-size: 13.5px !important;
        letter-spacing: 0.2px;
        padding: 20px 18px !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
      }

      /* Link Hover / Active State */
      .main-header .navbar .nav > li > a:hover,
      .main-header .navbar .nav > li > a:focus,
      .main-header .navbar .nav > .active > a,
      .main-header .navbar .nav > .open > a {
        background: rgba(255, 255, 255, 0.06) !important;
        color: #ffffff !important;
      }

      /* Header Search Bar: Sleek Dark Capsule */
      #navbar-search-input {
        background: rgba(255, 255, 255, 0.06) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #ffffff !important;
        border-radius: 30px !important;
        padding: 7px 18px !important;
        font-size: 13px !important;
        height: 38px;
        margin-top: 11px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
      }

      #navbar-search-input::placeholder {
        color: #94a3b8 !important;
        font-weight: 400;
      }

      #navbar-search-input:focus {
        background: #111827 !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2) !important;
      }

      @media (min-width: 768px){ 
        #navbar-search-input { width: 150px; }
        #navbar-search-input:focus { width: 220px; }
      }

      @media (min-width: 992px){ 
        #navbar-search-input { width: 200px; }
        #navbar-search-input:focus { width: 300px; } 
      }

      /* Cart Badge: Modern Pill Accent */
      .main-header .label-success,
      .main-header .cart_count {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        padding: 3px 8px !important;
        font-weight: 700 !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
      }

      /* Header Dropdown Menu (Clean Glass look) */
      .main-header .dropdown-menu {
        background: #0f172a !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 12px !important;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4) !important;
        padding: 6px !important;
        margin-top: 4px;
      }

      .main-header .dropdown-menu > li > a {
        color: #cbd5e1 !important;
        padding: 9px 16px !important;
        font-size: 13px !important;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.2s ease;
      }

      .main-header .dropdown-menu > li > a:hover {
        background: rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
        padding-left: 19px !important;
      }

      /* ========================================================
         PAGE BODY & CARDS: Clean, Crisp, Modern
         ======================================================== */
      .content-wrapper {
        background: #f8fafc !important;
      }

      .word-wrap {
        overflow-wrap: break-word;
      }

      .prod-body {
        height: 300px;
      }

      /* Clean Product Card */
      .box {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
      }

      .box:hover {
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.08) !important;
        transform: translateY(-4px);
        border-color: #cbd5e1 !important;
      }

      .register-box {
        margin-top: 20px;
      }

      /* Trending List / Sidebar */
      #trending {
        list-style: none;
        padding: 10px 0;
        margin: 0;
      }

      #trending li {
        position: relative;
        padding: 10px 14px 10px 34px;
        margin-bottom: 6px;
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        transition: all 0.2s ease;
      }

      #trending li:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
        transform: translateX(3px);
      }

      #trending li:before {
        content: "\f005";
        font-family: FontAwesome;
        position: absolute;
        left: 12px;
        top: 10px;
        color: #f59e0b;
        font-size: 11px;
      }

      #trending li a {
        color: #334155;
      }

      #trending li a:hover {
        color: #2563eb;
      }

      /* Magnify Tool */
      .magnify > .magnify-lens {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #ffffff;
        box-shadow: 0 8px 24px rgba(0,0,0,0.3);
      }
    </style>
</head>