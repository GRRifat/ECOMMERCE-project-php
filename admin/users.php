<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Custom Modern Styles for User Management -->
<style>
  .content-header h1 {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
  }
  .user-box {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    background: #ffffff;
    overflow: hidden;
  }
  .user-box .box-header {
    background: #ffffff;
    padding: 18px 22px;
    border-bottom: 1px solid #f1f5f9;
  }
  .btn-add-user {
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
  .btn-add-user:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
  }
  /* Modern Clean Table */
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
    padding: 14px 14px;
  }
  #example1 tbody td {
    padding: 14px 14px;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
    color: #334155;
    font-size: 14px;
  }
  #example1 tbody tr:hover {
    background-color: #f8fafc;
  }
  /* Avatar & Edit Bubble */
  .user-avatar-wrap {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 42px;
  }
  .user-avatar-wrap img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
  }
  .user-avatar-wrap .avatar-edit-overlay {
    position: absolute;
    bottom: -2px;
    right: -2px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    color: #2563eb;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  }
  /* Status Badges */
  .badge-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
  }
  .status-active {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
  }
  .status-unverified {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
  }
  .status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
  }
  .status-active .status-dot { background: #10b981; }
  .status-unverified .status-dot { background: #ef4444; }
  .btn-activate-trigger {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 6px;
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
    margin-left: 6px;
    transition: all 0.2s;
  }
  .btn-activate-trigger:hover {
    background: #059669;
    color: #ffffff;
  }
  /* Actions */
  .btn-action-group {
    display: inline-flex;
    gap: 6px;
  }
  .btn-tbl-cart {
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 10px;
  }
  .btn-tbl-cart:hover {
    background: #2563eb;
    color: #ffffff;
  }
  .btn-tbl-edit {
    background: #f8fafc;
    color: #059669;
    border: 1px solid #a7f3d0;
    border-radius: 6px;
    font-weight: 600;
    padding: 5px 10px;
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
        <i class="fa fa-users" style="color: #2563eb; margin-right: 8px;"></i> Customer Accounts
      </h1>
      <ol class="breadcrumb" style="padding-top: 8px;">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
          <div class="box user-box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-add-user">
                <i class="fa fa-user-plus" style="margin-right: 5px;"></i> Add New Customer
              </a>
            </div>

            <div class="box-body" style="padding: 20px;">
              <table id="example1" class="table table-hover">
                <thead>
                  <th width="65px" class="text-center">Avatar</th>
                  <th>Customer Name</th>
                  <th>Email Address</th>
                  <th>Account Status</th>
                  <th>Date Joined</th>
                  <th class="text-center" width="210px">Actions</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT * FROM users WHERE type=:type ORDER BY created_on DESC");
                      $stmt->execute(['type'=>0]);
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                        
                        $status_badge = ($row['status']) 
                          ? '<span class="badge-status status-active"><span class="status-dot"></span> Active</span>' 
                          : '<span class="badge-status status-unverified"><span class="status-dot"></span> Unverified</span>';

                        $active_action = (!$row['status']) 
                          ? '<a href="#activate" class="status btn-activate-trigger" data-toggle="modal" data-id="'.$row['id'].'" title="Verify Account"><i class="fa fa-check"></i></a>' 
                          : '';

                        echo "
                          <tr>
                            <td align='center'>
                              <div class='user-avatar-wrap'>
                                <img src='".$image."'>
                                <a href='#edit_photo' class='photo avatar-edit-overlay' data-toggle='modal' data-id='".$row['id']."' title='Change Photo'>
                                  <i class='fa fa-pencil'></i>
                                </a>
                              </div>
                            </td>
                            <td style='font-weight: 600; color: #1e293b;'>".htmlspecialchars($row['firstname'].' '.$row['lastname'])."</td>
                            <td style='color: #475569;'>".htmlspecialchars($row['email'])."</td>
                            <td>
                              <div style='display: inline-flex; align-items: center;'>
                                ".$status_badge."
                                ".$active_action."
                              </div>
                            </td>
                            <td style='color: #64748b; font-size: 13px;'>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td align='center'>
                              <div class='btn-action-group'>
                                <a href='cart.php?user=".$row['id']."' class='btn btn-sm btn-tbl-cart' title='View Cart'>
                                  <i class='fa fa-shopping-cart'></i> Cart
                                </a>
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
  <?php include 'includes/users_modal.php'; ?>

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

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    $('#edit_photo').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    $('#activate').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
</body>
</html>