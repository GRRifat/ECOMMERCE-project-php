<!-- Modern Custom Navbar Styling -->
<style>
  .main-header {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  }
  .main-header .logo {
    background: #0f172a !important;
    color: #ffffff !important;
    font-weight: 700;
    transition: all 0.3s ease;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
  }
  .main-header .logo:hover {
    background: #1e293b !important;
  }
  .main-header .navbar {
    background: linear-gradient(90deg, #1e3a8a 0%, #2563eb 100%) !important;
  }
  .main-header .sidebar-toggle {
    color: #ffffff !important;
    transition: background 0.2s ease;
  }
  .main-header .sidebar-toggle:hover {
    background: rgba(255, 255, 255, 0.1) !important;
  }
  .main-header .user-menu .dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-top: 13px !important;
    padding-bottom: 13px !important;
    color: #ffffff !important;
    font-weight: 600;
    letter-spacing: 0.3px;
  }
  .main-header .user-menu .dropdown-toggle:hover,
  .main-header .user-menu.open .dropdown-toggle {
    background: rgba(255, 255, 255, 0.12) !important;
  }
  .main-header .user-image {
    width: 32px !important;
    height: 32px !important;
    margin-top: 0 !important;
    border: 2px solid rgba(255, 255, 255, 0.8);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }
  /* Dropdown Panel */
  .main-header .navbar-nav > .user-menu > .dropdown-menu {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    overflow: hidden;
    padding: 0;
    margin-top: 6px;
    width: 275px;
  }
  .main-header .user-header {
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%) !important;
    padding: 24px 20px 20px 20px !important;
    height: auto !important;
  }
  .main-header .user-header img {
    width: 78px !important;
    height: 78px !important;
    border: 3px solid #ffffff !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    object-fit: cover;
  }
  .main-header .user-header p {
    color: #ffffff !important;
    font-weight: 700;
    font-size: 16px;
    margin-top: 10px;
  }
  .main-header .user-header p small {
    display: block;
    font-size: 12px;
    color: #e0e7ff !important;
    font-weight: 500;
    margin-top: 4px;
  }
  .main-header .user-footer {
    background: #f8fafc !important;
    padding: 12px 18px !important;
    border-top: 1px solid #e2e8f0;
  }
  .btn-nav-update {
    background: #ffffff;
    color: #2563eb;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    padding: 6px 14px;
    transition: all 0.2s ease;
  }
  .btn-nav-update:hover {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1d4ed8;
  }
  .btn-nav-logout {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 6px;
    font-weight: 600;
    font-size: 13px;
    padding: 6px 14px;
    transition: all 0.2s ease;
  }
  .btn-nav-logout:hover {
    background: #dc2626;
    border-color: #dc2626;
    color: #ffffff;
  }
</style>

<header class="main-header">
  <!-- Logo -->
  <a href="home.php" class="logo">
    <!-- Mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>T</b>C</span>
    <!-- Regular logo for regular devices and mobile devices -->
    <span class="logo-lg" style="letter-spacing: 0.5px;">
      <i class="fa fa-shopping-bag" style="color: #3b82f6; margin-right: 4px; font-size: 17px;"></i>
      <b style="font-weight: 800; font-size: 15px; text-transform: uppercase;">The Casualists</b>
    </span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" class="user-image img-circle" alt="Admin Profile">
            <span class="hidden-xs"><?php echo htmlspecialchars($admin['firstname'].' '.$admin['lastname']); ?></span>
            <i class="fa fa-angle-down" style="font-size: 12px; margin-left: 2px; opacity: 0.8;"></i>
          </a>
          <ul class="dropdown-menu">
            <!-- User image header -->
            <li class="user-header">
              <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="Admin Profile">
              <p>
                <?php echo htmlspecialchars($admin['firstname'].' '.$admin['lastname']); ?>
                <small><i class="fa fa-clock-o" style="margin-right: 4px;"></i> Member since <?php echo date('M. Y', strtotime($admin['created_on'])); ?></small>
              </p>
            </li>

            <!-- User Menu Footer -->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat btn-nav-update" id="admin_profile">
                  <i class="fa fa-user-circle-o" style="margin-right: 4px;"></i> Update
                </a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat btn-nav-logout">
                  <i class="fa fa-sign-out" style="margin-right: 4px;"></i> Sign out
                </a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>