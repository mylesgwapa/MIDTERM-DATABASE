<?php
// Database connection details
$host = 'localhost';  // Your database host
$dbname = 'midterm';  // Your database name
$username = 'root';   // Your database username
$password = '';       // Your database password

try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to fetch all products from the products table
    $productStmt = $pdo->query("SELECT * FROM products");

    // Fetch all product records into an associative array
    $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <!-- Add CSS for table styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1{
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>RIGHT JOIN</h1>

    <!-- Table to display product information -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the fetched products and display them in the table
            foreach ($products as $product) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($product['id']) . "</td>";
                echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                echo "<td>" . htmlspecialchars($product['price']) . "</td>";
                echo "<td>" . htmlspecialchars($product['description']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($product['image']) . "' alt='Product Image' width='50'></td>";
                echo "<td>" . htmlspecialchars($product['created_at']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
