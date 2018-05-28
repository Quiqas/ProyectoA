<?php
	session_start();

if (isset($_SESSION['user_id'])) {
    Header("index.html");
}else{
  if(isset($_POST['submit'])){

    include_once 'connection.php';


    $Password = mysqli_real_escape_string($connection, $_POST['Password']);
    $Username = mysqli_real_escape_string($connection, $_POST['Username']);

    $sql = "SELECT * FROM usuarios WHERE user_nickname = ? OR user_email = ?";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL Error";
    }else{
      mysqli_stmt_bind_param($stmt, "ss", $Username, $Email);
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
          $decriptpass = password_verify($Password, $row['user_password']);
          if (!$decriptpass) {
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
                La contraseña no coincide con el nombre de usuario o email.
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>';
          }elseif ($decriptpass){
              //Log in
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['user_name'] = $row['user_name'];
              $_SESSION['user_email'] = $row['user_email'];
              $_SESSION['user_nickname'] = $row['user_nickname'];
              $_SESSION['user_age'] = $row['user_age'];
              $_SESSION['user_date'] = $row['user_date_register'];
              $_SESSION['user_type'] = $row['user_type'];
              $_SESSION['user_university'] = $row['user_university'];
              $_SESSION['user_career'] = $row['user_career'];
              $_SESSION['user_notes'] = $row['user_notes'];
              $_SESSION['Seguidos'] = $row['Seguidos'];
              $_SESSION['Seguidores'] = $row['Seguidores'];
              $_SESSION['user_location'] = $row['user_location'];

              $connection->close();
              Header("Location: /modelo/home");
              exit();
          }
      }
    }
  }
}

