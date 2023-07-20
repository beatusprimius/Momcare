<?php
// Establish a database connection
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
    $price = $_POST["price"];

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Insert new product into the database
        $sql = "INSERT INTO products (product_name, price, image) VALUES ('$name', $price, '$targetFile')";
        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the image.";
    }
}

// Delete product
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    // Delete product from the database
    $sql = "DELETE FROM products WHERE product_id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting the product.";
    }
}

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <script src="admin.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	 <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="button-logout">
        <a href="logout.php"><button>Log out</button></a>
    </div>
    <div class="admin">
        <!-- Add product to container -->
        <div id="add-product-container">
            <h2>Add New Product</h2>
            <form id="add-product-form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required><br>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required><br>
                <button type="submit">Add Product</button>
            </form>
        </div>

        <!-- Product container -->
        <div id="products-container">
            <h2>Product List</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td><img src='" . $row["image"] . "' width='100'></td>";
                            echo "<td><a href='admin.php?delete=" . $row["product_id"] . "'><button>Delete</button></a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

