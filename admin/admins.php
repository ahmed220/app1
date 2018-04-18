 <?php
require_once '../config/config.php';

      _header_admin('admin');

if(isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['re_password'])){
   $errors=[];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $re_password=$_POST['re_password'];
    
    if($re_password!==$password){
        $errors[]="password not match";
    }else{
        if(isset($_POST['id'])){
            $id=$_POST['id'];
            update($username ,$email ,$password,$id);
        }else{
              insert($username ,$email ,$password);
            header('location'.ADMIN_BASS.'admins.php');
            exit();
            }
    }
}
 if (isset($_GET['del'])) {

    if ($id = $_GET['del']) {
        delete($id);
        header('location:'.ADMIN_BASS.'admins.php');
        exit();
        //$_SERVER['PHP_SELF'] => page name
    }
}


    $users = getAll();
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Admins
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admins</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Admins Table</h3>
            </div>
            <div class="row">
              <div class="col-xs-8 col-xs-offset-2">
                  <?php if(isset($_GET['edit'])){ 
                     $user=getbyid($_GET['edit']);
                  ?>
         <form action="" method="post">
          <div class="modal-body">
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>"/>
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $user['username']; ?>"/>
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="email" value="<?php echo $user['email']; ?>"/> 
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="password" >
                </div>
              </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" name="re_password" placeholder="re_password">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="<?php echo ADMIN_BASS; ?>admins.php" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
    </form><?php }else {?>
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#add-new">
                  ADD NEW
                </button>
                  <?php } ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="table-courses" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                  <th>username</th>
                  <th>email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($users as $user){
                        ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                  <td><a href="<?php ADMIN_BASS; ?>?edit=<?php echo $user['id']; ?>" class="btn btn-info">Edit</a></td>
                    <td><a href="<?php ADMIN_BASS; ?>?del=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a></td>
                    
                </tr>
                     <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div class="control-sidebar-bg"></div>

  <div class="modal fade" id="add-new">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New course</h4>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="username">
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="email">
                </div>
              </div>

              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="password">
                </div>
              </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <input type="password" class="form-control" name="re_password" placeholder="re_password">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


<?php _footer_admin(); ?>