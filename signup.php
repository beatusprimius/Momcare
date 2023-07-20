
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "momcare";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new product
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $city = $_POST["city"];
    $pass = $_POST["password"];
    



    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "INSERT INTO customer (name, email, mobile, city, password) values ('$name', '$email', '$mobile', '$city', '$pass')";
    mysqli_query($conn, $sql);

}



?>
