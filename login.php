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
            if(mysqli_num_rows($result)==1)
            {
            session_start();
            $_SESSION["email"] = $username;
            setcookie("email",$username);
            while($row=mysqli_fetch_array($result))
                {
                    $_SESSION["name"]=$row['Name'];
                }
            header("location:index.php");
            }
            else
            {
                echo "User not found, Please head <a href='index.html'>here</a> and sign up";
            }
        }
        else
            {
                echo "Login failed...";
                echo "Click  <a href='index.html'>here</a> to go to home page";
            }

        }
        else
        {
            echo "fail";
        }
    ?>
</body>
</html>

