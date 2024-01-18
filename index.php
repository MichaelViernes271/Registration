<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php
            include("php/config.php");
            if(isset($_POST['submit'])){ 

                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                
                
                // sanitization and validation
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

                $mysql = "SELECT * FROM users WHERE Email='$email' AND Password='$password' ";
                $result = mysqli_query($con, $mysql) 
                or die("SELECT Error");
                $row = mysqli_fetch_assoc($result);
                
                if(is_array ($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
            }else{
                if(empty($_POST['email'])){
                    echo "<div class = 'message'>
                    <p>The following has occured: </p>
                    <ul>
                        <li>1. The input is a special character.</li>
                        <li>2. Bad Password Input.</li>
                    </ul>
                    
                    </div> <br>";
                    echo "<a href = 'index.php'><button class='btn'> Go Back</button>";       
                } else{
                    echo "<div class = 'message'>
                    <p>Wrong Username or Password</p>
                    </div> <br>";
                    echo "<a href = 'index.php'><button class='btn'> Go Back</button>";  
                }
                
            }
            if(isset($_SESSION['valid'])){
                header("Location: home.php");
            }
            }else{
            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" class="btn" id="submit">
                </div>

                <div class="links">
                    Don't have an account?
                    <a href="register.php">Sign up Now!</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>