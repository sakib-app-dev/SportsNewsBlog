<?php 
    $message='';
    session_start();

    if ($_SESSION['admin_id']==NULL){
        header('Location:index.php');
    }//Valid user ki_na chk korte
    if(isset($_GET['logout'])){
        require_once '../class/login.php';
        $login=new login;
        $login->admin_logout();
    }
    
    require_once '../class/blog.php';
    $blog=new Blog();
    
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
        $message=$blog->delete_blog_info($id);
    }
    
    if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    
}
$query_result=$blog->all_saved_info();
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">The Daily News Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
              <a class="nav-link" href="dashboard.php">DashBoard
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="Publishing_news_form.php">Publish News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="author.php">Authors</a>
          </li>
          <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
          <li class="nav-item">
            <a class="nav-link" href="#">Welcome <?php echo $_SESSION['admin_name'];?>-> LogOut</a>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
    
    <br/>

    <div class="container">  
        <div class="row">
            <div class="col-lg-12"> 
                <hr/>
                <h3 class="text-center text-success"><?php echo $message;?></h3>
                <hr/>
                <div class="well">
                    <table class="table table-bordered table-striped">
                        <tr>
                            
                            <th>Blog ID</th>
                            <th>Blog title</th>
                            <th>Image</th>
                            <th>Author Name</th>
                            <th>Discription</th>
                            <th>Publication Status</th>
                            <th>Action</th>
                        </tr>
                        <?php $i=1; while($blog_info= mysqli_fetch_assoc($query_result)){ ?>
                        <tr>
                            
                            <td><?php echo $blog_info['blog_id'];?></td>
                            <td><?php echo $blog_info['blog_title'];?></td>
                            <td><img src="<?php echo $blog_info['image'];?>"alt="300X700" class="img-responsive" style="" height="100px" width="150px"></td>
                            <td><?php echo $blog_info['author_name'];?></td>
                            <td><?php echo $blog_info['blog_discription'];?></td>
                            <td>
                                <?php if($blog_info['publication_status']==1){
                                    echo 'Published';
                                }else{
                                    echo 'Unpublished';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="edit_blog.php?id=<?php echo $blog_info['blog_id'];?>"class="btn btn-success" title="Edit">Edit</a>&nbsp
                                <a href="?delete=<?php echo $blog_info['blog_id'];?>"class="btn btn-danger" title="Delete" onclick="return confirm('Are You Sure ???');">Delete
                                <!--       onclick="return checkDelete(); --->
                                </a>    
                            </td>
                        </tr>
                        <?php } ?>
<!--ending Na hole sob jaygay  echo use korte hoto-->
                    </table>
                </div>
            </div>
            
        </div>
    </div>

      <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

