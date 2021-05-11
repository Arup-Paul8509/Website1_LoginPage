<?php
    /*Receiving data from user */
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['createpassword'];
    /*Initialization of Database*/
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="db";
    /*Connection Database*/
    $conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
    /*checking connection*/
    if(mysqli_connect_error())
    {
        die("Connection error : (".mysqli_connect_errno().")".mysqli_connection_error());
    }
    else
    {
        $SELECT="SELECT email from user_info where email=? limit 1";//query to check existing email
        $INSERT="INSERT Into user_info (name,email,password) values(?,?,?)";//query to insert record
        /*checking for existing email */
        $stmt=$conn->prepare($SELECT);//prepare statement
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $num_row=$stmt->num_rows;
        if($num_row==0)//selected email is not exist
        {
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("sss",$name,$email,$password);
            $stmt->execute();
            echo '<script type="text/javascript">
                alert("Your account has been created successfully, now you can sign in ...");
                window.history.back();
            </script>';
        }
        else//selected email already existed
        {
            echo '<script>
                alert("This email address already exists !");
                window.history.back();
            </script>';
        }
        $stmt->close();
        $conn->close();
    }
?>