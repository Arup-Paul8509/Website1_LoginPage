<?php
    $email=$_POST['email'];
    $password=$_POST['password'];
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="db";
    $conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error())
    {
        die("Connection Error : (".mysqli_connect_errno().")".mysqli_connect_error());
    }
    else
    {
        $SELECT="SELECT email,password from user_info where email=? and password=?";
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("ss",$email,$password);
        $stmt->execute();
        $stmt->bind_result($email,$password);
        $stmt->store_result();
        $num_row=$stmt->num_rows;
        if($num_row==0)
        {
            echo'<script>
                alert("Invalid email id or password ! Try again...");
            </script>
            ';
            echo'
                <script>window.history.back();</script>
            ';
        }
        else
        {
            echo'
                    <h1>Welcome</h1>
            '.$email;
        }
        $stmt->close();
        $conn->close();
    }
?>