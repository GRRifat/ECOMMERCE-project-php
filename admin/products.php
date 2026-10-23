<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  $catid = 0;
  if(isset($_GET['category'])){
    $catid = $_GET['category'];
    $where = 'WHERE category_id ='.$catid;
  }
?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for Product Management -->
<style>
  .content-header h1 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
  }
  .product-box {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    overflow: hidden;
  }
  .product-box .box-header {
    background: #ffffff;
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
  }
  .btn-add-product {
    height: 36px;
    border-radius: 8px;
    font-weight: 600;
    padding: 7px 18px;
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    border: none;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
    transition: all 0.2s ease;
    color: #ffffff !important;
  }
  .btn-add-product:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
  }
  .category-filter-select {
    height: 36px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    font-weight: 600;
    color: #334155;
    padding: 4px 12px;
  }
  /* Modern Table Styling */
  #example1 {
    border-collapse: separate;
    border-spacing: 0;
    width: 100% !important;
  }
  #example1 thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-top: none;
    border-bottom: 2px solid #e2e8f0;
    padding: 14px 12px;
  }
  #example1 tbody td {
    padding: 14px 12px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    color: #334155;
    font-size: 14px;
  }
  #example1 tbody tr:hover {
    background-color: #f8fafc;
  }
  /* Product Thumbnail Container */
  .prod-img-wrapper {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 44px;
  }
  .prod-img-wrapper img {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    object-fit: cover;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }
  .prod-img-wrapper .photo-edit-overlay {
    position: absolute;
    bottom: -4px;
    right: -4px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    color: #2563eb;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .prod-price {
    font-weight: 700;
    color: #0f172a;
    font-size: 14.5px;
  }
  .view-pill {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    font-weight: 700;
    color: #475569;
    font-size: 12px;
  }
  /* Action Buttons */
  .btn-action-group {
    display: inline-flex;
    gap: 6px;
  }
  .btn-desc-view {
    background: #f1f5f9;
    color: #2563eb;
    border: 1px solid #dbeafe;
    border-radius: 6px;
    font-weight: 600;
    padding: 4px 10px;
  }
  .btn-desc-view:hover {
    background: #eff6ff;
    color: #1d4ed8;
  }
  .btn-tbl-edit {
    background: #f8fafc;
    color: #059669;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 10px;
    transition: all 0.2s ease;
  }
  .btn-tbl-edit:hover {
    background: #059669;
    color: #ffffff;
  }
  .btn-tbl-delete {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 10px;
    transition: all 0.2s ease;
  }
  .btn-tbl-delete:hover {
    background: #dc2626;
    color: #ffffff;
  }
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-top: 20px; padding-bottom: 15px;">
      <h1>
        <i class="fa fa-cubes" style="color: #2563eb; margin-right: 8px;"></i> Product Inventory
      </h1>
      <ol class="breadcrumb" style="padding-top: 8px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Product List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible' style='border-radius: 8px;'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible' style='border-radius: 8px;'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box product-box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-add-product" id="addproduct">
                <i class="fa fa-plus" style="margin-right: 5px;"></i> Add New Product
              </a>
              <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group" style="margin-bottom: 0;">
                    <label style="color: #64748b; font-weight: 600; margin-right: 8px;">Filter Category: </label>
                    <select class="form-control category-filter-select" id="select_category">
                      <option value="0">ALL CATEGORIES</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id'] == $catid) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id']."' ".$selected.">".htmlspecialchars($crow['name'])."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            
            <div class="box-body" style="padding: 20px;">
              <table id="example1" class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th width="75px">Photo</th>
                  <th width="100px" class="text-center">Description</th>
                  <th>Price</th>
                  <th class="text-center">Views Today</th>
                  <th class="text-center" width="160px">Actions</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM products $where");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        $counter = ($row['date_view'] == $now) ? $row['counter'] : 0;
                        echo "
                          <tr>
                            <td style='font-weight: 600; color: #1e293b;'>".htmlspecialchars($row['name'])."</td>
                            <td>
                              <div class='prod-img-wrapper'>
                                <img src='".$image."'>
                                <a href='#edit_photo' class='photo photo-edit-overlay' data-toggle='modal' data-id='".$row['id']."'>
                                  <i class='fa fa-pencil'></i>
                                </a>
                              </div>
                            </td>
                            <td align='center'>
                              <a href='#description' data-toggle='modal' class='btn btn-sm btn-desc-view desc' data-id='".$row['id']."'>
                                <i class='fa fa-file-text-o'></i> View
                              </a>
                            </td>
                            <td class='prod-price'>&#2547; ".number_format($row['price'], 2)."</td>
                            <td align='center'><span class='view-pill'><i class='fa fa-eye text-muted' style='margin-right: 4px;'></i> ".$counter."</span></td>
                            <td align='center'>
                              <div class='btn-action-group'>
                                <button class='btn btn-sm btn-tbl-edit edit' data-id='".$row['id']."'>
                                  <i class='fa fa-edit'></i> Edit
                                </button>
                                <button class='btn btn-sm btn-tbl-delete delete' data-id='".$row['id']."'>
                                  <i class='fa fa-trash'></i> Delete
                                </button>
                              </div>
                            </td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/products_modal.php'; ?>
  <?php include 'includes/products_modal2.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  // Edit product modal trigger
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Delete product modal trigger
  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Photo modal trigger
  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    $('#edit_photo').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  // Description view modal trigger
  $(document).on('click', '.desc', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  // Filter products by selected category
  $('#select_category').change(function(){
    var val = $(this).val();
    if(val == 0){
      window.location = 'products.php';
    }
    else{
      window.location = 'products.php?category='+val;
    }
  });

  // Load categories when opening Add Product modal
  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  // Clean appended items on modal close
  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

// Fetch product row details via AJAX
function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#desc').html(response.description);
      $('.name').html(response.prodname);
      $('.prodid').val(response.prodid);
      $('#edit_name').val(response.prodname);
      $('#catselected').val(response.category_id).html(response.catname);
      $('#edit_price').val(response.price);
      CKEDITOR.instances["editor2"].setData(response.description);
      getCategory();
    }
  });
}

// Fetch category list options for dropdown
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}
</script>
</body>
</html>