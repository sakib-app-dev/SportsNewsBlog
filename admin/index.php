<?php

    session_start();
    $message='';
    if (isset($_SESSION['admin_id'])) {
        if ($_SESSION['admin_id']!=NULL) {
            header('Location:dashboard.php');
        }
    }

    if (isset($_POST['btn'])) {
        require_once '../class/login.php';
        $login = new Login();
        $message=$login->admin_login_check($_POST);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Admin panel log in</title>
    <style type="text/css">
      .serif {
      font-family: "Times New Roman", Times, serif;
      }
    </style>

    <link href="../asset/css/bootstrap.min.css" rel="stylesheet">
    
  </head>

  <body>
      <div class="container">
        
          <div class="row justify-content-center" >
              <div class="col-md-12">
                  <div style="margin-top:5px;  padding: 40px; font-size:55px; color: yellow;background-color: #5cb85c;"class="text-center serif">
                      <b>Daily News Blog</b><br/><b style="font-size: 30px; margin:">(Admin Panel)</b>
                  </div>
              </div>
              
              <div class="col-md-8" style="border-style:solid; margin: 10px; padding: 0px 80px 0px 80px">
                  <div class="well" style="margin-top: 36px; padding-bottom: 35px;">
                      <h3 class="text-center text-success"><strong>Admin Log In</strong></h3>
                      <h2 class="text-danger text-center"> <?php echo $message;?> </h2>
                      <form class="form-horizontal" action="" method="POST">
                          <div class="form-group">
                              <label class=" col-md-12">Email :</label>
                              <div class="col-md-12">
                                  <input type="email" name="email_address" required="" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class=" col-md-12">Password :</label>
                              <div class="col-md-12">
                                  <input type="password" name="password" required="" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-md-12">
                                  <input type="submit" name="btn" required="" class="btn btn-success btn-block">
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
        <script src="../asset/js/bootstrap.min.js"></script>
    
  </body>
</html>
