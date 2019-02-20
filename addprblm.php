<?php 
session_start();
if(isset($_SESSION['id'])){
                           if(!empty(isset($_POST['add_prblm']))){
                               define('DB_SERVER', 'localhost');
                               define('DB_USERNAME', 'root');
                               define('DB_PASSWORD', '');
                               define('DB_DATABASE', 'test');
                               $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
                               if (mysqli_connect_errno()){
                                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                               }
                            $title=$_POST['title'];
                            $type=$_POST['type'];
                            $desc=$_POST['desc'];
                            $owner=$_SESSION['name'];
                            $date = date("Y-m-d"); 
                            echo $date;
                            $sql = "INSERT INTO problem (type, title, description, owner, date) VALUES ('$type', '$title', '$desc','$owner', '$date')";

                            if (mysqli_query($db, $sql)) {
                                header("Location: index.php");
                            } 
                            else {
                                    echo "Failed";
                                }
                           }

?>
<html>
    <head>
        <title>Profile Page</title>
    </head>
    <body>
        <h3>Welcome<?php echo $_SESSION['name'];?></h3>
        <h4>Add Problem</h4>
        <center>
            <form action = "" method = "post">
                Enter Problem Title: <input type= "text" name = "title" placeholder="Title"><br>
                Select Problem Type: <select name="type">
                                        <option value="Financial">Financial Support</option>
                                        <option value="Knowledge">Knowledge Support</option>
                                        <option value="Both">Both</option>
                                    </select><br>
                Enter Problem Description: <input type= "text" name = "desc" placeholder="Description">
                <input type="submit" value="Submit" name="add_prblm">
            </form>
        </center>
    </body>
</html>

<?php }
else {
    header("Location: index.php");
}
?>