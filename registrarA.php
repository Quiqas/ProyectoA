<?php 

session_start();
// --------------------------------------------------------------------
//  Include header
// -------------------------------------------------------------------- 
if (isset($_SESSION['user_id'])) {
  Header("Location: index.html");
}else{
  if (isset($_POST['submit'])) {

    /* 
    Se incluye el archivo Connection para hacer conexion a la base de datos.
    */
    include_once 'connection.php';

    /* Almaceno los datos que son enviados del formulario en un arreglo.*/

    $datetime = date_create()->format('Y-m-d H:i:s');

    $Control = mysqli_real_escape_string($connection, $_POST['Control']);
    
    $Password = mysqli_real_escape_string($connection, $_POST['Pass']);

   
    
        $EncriptPass = password_hash($Password, PASSWORD_DEFAULT);
        //Almacenando los datos
        $sql = "INSERT INTO usuariosa (Control, Contraseña)  VALUES (?,?);";

        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "SQL Error 1";
        }else{
          mysqli_stmt_bind_param($stmt, "ss", $Control, $EncriptPass);
          mysqli_stmt_execute($stmt);
          echo mysqli_stmt_get_result($stmt);
          
        }
           
            
            $connection->close();
            Header("Location: Maps.php");
            exit();
          }
            

    }
  
