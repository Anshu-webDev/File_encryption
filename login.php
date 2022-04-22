<?php

    include 'conn.php';
    if(isset($_POST['submit'])){
        $pass = $_POST['pswd'];
        $email = $_POST['email'];
        
        $sql = "select * from data where email = '$email'";

        $result = mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result); 
        
        if($rows == 0){
            echo "<script>alert('This email is not registerd with us please signup first');
                    window.location = 'Login customer/index.html';
                </script>";
        }else{

            $pass = md5($pass);
            $sql2 = "SELECT * from data where email='".$email."' AND password='".$pass."'";

            $result2 = mysqli_query($conn, $sql2);
            $numrows=mysqli_num_rows($result2); 

            if($numrows != 0){
                while($i=mysqli_fetch_assoc($result2)){
                    $un= $i['username'];
                    session_start();
                    $_SESSION['username'] = $un;
                }
                
                echo "<script>alert('Successfully Login')
                            window.location = 'data.php';
                    </script>";
            }else{
                echo "<script>alert('Login Failed')
                        window.location = 'index.php';
                    </script>";
            }


        }



        
    }


?>