<?php

// Start session 
session_start();

// Include database connection details
require_once 'config.php';

// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  // Get form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // Validate credentials with database
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) > 0){

    // Set session variables
    $_SESSION['user_id'] = $row['id'];//mark user_id
    $_SESSION['username'] = $row['username'];

    // Redirect to homepage
    header('Location: products.html');
    exit;

  } else {
    $error = "Invalid username or password.";
  }

}

?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <script src="menu.js" async></script>

    <title>MomCare</title>

    <!--fontawesome cdn-->
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">


<link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

        <header>
        <div class="topnav" id="myTopnav">
                <a href="index.html" class="active">Home</a>
                <a href="about.html">About</a>
                <a href="products.html">Products</a>
                <a href="contact.html">Contact</a>
                <a href="login.php">Account</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <img src="img/menu-01.png">
                </a>
              </div> 
        </header>

<!------Login page--------->
<div class="login-page">
<div class="user_admin_button">
        <a href="user_login.php"><button>Users</button></a>
        <a href="login.php"><button>Admin</button></a>
    </div>
    <div class="form">
        <div class="login">
            <div class="login-header">
                <h3>USER LOGIN</h3>
                <p>Please enter your credentials to log in</p>
            </div>
        </div>
        <form action="user_login.php" method="POST" autocomplete="off" class="login-form">
            <input type="text" name="username" id="usernameemail" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <input type="submit" value="Login">  
        </form>
        <p>Do you have an account? please <a href="signup.html">register here</a></p>
    </div>
</div>

<!-- Subscription -->
<div id="newsletter" >
    <div class="newstext">
        <h4>Sign Up For Newsletter</h4>
        <p>Get E-mail updates about our latest shop and <span> special offers</span></p>
    </div>
    <div class="form-newsletter">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
    </div>
</div>

<!----Footer-->
<div class="footer">
    <div class="colums">
        <div class="colum1">
            <h3 id="footer-title">Useful links</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="account.html">Account</a></li>
            </ul>1
        </div>
        <div class="colum2">
            <h3 id="footer-title">Social networks</h3>
            <p class="social-text">For a glimpse into our world and to stay connected, follow us on social media!</p>
            <div class="social">
                <a href="https://m.facebook.com/momcare.sasa?wtsid=rdr_0gZEfBA4q7wb3lpWJ"><img src="img/facebook.png"></a> 
                <a href="https://instagram.com/momcaregroup?igshid=NTc4MTIwNjQ2YQ=="><img src="img/instagram.png"></a>
                <a href="https://wa.link/qo2988"><img src="img/whatsapp.png"></a>
            </div>
        </div>
        <div class="colum3">
            <h3 id="footer-title">Contact us</h3>
            <form action="process_form.php" class="footer-form" method="POST">
                <input type="email" name="email" id="email" placeholder="Enter your email" required><br>
                <textarea name="message" id="message" placeholder="Write something..." style="height: 100px;" required></textarea><br>
                <input type="submit" value="Submit">
            </form>           
        </div>
    </div>
    <div class="footer-bottom">
        &copy; momcare.com | Designed by Beatus Kamugisha
    </div>
</div>  
</body>
</html>
<!-- Display error if any -->
<?php if(isset($error)) { echo $error; } ?>
