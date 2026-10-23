<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for Category Management -->
<style>
  .content-header h1 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
  }
  .category-box {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    overflow: hidden;
  }
  .category-box .box-header {
    background: #ffffff;
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
  }
  .btn-add-category {
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
  .btn-add-category:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
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
    padding: 14px 16px;
  }
  #example1 tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    color: #334155;
    font-size: 14px;
  }
  #example1 tbody tr:hover {
    background-color: #f8fafc;
  }
  .category-name-badge {
    font-weight: 600;
    color: #1e293b;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }
  .category-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #eff6ff;
    color: #2563eb;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
  }
  /* Action Buttons */
  .btn-action-group {
    display: inline-flex;
    gap: 8px;
  }
  .btn-tbl-edit {
    background: #f8fafc;
    color: #059669;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 12px;
    transition: all 0.2s ease;
  }
  .btn-tbl-edit:hover {
    background: #059669;
    color: #ffffff;
    border-color: #059669;
  }
  .btn-tbl-delete {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 12px;
    transition: all 0.2s ease;
  }
  .btn-tbl-delete:hover {
    background: #dc2626;
    color: #ffffff;
    border-color: #dc2626;
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
        <i class="fa fa-tags" style="color: #2563eb; margin-right: 8px;"></i> Category Management
      </h1>
      <ol class="breadcrumb" style="padding-top: 8px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Products</li>
        <li class="active">Category</li>
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
          <div class="box category-box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-add-category">
                <i class="fa fa-plus" style="margin-right: 5px;"></i> Add New Category
              </a>
            </div>
            <div class="box-body" style="padding: 20px;">
              <table id="example1" class="table table-hover">
                <thead>
                  <th>Category Name</th>
                  <th class="text-center" width="180px">Tools</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM category");
                      $stmt->execute();
                      foreach($stmt as $row){
                        echo "
                          <tr>
                            <td>
                              <div class='category-name-badge'>
                                <span class='category-icon'><i class='fa fa-folder-open-o'></i></span>
                                <span>".htmlspecialchars($row['name'])."</span>
                              </div>
                            </td>
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
  <?php include 'includes/category_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'category_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
      $('#edit_name').val(response.name);
      $('.catname').html(response.name);
    }
  });
}
</script>
</body>
</html>