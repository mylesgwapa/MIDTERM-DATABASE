<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalogue</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>
    <div class="container">
        <h1>Product Catalogue</h1>

        <div class="product-grid">
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'midterm');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch and display products from the database
            $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' class='product-image'>";
                    echo "<h3 class='product-name'>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p class='product-price'>Price: $" . number_format($row['price'], 2) . "</p>";
                    echo "<p class='product-description'>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<button class='add-to-cart'>Add to Cart</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products available at the moment.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
