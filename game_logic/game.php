<?php
session_start();

// Include the BlackjackGame class from blackjack.php
include('blackjack.php');

// Check if the player is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or handle authentication as needed
    header('Location: login.php');
    exit;
}

// Initialize the game or retrieve it from the session
if (!isset($_SESSION['game'])) {
    // Create a new game with an initial balance (adjust as needed)
    $initialBalance = 1000;
    $_SESSION['game'] = new BlackjackGame($initialBalance);
}

// Get the current game from the session
$game = $_SESSION['game'];

// Handle player actions (e.g., hit, stand, place bet) based on user interactions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform the corresponding action
        if ($action === 'hit') {
            // Handle hitting logic
            $result = $game->hit();
        } elseif ($action === 'stand') {
            // Handle standing logic
            $result = $game->stand();
        } elseif ($action === 'placeBet' && isset($_POST['betAmount'])) {
            // Handle placing a bet
            $betAmount = intval($_POST['betAmount']);
            $result = $game->placeBet($betAmount);
        }
    }
}

// Save the updated game state in the session
$_SESSION['game'] = $game;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blackjack Game</title>
    <!-- Include your CSS styles and JavaScript for user interface interactions here -->
    <style>
        /* Add your CSS styling here */
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const betAmountInput = document.getElementById('betAmount');
            const increaseBetButton = document.getElementById('increaseBet');
            const decreaseBetButton = document.getElementById('decreaseBet');

            // Function to increment the bet amount
            increaseBetButton.addEventListener('click', function () {
                const currentAmount = parseInt(betAmountInput.value);
                const increment = 5;

                if (!isNaN(currentAmount)) {
                    const newAmount = Math.min(currentAmount + increment, 1000000);
                    betAmountInput.value = newAmount;
                }
            });

            // Function to decrement the bet amount
            decreaseBetButton.addEventListener('click', function () {
                const currentAmount = parseInt(betAmountInput.value);
                const increment = 5;

                if (!isNaN(currentAmount)) {
                    const newAmount = Math.max(currentAmount - increment, 10);
                    betAmountInput.value = newAmount;
                }
            });
        });
    </script>
</head>
<body>
    <h1>Blackjack Game</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    
    <!-- Display player's balance and allow them to place a bet -->
    <p>Balance: $<?php echo number_format($game->getPlayerBalance(), 2); ?></p>
    <form method="post" action="game.php">
        <!-- Previous bet amount -->
        <button type="button" id="decreaseBet">-</button>
        <input type="number" id="betAmount" name="betAmount" min="10" max="1000000" step="5" required>
        <button type="button" id="increaseBet">+</button>
        <button type="submit" name="action" value="placeBet">Place Bet</button>
    </form>

    <!-- Display player's and dealer's hands with card images -->
    <h2>Your Hand</h2>
    <?php echo $game->displayPlayerHand(); ?>

    <h2>Dealer's Hand</h2>
    <?php echo $game->displayDealerHand(); ?>

    <!-- Display game result and action buttons (Hit and Stand) -->
    <p><?php echo isset($result) ? $result : ''; ?></p>
    <form method="post" action="game.php">
        <button type="submit" name="action" value="hit">Hit</button>
        <button type="submit" name="action" value="stand">Stand</button>
    </form>

    <!-- Add additional UI elements and styling as needed -->
</body>
</html>
