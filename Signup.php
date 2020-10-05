<html>
<body>
<?php
	if(isset($_POST["submit"]))
	{      		
            $acc_bal="10000";
            $cvv=rand(1000,9999);
    		$conn=mysqli_connect('localhost','root','','trendybucket') or die(mysqli_error());  
            $uname=mysqli_real_escape_string($conn, $_POST['name']); 
            $email=mysqli_real_escape_string($conn, $_POST['email']);
            $password=mysqli_real_escape_string($conn, $_POST['pwd']);
            $sql = "INSERT INTO user_details  VALUES ('".$uname."','".$email."','".$acc_bal."','".$password."','".$cvv."')";
            if ($result=mysqli_query($conn,$sql)) {
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["acc_bal"] = $acc_bal;
                    $_SESSION["name"] = $uname;
            ?>
                <script type="text/javascript">
                    alert("Your cvv is : <?php echo $cvv?>");
                    window.location.assign('index.html');
                </script>
            <?php
            }
            else
            {
                echo "Signup failed...";
                echo "Click  <a href='Signup.html'>here</a> to go back to signup page";
            }
    }  
    else
    {
        echo "connection failed ";
     }
?>
</body>
</html>