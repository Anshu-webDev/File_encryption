<?php

if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pswd'];

    include 'conn.php';

    echo $name;
    echo $email;
    echo $pass;
 
    $select = mysqli_query($conn, "SELECT email FROM data WHERE email = '".$email."'") or exit(mysqli_error($conn));
    if(mysqli_num_rows($select)) 
    {
        exit('This email is already being used');
    }
    else
    {   
        $pass=md5($pass);
        $query = "INSERT INTO data (username, email, password) VALUES ('".mysqli_real_escape_string($conn,$name )."','".mysqli_real_escape_string($conn, $email)."','".mysqli_real_escape_string($conn, $pass)."')";
        $result = mysqli_query($conn, $query);
        if($result){  
            session_start();
            $_SESSION['username'] = $name;
            echo "<script>alert('Registered Successfully');
                        window.location = 'data.php';
                    </script> ";
        } else{
            echo "<script>alert('Failed!');
                        window.location = 'index.php';
                </script> ";	
        }          
              
    }


}
echo "not submitted";
?>