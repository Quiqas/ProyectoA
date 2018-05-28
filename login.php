 <?php
	session_start();

if (isset($_SESSION['user_id'])) {
    Header("index.html");
}else{
  if(isset($_POST['submit'])){

    include_once 'connection.php';


    $Password = mysqli_real_escape_string($connection, $_POST['Contraseña']);
    $Username = mysqli_real_escape_string($connection, $_POST['NoControl']);

    $sql = "SELECT * FROM usuarios WHERE Control = ?";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL Error";
    }else{
      mysqli_stmt_bind_param($stmt, "s", $Username);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $resultcheck = mysqli_num_rows($result);
    }

    if($resultcheck < 1){
        echo '<div class="col-md-3">
            <div class="box box-danger box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Error</h3>

                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" type="button" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                No se encontro el Usuario o el Email.
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>';
    }else{
      if ($row = mysqli_fetch_assoc($result)) {
          //Desencriptando Contraseña
          
              $_SESSION['user_id'] = $row['ID'];
              $_SESSION['user_nocontrol'] = $row['Control'];
             

              $connection->close();
              Header("Location: Maps.php");
              exit();
          }
      }
    }
  }


