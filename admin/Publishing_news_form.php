<?php
session_start();

    if ($_SESSION['admin_id']==NULL){
        header('Location:index.php');
    }
        
        
    if(isset($_GET['logout'])){
        require_once '../class/login.php';
        $login=new login;
        $login->admin_logout();
    }
$msg='';
if(isset($_POST['btn'])){
    require_once '../class/blog.php';
    $blog=new Blog();
    $msg=$blog->save_blog_info($_POST);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>DashBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
  </head>

  <body>
    <hr/>
    <div align="center">
        <a href="dashboard.php">Dash Board </a> ||
        <a href="">Welcome <?php echo $_SESSION['admin_name'];?></a>--->>>
        <a href="?logout=logout"> LogOut</a>
    </div>
    <hr/>
    <br/>

    <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
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
          <li class="nav-item active">
            <a class="nav-link" href="#">Publish News
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="author.php">Authors</a>
          </li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          <li class="nav-item">
            <a href="?logout=logout" class="nav-link">Welcome <?php echo $_SESSION['admin_name'];?>-> LogOut</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
    <div class="container">  
        <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12 text-center" style="font-family: cursive; font-size: 24px;color: white; background: #d9534f;padding: 15px">Publishing News Form</div>
                
                <h3 class="text-center text-success"><?php echo $msg;?></h3>
                
                <div class="well">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>News Title:</label>
                        <input type="text" name="news_title" class="form-control" placeholder="Enter News title..."> 
                        <input type="hidden" name="author_name" class="form-control" value="<?php echo $_SESSION['admin_name'];?>"> 
                      </div>
                      
                      <div class="form-group">
                        <label>Image:</label>
                        <input type="file" name="img"  accept="image/*" class="form-control" placeholder="Enter Author name.." > 
                      </div>
                      <div class="form-group">
                        <label>Details News:</label>
                        <textarea name="details_news" class="form-control" placeholder="Enter about the details of news..... " rows="4"></textarea> 
                      </div>
                      <div class="form-group">
                        <label>Publication Status:</label>
                        
                        <select class="form-control" name="publication_status">
                            <option selected="" disabled="">---Select Publication Status--</option>
                            <option value="1">Published</option>
                            <option value="0">Unpublished</option>
                        </select>
                        
                      </div>
                        
                      <div class="">
                        <button type="submit" name="btn" class="btn btn-danger btn-block">Upload News</button>
                      </div>
                    </form> 
                </div>
            </div>
            
        </div>
    </div>

      <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>