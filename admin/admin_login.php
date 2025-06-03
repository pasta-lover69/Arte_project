<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = 'admin';
    $admin_password = 'admingwapo123';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Invalid login credentials.";
    }
}
?>

<head>
    <!-- Replace multiple CSS links with single consolidated file -->
    <link rel="stylesheet" href="admin-styles.css?v=<?php echo time(); ?>">
</head>


<div class="login-container">
    <h2>Login Admin</h2>

<form method="POST">
    <div class="container">
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required><br>
    
    <input class="login-button" type="submit" value="Login">
    
    <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
    </div>
</form>
</div> 