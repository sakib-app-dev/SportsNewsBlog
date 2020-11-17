<?php
    
    session_start();

    if ($_SESSION['admin_id']==NULL){
        header('Location:index.php');
    }//Valid user ki_na chk korte
        
    if(isset($_GET['logout'])){
        require_once '../class/login.php';
        $login=new login;
        $login->admin_logout();
    }
    
    $blog_id=$_GET['id'];
    
    require_once '../class/blog.php';
    $blog=new Blog();
    $query_result=$blog->select_blog_info_by_id($blog_id);
    $blog_info=mysqli_fetch_assoc($query_result);
    
    if(isset($_POST['btn'])){
        $blog->update_blog_info($_POST);
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Edit blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css" type="text/css">
  </head>

  <body>
    <hr/>
    <div align="center">
        <a href="dashboard.php">Add Blog </a> ||
        <a href="view_student.php"> Manage Blog</a> ||
        <a href="">Welcome <?php echo $_SESSION['admin_name'];?></a>--->>>
        <a href="?logout=logout"> LogOut</a>
    </div>
    <hr/>
    <br/>

    <div class="container">  
        <div class="row">
            <div class="col-lg-12">
                <hr/>
                <h3 class="text-center text-success"><?php //echo $msg;?></h3>
                <hr/>
                <div class="well">
                    <form action="" method="POST">
                      <div class="form-group">
                        <label>Blog id:</label>
                        <input type="text" name="blog_id" value="<?php echo $blog_info['blog_id'];?>" class="form-control"> 
                      </div>
                      <div class="form-group">
                        <label>blog_title:</label>
                        <input type="text" name="blog_title" value="<?php echo $blog_info['blog_title'];?>" class="form-control"> 
                      </div>
                      <div class="form-group">
                        <label>author_name:</label>
                        <input type="text" name="author_name" value="<?php echo $blog_info['author_name'];?>" class="form-control"> 
                      </div>
                      
                      <div class="form-group">
                        <label>blog_discription</label>
                        <textarea name="blog_discription" class="form-control"> <?php echo $blog_info['blog_discription'];?> </textarea> 
                      </div>
                      <div class="form-group">
                        <label>Publication status:</label>
                        <input type="number" name="publication_status" value="<?php echo $blog_info['publication_status'];?>" class="form-control"> 
                      </div>
                      
                      <div>
                        <button type="submit" name="btn" class="btn btn-success btn-block">Update blog Info</button>
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