<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST["submit"])){
        $conn=mysqli_connect('localhost','root','','trendybucket') or die(mysqli_error());
        $username=mysqli_real_escape_string($conn, $_POST['email']);
        $password=mysqli_real_escape_string($conn, $_POST['pwd']);
        $sql = "SELECT * FROM user_details WHERE Email = '$username' and Password = '$password'";
        if ($result=mysqli_query($conn,$sql))
        {
            session_start();
            $_SESSION["email"] = $email;
            while($row=mysqli_fetch_array($result))
            {
                $_SESSION["name"]=$row['Name'];
                echo $row["Name"];
            }
            header("location:index.php");
        }
        else
            {
                echo "Login failed...";
                echo "Click  <a href='login.html'>here</a> to go back to signup page";
            }

        }
        else
        {
            echo "fail";
        }
    ?>
</body>
</html>

