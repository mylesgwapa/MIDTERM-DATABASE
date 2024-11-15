<?php
session_start();
$host = 'localhost'; // Update with your database host
$dbname = 'midterm'; // Update with your database name
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action === 'register') {
        // Registration logic
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, email, phone, address, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$firstName, $lastName, $username, $email, $phone, $address, $gender, $password])) {
            echo "Registration successful!";
        } else {
            echo "Registration failed.";
        }
    } elseif ($action === 'login') {
        // Login logic
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: landpage.html");
            exit;
        } else {
            echo "Login failed.";
        }
    }
}
?>
