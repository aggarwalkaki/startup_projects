 <?php
require('db.php');
session_start();

//for login
if( isset($_POST['login'])){
    $query =  "SELECT * FROM `registerd_users` WHERE  `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";
   $result = mysqli_query($conn,$query);
   if($result){
      if(mysqli_num_rows($result)==1){
          $result_fetch = mysqli_fetch_assoc($result);
          if(password_verify($_POST['password'],$result_fetch['password'])){
            //    $_SESSION['logged_in']=true;
               $_SESSION['username']=$username;
               header("location:industry.php");
          }
          else{
            echo"
            <script>alert('password incorrect');
             window.location.href= 'division.html';
        
            </script>";
          }
      }
      else{
        echo"
        <script>alert('username or email not registered');
         window.location.href= 'division.html';
    
        </script>";
       
      }
   }
   else{
    echo"
        <script>alert('username already taken');
         window.location.href= 'division.html';
    
        </script>";
       
   }
}

// for registration
if( isset($_POST['register'])){
    $user_exist_query =  "SELECT * FROM `registerd_users` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]'";
   $result =  mysqli_query($conn,$user_exist_query);

   if($result){
    if(mysqli_num_rows($result)>0){
       $result_fetch = mysqli_fetch_assoc($result);
       if($result_fetch['username']==$_POST['username']){
        echo"
        <script>alert('username already taken');
         window.location.href= 'division.html';
    
        </script>";
       }
       else{
        echo"
        <script>alert('email already registered');
         window.location.href= 'division.html';
    
        </script>";
       }
    }
    else{
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $query = "INSERT INTO `registerd_users`(`full_name`,`username`,`email`,`password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";
        if(mysqli_query($conn,$query)){
            echo"
            <script>alert('registration successful');
            window.location.href= 'division.html';
            
            </script>";

        }
        else{
            echo"
            <script>alert('cannot run query');
            window.location.href= 'division.html';
            
            </script>";
        }
    }
   }
   else{
    echo"
    <script>alert('cannot run query');
    window.location.href= 'division.html';
    
    </script>";
   }
}


?> 

