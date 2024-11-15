<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Add a Product</h1>
            
            <!-- Product Form -->
            <form id="productForm" method="POST" enctype="multipart/form-data">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" name="productPrice" required>

                <label for="productDescription">Description:</label>
                <textarea id="productDescription" name="productDescription" required></textarea>

                <label for="productImage">Attach Image:</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <button type="submit" name="addProduct">Add Product</button>
            </form>
        </div>

        <!-- Product List -->
        <div class="product-list-container">
            <h2>Product List</h2>
            <div id="productList">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'midterm');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Handle form submission and add product to database
                if (isset($_POST['addProduct'])) {
                    $productName = $_POST['productName'];
                    $productPrice = $_POST['productPrice'];
                    $productDescription = $_POST['productDescription'];
                    $productImage = $_FILES['productImage']['name'];
                    $targetDir = "uploads/";
                    $targetFile = $targetDir . basename($productImage);

                    // Ensure the uploads directory exists
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }

                    // Move uploaded file and insert product into database
                    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $targetFile)) {
                        $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("sdss", $productName, $productPrice, $productDescription, $productImage);

                        if ($stmt->execute()) {
                            echo "<script>alert('Product added successfully!');</script>";
                        } else {
                            echo "<script>alert('Error adding product.');</script>";
                        }

                        $stmt->close();
                    } else {
                        echo "<script>alert('Failed to upload image.');</script>";
                    }
                }

                // Fetch and display products from the database
                $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product-item'>";
                        echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                        echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                        echo "<p>Price: $" . number_format($row['price'], 2) . "</p>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products added yet.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
