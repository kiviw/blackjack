<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackjack Web App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Include the header template -->
    <?php include("templates/header.html"); ?>

    <div class="container">
        <h1>Welcome to Blackjack Web App</h1>
        <p>Play blackjack online with players from around the world.</p>

        <!-- Display ongoing games or create a game listing section -->
        <div class="game-listings">
            <!-- Example game listing -->
            <div class="game-listing">
                <h2>Game 1</h2>
                <p>Players: 3/7</p>
                <button onclick="joinGame(1)">Join</button>
            </div>

            <!-- More game listings can be added here -->
        </div>

        <!-- User login and registration section -->
        <div class="user-section">
            <div class="login">
                <h2>Login</h2>
                <!-- Add login form here -->
                <form action="login.php" method="POST">
                    <!-- Login form fields (username and password) -->
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
            </div>

            <div class="register">
                <h2>Register</h2>
                <!-- Add registration form here -->
                <form action="register.php" method="POST">
                    <!-- Registration form fields (username, password, email, etc.) -->
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include the footer template -->
    <?php include("templates/footer.html"); ?>

    <script src="js/main.js"></script>
    <script>
        // JavaScript functions for interacting with the game listings and forms
        function joinGame(gameId) {
            // Add logic to join the selected game
        }
    </script>
</body>
</html>
