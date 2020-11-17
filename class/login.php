<?php

class Login {
    protected $connection;
    public function __construct() {
        $hostname='localhost'; 
        $user_name='root';
        $password='';
        $db_name='prac_blog'; //Connection (Scheam/string)
        $this->connection=mysqli_connect($hostname,$user_name,$password,$db_name);
//        echo '<pre>';
//        print_r($connection);
//        exit();
       if(!$this->connection){
           die('Connection Fail'.mysqli_error($this->connection));
       } 
    }
    
    public function admin_login_check($data){
        $password=md5($data['password']);
        $sql="SELECT * FROM tbl_admin WHERE email_address='$data[email_address]' AND password='$password'; ";
        $query_result= mysqli_query($this->connection, $sql);
        $admin_info= mysqli_fetch_assoc($query_result);
//        echo '<pre>';
//        print_r($admin_info);
        if($admin_info){
            session_start();
            $_SESSION['admin_id']=$admin_info['admin_id'];
            $_SESSION['admin_name']=$admin_info['admin_name'];
            header('Location:dashboard.php');
        } else {
            $message="User email or passord are not valid";
            return $message;
            //header('Location:index.php');
        }
        
    }
    
    public function admin_logout(){
        //session_start();
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        header('Location:index.php');
        
    }
    

}

?>