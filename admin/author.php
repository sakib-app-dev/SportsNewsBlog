<?php
session_start();

if ($_SESSION['admin_id'] == NULL) {
    header('Location:index.php');
}//Valid user ki_na chk korte


if (isset($_GET['logout'])) {
    require_once '../class/login.php';
    $login = new login;
    $login->admin_logout();
}//use for log_out

require_once '../class/blog.php';
    $blog=new Blog();
    
    $query_result=$blog->all_author_info();


?>
<!doctype html>
<html lang="en">
    <head>
        <title>View Student</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">

    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-warning fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">The Daily News Blog</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">DashBoard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Publishing_news_form.php">Publish News</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="author.php">Authors
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Welcome <?php echo $_SESSION['admin_name']; ?>-> LogOut</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-top: 10px;padding-top: 100px">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <table class="table table-bordered table-striped">
                        <tr>
                            
                            <th>Author ID</th>
                            <th>Author Name</th>
                            <th>Phone No</th>
                            <th>Email Address</th>
                        </tr>
                        <?php $i=1; while($blog_info= mysqli_fetch_assoc($query_result)){ ?>
                        <tr>
                            
                            <td><?php echo $blog_info['admin_id'];?></td>
                            <td><?php echo $blog_info['admin_name'];?></td>
                            <td><?php echo $blog_info['phone_no'];?></td>
                            <td><?php echo $blog_info['email_address'];?></td>
                            
                            
                            
                        </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
            
        </div>
    </body>
</html>