<!-- Custom Luxury Navbar Styles -->
<style>
  .custom-store-nav {
    background: #0b0f19 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.35);
  }

  /* Logo / Brand */
  .custom-store-nav .navbar-brand {
    font-size: 18px !important;
    font-weight: 800 !important;
    letter-spacing: 1.2px;
    color: #ffffff !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 18px 15px;
    transition: opacity 0.2s ease;
  }
  .custom-store-nav .navbar-brand:hover {
    opacity: 0.9;
  }
  .custom-store-nav .brand-dot {
    width: 7px;
    height: 7px;
    background: #3b82f6;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 10px #3b82f6;
  }

  /* Navigation Links */
  .custom-store-nav .navbar-nav > li > a {
    color: #cbd5e1 !important;
    font-weight: 600;
    font-size: 13px;
    letter-spacing: 0.6px;
    padding: 18px 14px !important;
    transition: all 0.25s ease;
  }
  .custom-store-nav .navbar-nav > li > a:hover,
  .custom-store-nav .navbar-nav > li.open > a,
  .custom-store-nav .navbar-nav > li.active > a {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.06) !important;
  }

  /* Search Bar */
  .custom-store-nav .navbar-form {
    margin-top: 11px;
    margin-bottom: 11px;
    border: none;
    box-shadow: none;
    padding: 0 10px;
  }
  #navbar-search-input {
    background: rgba(255, 255, 255, 0.07) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    border-radius: 24px !important;
    color: #ffffff !important;
    font-size: 12.5px;
    height: 36px;
    padding-left: 16px;
    padding-right: 16px;
    box-shadow: none !important;
    transition: all 0.3s ease;
  }
  #navbar-search-input::placeholder {
    color: #64748b;
  }
  #navbar-search-input:focus {
    background: #111827 !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 0 12px rgba(59, 130, 246, 0.3) !important;
  }

  /* Dropdown Menus */
  .custom-store-nav .dropdown-menu {
    background: #0f172a !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 12px !important;
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5) !important;
    padding: 6px !important;
    margin-top: 5px;
  }
  .custom-store-nav .dropdown-menu > li > a {
    color: #cbd5e1 !important;
    font-size: 13px;
    font-weight: 500;
    padding: 8px 14px;
    border-radius: 6px;
    transition: all 0.2s ease;
  }
  .custom-store-nav .dropdown-menu > li > a:hover {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
    transform: translateX(3px);
  }

  /* Cart Icon & Glow Pill */
  .cart-link-btn {
    position: relative;
    padding: 17px 16px !important;
    color: #ffffff !important;
  }
  .cart-link-btn i {
    font-size: 16px;
  }
  .cart_count {
    position: absolute;
    top: 9px;
    right: 6px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
    color: #ffffff;
    font-size: 10px !important;
    font-weight: 700;
    padding: 2px 6px !important;
    border-radius: 10px !important;
    box-shadow: 0 0 8px rgba(37, 99, 235, 0.6);
  }

  /* Cart Dropdown Preview */
  .messages-menu .dropdown-menu {
    width: 290px !important;
    padding: 0 !important;
    overflow: hidden;
  }
  .messages-menu .dropdown-menu li.header {
    background: #1e293b;
    color: #e2e8f0;
    padding: 12px 16px;
    font-size: 12px;
    font-weight: 600;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  }
  .messages-menu .dropdown-menu li.footer a {
    background: #0f172a !important;
    color: #38bdf8 !important;
    text-align: center;
    font-weight: 600;
    padding: 10px !important;
    display: block;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
  }
  .messages-menu .dropdown-menu li.footer a:hover {
    background: #1e293b !important;
    color: #ffffff !important;
  }

  /* User Menu */
  .custom-store-nav .user-image {
    width: 26px !important;
    height: 26px !important;
    border-radius: 50%;
    margin-right: 6px;
    object-fit: cover;
    border: 1.5px solid #3b82f6;
  }
  .custom-store-nav .user-header {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
    padding: 22px 18px !important;
    text-align: center;
  }
  .custom-store-nav .user-header img {
    width: 68px !important;
    height: 68px !important;
    border: 2px solid #3b82f6;
    object-fit: cover;
  }
  .custom-store-nav .user-header p {
    color: #ffffff !important;
    font-weight: 700;
    margin-top: 8px;
    font-size: 14px;
  }
  .custom-store-nav .user-header p small {
    color: #94a3b8 !important;
  }
  .custom-store-nav .user-footer {
    background: #0b0f19 !important;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding: 12px 16px !important;
  }
  .custom-store-nav .user-footer .btn {
    border-radius: 6px;
    font-weight: 600;
    font-size: 12.5px;
    padding: 6px 14px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #ffffff !important;
    transition: all 0.2s ease;
  }
  .custom-store-nav .user-footer .btn:hover {
    background: #ffffff;
    color: #0b0f19 !important;
  }

  /* Mobile Hamburger */
  .custom-store-nav .navbar-toggle {
    border: 1px solid rgba(255, 255, 255, 0.15);
    background: transparent;
    color: #ffffff;
    border-radius: 6px;
    margin-top: 13px;
    padding: 8px 10px;
  }
  .custom-store-nav .navbar-toggle:hover {
    background: rgba(255, 255, 255, 0.08);
  }
</style>

<header class="main-header">
  <nav class="navbar navbar-static-top custom-store-nav">
    <div class="container">
      <div class="navbar-header">
        <a href="index.php" class="navbar-brand">
          <b>THE CASUALISTS</b>
          <span class="brand-dot"></span>
        </a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Nav links and Search form -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php"><i class="fa fa-home" style="margin-right: 4px;"></i> HOME</a></li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              CATEGORY <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <?php
                $conn = $pdo->open();
                try {
                  $stmt = $conn->prepare("SELECT * FROM category");
                  $stmt->execute();
                  foreach ($stmt as $row) {
                    echo "
                      <li><a href='category.php?category=" . $row['cat_slug'] . "'><i class='fa fa-angle-right' style='margin-right: 6px; opacity: 0.5;'></i> " . htmlspecialchars($row['name']) . "</a></li>
                    ";
                  }
                } catch (PDOException $e) {
                  echo "<li style='padding: 8px 12px; color: #ef4444;'>Connection issue</li>";
                }
                $pdo->close();
              ?>
            </ul>
          </li>
          <li><a href="about.php">ABOUT US</a></li>
          <li><a href="contact.php">CONTACT US</a></li>
        </ul>

        <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
            <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search products..." required>
            <span class="input-group-btn" id="searchBtn" style="display:none;">
              <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </form>
      </div>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Shopping Cart Dropdown -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle cart-link-btn" data-toggle="dropdown" title="View Cart">
              <i class="fa fa-shopping-bag"></i>
              <span class="label cart_count"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="cart_count">0</span> item(s) in cart</li>
              <li>
                <ul class="menu" id="cart_menu" style="max-height: 250px; overflow-y: auto;">
                </ul>
              </li>
              <li class="footer"><a href="cart_view.php"><i class="fa fa-arrow-right" style="margin-right: 5px;"></i> Proceed to Cart</a></li>
            </ul>
          </li>

          <?php
          if (isset($_SESSION['user'])) {
            $image = (!empty($user['photo'])) ? 'images/' . $user['photo'] : 'images/profile.jpg';
            echo '
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="display: flex; align-items: center;">
                  <img src="' . $image . '" class="user-image" alt="User Image">
                  <span class="hidden-xs">' . htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) . '</span>
                  <i class="fa fa-angle-down" style="margin-left: 6px; font-size: 11px; opacity: 0.6;"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- User Header -->
                  <li class="user-header">
                    <img src="' . $image . '" class="img-circle" alt="User Image">
                    <p>
                      ' . htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) . '
                      <small>Member since ' . date('M. Y', strtotime($user['created_on'])) . '</small>
                    </p>
                  </li>
                  <!-- User Footer -->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat"><i class="fa fa-user" style="margin-right: 4px;"></i> Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out" style="margin-right: 4px;"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            ';
          } else {
            echo "
              <li><a href='login.php'><i class='fa fa-sign-in' style='margin-right: 4px;'></i> LOGIN</a></li>
              <li><a href='signup.php' style='color: #60a5fa !important;'><i class='fa fa-user-plus' style='margin-right: 4px;'></i> SIGNUP</a></li>
            ";
          }
          ?>
        </ul>
      </div>

    </div>
  </nav>
</header>