<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Storefront Styles -->
<style>
  /* Hero Carousel Optimized Size */
  .modern-carousel {
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e2e8f0;
    margin-bottom: 30px;
    background: #0f172a;
  }
  .modern-carousel .carousel-inner .item {
    height: 300px;
    background: #090d16;
    text-align: center;
  }
  .modern-carousel .carousel-inner .item img {
    height: 100%;
    max-height: 280px;
    width: auto;
    max-width: 100%;
    margin: 10px auto;
    object-fit: contain;
    display: inline-block;
  }
  .modern-carousel .carousel-control {
    width: 40px;
    height: 40px;
    top: 50%;
    transform: translateY(-50%);
    border-radius: 50%;
    background: rgba(11, 15, 25, 0.6);
    backdrop-filter: blur(6px);
    opacity: 0.8;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-shadow: none;
  }
  .modern-carousel:hover .carousel-control {
    opacity: 1;
  }
  .modern-carousel .carousel-control.left {
    left: 15px;
  }
  .modern-carousel .carousel-control.right {
    right: 15px;
  }
  .modern-carousel .carousel-indicators {
    bottom: 10px;
  }
  .modern-carousel .carousel-indicators li {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.35);
    border: none;
    margin: 0 3px;
  }
  .modern-carousel .carousel-indicators .active {
    width: 20px;
    border-radius: 8px;
    background: #ffffff;
  }

  /* Section Title */
  .category-section-title {
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.3px;
    margin: 40px 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .category-section-title a {
    color: #0f172a;
    text-decoration: none;
  }
  .category-section-title a:hover {
    color: #2563eb;
  }
  .category-section-title .view-all-link {
    font-size: 13px;
    font-weight: 600;
    color: #2563eb;
  }

  /* Modern Product Card */
  .modern-product-card {
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    overflow: hidden;
    margin-bottom: 25px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    height: 380px;
  }
  .modern-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
  }
  .prod-img-box {
    position: relative;
    width: 100%;
    height: 220px;
    background: #f8fafc;
    overflow: hidden;
    padding: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .prod-img-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: transform 0.4s ease;
  }
  .modern-product-card:hover .prod-img-box img {
    transform: scale(1.05);
  }
  .prod-details-box {
    padding: 16px;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .prod-title {
    font-size: 14.5px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0 0 10px 0;
    height: 40px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
  .prod-title a {
    color: #1e293b;
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .prod-title a:hover {
    color: #2563eb;
  }
  .prod-price-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 10px;
    border-top: 1px dashed #e2e8f0;
  }
  .price-tag {
    font-size: 17px;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.3px;
  }
  .btn-quick-view {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    text-decoration: none !important;
    transition: all 0.2s ease;
  }
  .btn-quick-view:hover {
    background: #2563eb;
    color: #ffffff;
  }
</style>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
      <div class="content-wrapper">
        <div class="container" style="margin-top: 25px;">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-9">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "
                                <div class='alert alert-danger' style='border-radius: 10px;'>
                                    ".$_SESSION['error']."
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                    ?>

                   
                    <?php
                        $conn = $pdo->open();

                        try{
                            $stmt_cat = $conn->prepare("SELECT * FROM category ORDER BY name ASC");
                            $stmt_cat->execute();

                            foreach ($stmt_cat as $cat) {
                                $catid = $cat['id'];

                                $stmt_prod = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                                $stmt_prod->execute(['catid' => $catid]);
                                $products = $stmt_prod->fetchAll();

                                if(count($products) > 0){
                                    echo "
                                      <div class='category-section-title'>
                                        <span><i class='fa fa-tag text-primary' style='margin-right: 8px;'></i> ".htmlspecialchars($cat['name'])."</span>
                                        <a href='category.php?category=".$cat['cat_slug']."' class='view-all-link'>View All <i class='fa fa-arrow-right'></i></a>
                                      </div>
                                    ";

                                    $inc = 3;
                                    foreach ($products as $row) {
                                        $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                        $inc = ($inc == 3) ? 1 : $inc + 1;

                                        if($inc == 1) echo "<div class='row'>";
                                        echo "
                                            <div class='col-sm-4'>
                                                <div class='modern-product-card'>
                                                    <div class='prod-img-box'>
                                                        <a href='product.php?product=".$row['slug']."'>
                                                          <img src='".$image."' alt='".htmlspecialchars($row['name'])."'>
                                                        </a>
                                                    </div>
                                                    <div class='prod-details-box'>
                                                        <h5 class='prod-title'>
                                                          <a href='product.php?product=".$row['slug']."'>".htmlspecialchars($row['name'])."</a>
                                                        </h5>
                                                        <div class='prod-price-row'>
                                                            <span class='price-tag'>&#2547; ".number_format($row['price'], 2)."</span>
                                                            <a href='product.php?product=".$row['slug']."' class='btn-quick-view'>View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                        if($inc == 3) echo "</div>";
                                    }
                                    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
                                    if($inc == 2) echo "<div class='col-sm-4'></div></div>";
                                }
                            }
                        }
                        catch(PDOException $e){
                            echo "<div class='alert alert-danger'>Connection error: " . $e->getMessage() . "</div>";
                        }

                        $pdo->close();
                    ?> 
                </div>
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