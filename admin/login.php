<?php
// Include necessary database and authentication functions
include('database_config/db_connection.php');
include('database_config/db_queries.php');

// Initialize variables
$username = '';
$password = '';
$errors = array();

// Handle user login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Find user by username
    $user = findUserByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user information in session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the admin panel or another authorized page
        header('Location: admin.php');
        exit;
    } else {
        $errors[] = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Include your CSS file -->
</head>
<body>
    <h1>Login</h1>

    <?php if (!empty($errors)) { ?>
        <div class="errors">
            <?php foreach ($errors as $error) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
