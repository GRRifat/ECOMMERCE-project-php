<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
     
      <div class="content-wrapper">
        <div class="container">

          <!-- Main content -->
          <section class="content">
            <div class="row">
                <div class="col-sm-9">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "
                                <div class='alert alert-danger'>
                                    ".$_SESSION['error']."
                                </div>
                            ";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="images/banner1.png" alt="First slide">
                          </div>
                          <div class="item">
                            <img src="images/banner2.png" alt="Second slide">
                          </div>
                          <div class="item">
                            <img src="images/banner3.png" alt="Third slide">
                          </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                          <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                          <span class="fa fa-angle-right"></span>
                        </a>
                    </div>

                    <?php
                        $conn = $pdo->open();

                        try{
                            // 1. Fetch all product categories
                            $stmt_cat = $conn->prepare("SELECT * FROM category ORDER BY name ASC");
                            $stmt_cat->execute();

                            foreach ($stmt_cat as $cat) {
                                $catid = $cat['id'];

                                // 2. Fetch products under each category
                                $stmt_prod = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
                                $stmt_prod->execute(['catid' => $catid]);
                                $products = $stmt_prod->fetchAll();

                                // Only render category section if it contains products
                                if(count($products) > 0){
                                    echo "<h2 class='page-header' style='margin-top: 30px;'><a href='category.php?category=".$cat['cat_slug']."'>".htmlspecialchars($cat['name'])."</a></h2>";

                                    $inc = 3;
                                    foreach ($products as $row) {
                                        $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                        $inc = ($inc == 3) ? 1 : $inc + 1;

                                        if($inc == 1) echo "<div class='row'>";
                                        echo "
                                            <div class='col-sm-4'>
                                                <div class='box box-solid'>
                                                    <div class='box-body prod-body'>
                                                        <img src='".$image."' width='100%' height='230px' class='thumbnail' style='object-fit: cover;'>
                                                        <h5><a href='product.php?product=".$row['slug']."'>".htmlspecialchars($row['name'])."</a></h5>
                                                    </div>
                                                    <div class='box-footer'>
                                                        <b>&#2547; ".number_format($row['price'], 2)."</b>
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
                            echo "There is some problem in connection: " . $e->getMessage();
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