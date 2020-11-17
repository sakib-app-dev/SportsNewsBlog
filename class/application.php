<?php


class Application {
    protected $connection;
    public function __construct() {
        $hostname='localhost'; 
        $user_name='root';
        $password='';
        $db_name='prac_blog'; //Connection (Scheam/string)
        $this->connection=mysqli_connect($hostname,$user_name,$password,$db_name);
       if(!$this->connection){
           die('Connection Fail'.mysqli_error($this->connection));
       } 
    }
    
    public function allPublishedBlogInfo(){
        $sql="SELECT * FROM tbl_blog WHERE publication_status=1 ORDER BY blog_id DESC";
        if(mysqli_query($this->connection, $sql)){
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
    }
    
    public function selectBlogInfoById($blog_id){
        $sql="SELECT * FROM tbl_blog WHERE blog_id='$blog_id'";
        if(mysqli_query($this->connection, $sql)){
           $query_result= mysqli_query($this->connection, $sql);//Checking are query ok or not
           return $query_result;
           }else{
           die('Query Problem'.mysqli_error($this->connection));
       }
    }
    
        public function save_image_info() {
//        echo '<pre>';
//        print_r($_FILES);
//        exit();
        $image_name=$_FILES['img']['name'];//image er nam
        $directory='uploads/';           //kon folder e jabe
        $image_url=$directory.$image_name ; //kothay jabe
        $img_from=$_FILES['img']['tmp_name'];  // kotha theke astese
        $image_type=pathinfo($image_name,PATHINFO_EXTENSION);
        $image_size=$_FILES['img']['size'];
        $check=getimagesize($_FILES['img']['tmp_name']);
        
        if($check){
            if(file_exists($image_url)){
                die('The file is already exist');
            } else {
                if($image_size>500000){
                    die('File is tooo large');
                } else {
                    if($image_type!='jpg' && $image_type!='JPG' && $image_type!='png' && $image_type!='PNG'){
                        die('File type is not valid');
                    } else {
                        move_uploaded_file($img_from, $image_url);
                        $sql="INSERT INTO tbl_blog (img_name) VALUE ('$image_url')";
                        mysqli_query($this->connection, $sql);
                    }
                }
            }
        }
    }
    
    public function select_image_info(){
        $sql="SELECT * FROM tbl_blog";
        $query_result= mysqli_query($this->connection, $sql);
        return $query_result;
    }
}
