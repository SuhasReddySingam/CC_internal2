<?php
// Simple PHP Login System (NO DATABASE - Local Variables Only)
// For demo purposes on AWS Elastic Beanstalk

session_start();

// Hardcoded users (username => password_hash)
$users = [
    'admin' => password_hash('admin123', PASSWORD_DEFAULT),
    'user'  => password_hash('user123', PASSWORD_DEFAULT)
];

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['user'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

<?php
// dashboard.php
// -----------------
// <?php
// session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: index.php");
//     exit();
// }
// echo "Welcome, " . htmlspecialchars($_SESSION['user']) . "! You are logged in.";
// ?>
?>
