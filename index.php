<?php
session_start();
$host = 'localhost';
$dbname = 'midterm';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Registration and Login Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sign-up'])) {
        // Register User
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // Corrected the number of placeholders in the INSERT statement
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, email, phone, address, password) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$firstName, $lastName, $username, $email, $phone, $address, $password])) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "<script>alert('Registration failed.');</script>";
        }
    }

    if (isset($_POST['sign-in'])) {
        // Login User
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: landpage.php");
            exit;
        } else {
            echo "<script>alert('Invalid login credentials.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Login & Signup</title>
</head>
<body>
    <div class="cont">
        <!-- Sign-in Form -->
        <form class="form sign-in" method="POST">
            <h2>Welcome!</h2>
            <p class="slogan">"Your Partner for Profitable Checkouts!"</p>
            <label>
                <span>Username</span>
                <div class="input-container">
                    <input type="text" name="username" placeholder="Enter your username" required />
                    <i class="fas fa-user username-icon"></i>
                </div>
            </label>
            <label>
                <span>Password</span>
                <div class="input-container">
                    <input type="password" name="password" id="password" placeholder="Enter your password" required />
                    <i class="fas fa-eye-slash toggle-password" onclick="togglePassword()"></i>
                </div>
            </label>
            <p class="forgot-pass">Forgot password?</p>
            <button type="submit" name="sign-in" class="submit" id="submit-button">LOGIN</button>
        </form>

        <!-- Sign-up Form -->
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h3>Don't have an account? Please Sign up!</h3>
                </div>
                <div class="img__text m--in">
                    <h3>If you already have an account, just sign in.</h3>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Sign In</span>
                </div>
            </div>
            <form class="form sign-up" method="POST">
                <h2>Create your Account</h2>
                <label>
                    <span>First Name</span>
                    <input type="text" name="firstName" placeholder="Enter your first name" required />
                </label>
                <label>
                    <span>Last Name</span>
                    <input type="text" name="lastName" placeholder="Enter your last name" required />
                </label>
                <label>
                    <span>Username</span>
                    <div class="input-container">
                        <input type="text" name="username" placeholder="Enter your username" required />
                        <i class="fas fa-user username-icon"></i>
                    </div>
                </label>
                <label>
                    <span>Email</span>
                    <div class="input-container">
                        <input type="email" name="email" placeholder="Enter your email" required />
                        <i class="fas fa-envelope email-icon"></i>
                    </div>
                </label>
                <label>
                    <span>Phone Number</span>
                    <div class="input-container">
                        <input type="tel" name="phone" placeholder="Enter your phone number" required />
                        <i class="fas fa-phone phone-icon"></i>
                    </div>
                </label>
                <label>
                    <span>Address</span>
                    <div class="input-container">
                        <input type="text" name="address" placeholder="Enter your address" required />
                        <i class="fas fa-map-marker-alt address-icon"></i>
                    </div>
                </label>
                <label>
                    <span>Password</span>
                    <div class="input-container">
                        <input type="password" name="password" id="password-signup" placeholder="Enter your password" required />
                        <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password-signup')"></i>
                    </div>
                </label>
                <label>
                    <span>Confirm Password</span>
                    <div class="input-container">
                        <input type="password" id="confirm-password" placeholder="Confirm your password" required />
                        <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('confirm-password')"></i>
                    </div>
                </label>
                <button type="submit" name="sign-up" class="submit">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(id = 'password') {
            const passwordInput = document.getElementById(id);
            const icon = passwordInput.nextElementSibling;
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passwordInput.type = "password";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            }
        }

        // Toggle between Sign-up and Sign-in forms
        document.querySelector('.img__btn').addEventListener('click', function() {
            document.querySelector('.cont').classList.toggle('s--signup');
        });
    </script>
</body>
</html>
