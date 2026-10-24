<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>THE CASUALISTS | Control Center</title>
    <!-- Responsive meta -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <!-- Modern Typography: Inter Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Global Aesthetic Admin Styling -->
    <style type="text/css">
      :root {
        --primary-blue: #2563eb;
        --dark-canvas: #090d16;
        --card-border: #e2e8f0;
        --text-slate: #1e293b;
        --subtext-slate: #64748b;
      }

      /* Global Typography Override */
      body, 
      .main-header .logo, 
      .content-header h1, 
      .table, 
      .box, 
      .btn,
      .form-control,
      h1, h2, h3, h4, h5, h6 {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }

      /* Base Content Wrapper */
      .content-wrapper {
        background-color: #f8fafc !important;
      }

      /* Global Card / Box Refinement */
      .box {
        border-radius: 14px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
        background: #ffffff !important;
      }
      .box.box-solid {
        border-top: 1px solid #e2e8f0 !important;
      }
      .box-header {
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 16px 20px !important;
      }
      .box-header .box-title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
      }

      /* Forms & Inputs */
      .form-control {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: none !important;
        transition: all 0.2s ease !important;
      }
      .form-control:focus {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
      }

      /* Modern DataTables Navigation & Search Styling */
      .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 6px 12px !important;
        margin-left: 8px !important;
        box-shadow: none !important;
      }
      .dataTables_wrapper .dataTables_length select {
        border-radius: 8px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 4px 8px !important;
      }
      .pagination > li > a, 
      .pagination > li > span {
        border-radius: 6px !important;
        margin: 0 3px !important;
        border: 1px solid #e2e8f0 !important;
        color: #475569 !important;
        font-weight: 600 !important;
      }
      .pagination > .active > a, 
      .pagination > .active > span {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
      }

      /* Sleek Scrollbars */
      ::-webkit-scrollbar {
        width: 7px;
        height: 7px;
      }
      ::-webkit-scrollbar-track {
        background: #f1f5f9;
      }
      ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
      }

      /* Helper classes */
      .mt20 { margin-top: 20px; }
      .bold { font-weight: 700; }

      /* Chart legend style */
      #legend ul {
        list-style: none;
        padding-left: 0;
      }
      #legend ul li {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-right: 18px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        cursor: default;
      }
      #legend li span {
        width: 12px;
        height: 12px;
        border-radius: 4px;
        display: inline-block;
      }
    </style>
</head>