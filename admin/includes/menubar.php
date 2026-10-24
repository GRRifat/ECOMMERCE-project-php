<?php
  // Dynamic active page detection
  $current_page = basename($_SERVER['PHP_SELF']);
  $is_catalog = in_array($current_page, ['products.php', 'category.php']);
?>

<!-- Ultra-Modern Aesthetic Sidebar Styling -->
<style>
  /* Deep Midnight Canvas */
  .main-sidebar {
    background: #090d16 !important;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Inter", sans-serif;
  }
  
  .sidebar {
    padding-bottom: 25px;
  }

  /* Aesthetic User Glass Card */
  .sidebar .user-card-wrap {
    margin: 16px 14px 22px 14px;
    padding: 14px;
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
  }
  .sidebar .user-card-wrap:hover {
    border-color: rgba(99, 102, 241, 0.3);
    background: rgba(255, 255, 255, 0.06);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
  }
  
  .sidebar .user-avatar-box {
    position: relative;
    width: 44px;
    height: 44px;
    flex-shrink: 0;
  }
  .sidebar .user-avatar-box img {
    width: 100%;
    height: 100%;
    border-radius: 12px;
    object-fit: cover;
    border: 1.5px solid rgba(255, 255, 255, 0.15);
  }
  .sidebar .live-dot {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 11px;
    height: 11px;
    background: #10b981;
    border: 2px solid #090d16;
    border-radius: 50%;
    box-shadow: 0 0 10px rgba(16, 185, 129, 0.8);
  }

  .sidebar .user-meta {
    overflow: hidden;
  }
  .sidebar .user-meta h4 {
    margin: 0 0 3px 0;
    font-size: 13.5px;
    font-weight: 700;
    color: #f1f5f9;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    letter-spacing: -0.2px;
  }
  .sidebar .user-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10.5px;
    font-weight: 600;
    color: #818cf8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Minimal Category Headers */
  .sidebar-menu > li.header {
    background: transparent !important;
    color: #475569 !important;
    font-size: 10px !important;
    font-weight: 800 !important;
    letter-spacing: 1.5px !important;
    padding: 16px 22px 8px 22px !important;
    text-transform: uppercase;
  }

  /* Sleek Floating Links */
  .sidebar-menu > li > a {
    padding: 10px 14px !important;
    color: #94a3b8 !important;
    font-size: 13px;
    font-weight: 600;
    margin: 4px 12px;
    border-radius: 10px;
    display: flex !important;
    align-items: center;
    border-left: none !important;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }
  
  .sidebar-menu > li > a .icon-glow {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.05);
    margin-right: 12px;
    font-size: 13px;
    color: #94a3b8;
    transition: all 0.25s ease;
  }

  /* Hover and Active Transitions */
  .sidebar-menu > li > a:hover {
    background: rgba(255, 255, 255, 0.05) !important;
    color: #ffffff !important;
    transform: translateX(3px);
  }
  .sidebar-menu > li > a:hover .icon-glow {
    background: rgba(99, 102, 241, 0.15);
    border-color: rgba(99, 102, 241, 0.3);
    color: #a5b4fc;
  }

  /* Active Pill with Gradient & Glow */
  .sidebar-menu > li.active > a {
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.16) 0%, rgba(79, 70, 229, 0.08) 100%) !important;
    color: #ffffff !important;
    border: 1px solid rgba(99, 102, 241, 0.25);
    box-shadow: 0 4px 15px rgba(99, 102, 241, 0.12);
  }
  .sidebar-menu > li.active > a .icon-glow {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 2px 10px rgba(99, 102, 241, 0.5);
  }

  /* Treeview Submenu */
  .sidebar-menu .treeview-menu {
    background: transparent !important;
    padding: 2px 0 6px 34px !important;
    margin: 0 12px;
    border-left: 1px dashed rgba(255, 255, 255, 0.1);
  }
  .sidebar-menu .treeview-menu > li > a {
    color: #64748b !important;
    font-size: 12.5px;
    padding: 7px 12px !important;
    font-weight: 500;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
  }
  .sidebar-menu .treeview-menu > li > a:hover {
    color: #f8fafc !important;
    background: rgba(255, 255, 255, 0.04);
    transform: translateX(3px);
  }
  .sidebar-menu .treeview-menu > li.active > a {
    color: #818cf8 !important;
    font-weight: 700;
    background: rgba(99, 102, 241, 0.1);
  }
  .sidebar-menu .treeview-menu > li > a i {
    font-size: 6px !important;
    opacity: 0.6;
  }
  .sidebar-menu .treeview-menu > li.active > a i {
    opacity: 1;
    color: #818cf8 !important;
  }
</style>

<aside class="main-sidebar">
  <section class="sidebar">
    
    <!-- Aesthetic User Card -->
    <div class="user-card-wrap">
      <div class="user-avatar-box">
        <img src="<?php echo (!empty($admin['photo'])) ? '../images/'.$admin['photo'] : '../images/profile.jpg'; ?>" alt="Admin Profile">
        <span class="live-dot"></span>
      </div>
      <div class="user-meta">
        <h4><?php echo htmlspecialchars($admin['firstname'].' '.$admin['lastname']); ?></h4>
        <span class="user-badge"><i class="fa fa-shield"></i> Verified Admin</span>
      </div>
    </div>

    <!-- Navigation Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      
      <li class="header">Main Analytics</li>
      
      <li class="<?php echo ($current_page == 'home.php') ? 'active' : ''; ?>">
        <a href="home.php">
          <span class="icon-glow"><i class="fa fa-th-large"></i></span>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li class="<?php echo ($current_page == 'sales.php' || $current_page == 'sales_print.php') ? 'active' : ''; ?>">
        <a href="sales.php">
          <span class="icon-glow"><i class="fa fa-shopping-bag"></i></span>
          <span>Sales & Orders</span>
        </a>
      </li>

      <li class="header">Management</li>
      
      <li class="<?php echo ($current_page == 'users.php' || $current_page == 'cart.php') ? 'active' : ''; ?>">
        <a href="users.php">
          <span class="icon-glow"><i class="fa fa-user-circle-o"></i></span>
          <span>Customers</span>
        </a>
      </li>

      <li class="treeview <?php echo $is_catalog ? 'active menu-open' : ''; ?>">
        <a href="#">
          <span class="icon-glow"><i class="fa fa-cubes"></i></span>
          <span>Catalog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right" style="transition: transform 0.3s ease;"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php echo ($current_page == 'products.php') ? 'active' : ''; ?>">
            <a href="products.php"><i class="fa fa-circle"></i> Products List</a>
          </li>
          <li class="<?php echo ($current_page == 'category.php') ? 'active' : ''; ?>">
            <a href="category.php"><i class="fa fa-circle"></i> Categories</a>
          </li>
        </ul>
      </li>

    </ul>
  </section>
</aside>