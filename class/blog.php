<?php

class Blog {
    protected $connection;
    public function __construct() {
        $hostname='localhost'; 
        $user_name='root';
        $password='';
        $db_name='prac_blog';
        $this->connection=mysqli_connect($hostname,$user_name,$password,$db_name);

       if(!$this->connection){
           die('Connection Fail'.mysqli_error($this->connection));
       } 
    }
    
    
            // -----Information Add Korte----
    
    public function save_blog_info($data){
//    
         $image_name = $_FILES['img']['name']; //image er nam
            $directory = '../upload_Images/';           //kon folder e jabe
            $image_url = $directory . $image_name; //kothay jabe
            $img_from = $_FILES['img']['tmp_name'];  // kotha theke astese
            $image_type = pathinfo($image_name, PATHINFO_EXTENSION);
            
            $image_size = $_FILES['img']['size'];
            /* @var $check type */
            $check=$_FILES['img']['tmp_name'];           
            if ($check) {            
                if ($image_size > 500000) {
                    die('File is tooo large');
                } else {
                    if ($image_type != 'jpg' && $image_type != 'JPG' && $image_type != 'png' && $image_type != 'PNG') {
                        die('File type is not valid');
                    } else {      
                        move_uploaded_file($img_from, $image_url);                      
                    }
                }
            }
//            echo '<pre>';
//            print_r($check);
//            exit();
      $sql="INSERT INTO tbl_blog(blog_title,image,author_name,blog_discription,publication_status) "
               . "VALUES('$data[news_title]','$image_url','$data[author_name]','$data[details_news]','$data[publication_status]')";
       
       if(mysqli_query($this->connection, $sql)){   //like Go button of DB
           $msg="Saved Successfully";
           return $msg;
    } else {
        die("Query Problem".mysqli_error($this->connection));
    }
}


            //--------Information View Korte-----

    public function all_saved_info(){
    $sql="SELECT*FROM tbl_blog ORDER BY blog_id DESC";
       //Quary Execute
       if(mysqli_query($this->connection, $sql)){
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
       
    }
    
    
            //---Information edit Korar jonno Info gula Field e Show korte---
    
    public function select_blog_info_by_id($blog_id){            //copy upor ta thaikka
        $sql="SELECT*FROM tbl_blog WHERE blog_id='$blog_id'";
       if(mysqli_query($this->connection, $sql)){
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           
       }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
    }
    
            //----Information Update kore Save korar Jonno----
    public function update_Blog_info($data){
        
        $sql="UPDATE tbl_blog SET blog_title='$data[blog_title]',author_name='$data[author_name]',blog_discription='$data[blog_discription]',publication_status='$data[publication_status]' WHERE blog_id='$data[blog_id]'";
        
        if(mysqli_query($this->connection, $sql)){
           session_start();
           $_SESSION['message']='Update Sucessfully'; 
           header('Location:dashboard.php'); //action e link deya hoyse
           
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           
           
       }else{
           die('Query Problem'.mysqli_error($this->connection));
       } 
    }
    
    
            //---Information Delete Korar Jonno---
    public function delete_blog_info($id){
        $sql="DELETE FROM tbl_blog WHERE blog_id='$id'";
        if(mysqli_query($this->connection, $sql)){
           
           $message='Delete Sucessfully'; 
           return $message;
           
       }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
    }
    
    public function all_author_info(){
    $sql="SELECT*FROM tbl_admin";
       //Quary Execute
       if(mysqli_query($this->connection, $sql)){
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
       
    }
    

}
