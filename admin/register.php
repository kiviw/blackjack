<?php
// Include necessary database and registration functions
include('database_config/db_connection.php');
include('database_config/db_queries.php');

// Initialize variables
$username = '';
$password = '';
$confirm_password = '';
$errors = array();

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation: Ensure username is unique and meets your requirements
    $existing_user = findUserByUsername($username);
    if ($existing_user) {
        $errors[] = 'Username already exists.';
    }

    // Validation: Ensure passwords match
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // You should hash and salt the password here
        // Insert user into the database
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $success = createUser($username, $hashed_password);

        if ($success) {
            // Redirect to login page or provide a success message
            header('Location: login.php');
            exit;
        } else {
            $errors[] = 'Registration failed. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Include your CSS file -->
</head>
<body>
    <h1>Register</h1>
    
    <?php if (!empty($errors)) { ?>
        <div class="errors">
            <?php foreach ($errors as $error) { ?>
                <p><?php echo $error; ?></p>
            <?php } ?>
        </div>
    <?php } ?>

    <form method="post" action="register.php">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
