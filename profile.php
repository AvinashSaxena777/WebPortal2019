<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'test');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_POST['btn_register'])){
	    $name=$_POST['name'];
        $password=$_POST['password'];
        $emailid=$_POST['emailid'];
        
        $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$emailid', '$password')";

        if (mysqli_query($db, $sql)) {
            header("Location: index.php");
        } 
        else {
                header("Location: index.php");
            }
        
    
}

if(isset($_POST['login_btn']))
			{
				$emailid=mysqli_real_escape_string($db,$_POST['emailid']);
				$password=mysqli_real_escape_string($db,$_POST['password']);
				$query = "select * from user where email='$emailid' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($db,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['email'] = $emailid;
					$_SESSION['password'] = $password;
                    $_SESSION['name']= $row['name'];
                    $_SESSION['id']=$row['id'];
                        
                    $id = $_SESSION['id'];
                    }
                }
            }
    if(isset($_POST['logout_btn'])){
        session_destroy();
        header( "Location: index.php");
    }
    
?>


<html>
    <head>
        <title>Profile Page</title>
    </head>
    <body>
        <h3>Welcome<?php echo $_SESSION['name'];?></h3>
        <a href="addprblm.php">Add Problem</a>
    </body>
</html>