<?php
// Database Configuration
$dbHost = 'localhost';       // Your database host
$dbName = 'blackjack_db';    // Your database name
$dbUser = 'db_user';         // Your database username
$dbPass = 'db_password';     // Your database password

// Monero RPC Configuration
$moneroRPCUrl = 'http://localhost:18081';    // Monero RPC server URL
$moneroWalletAddress = 'your_wallet_address'; // Web app's Monero wallet address
$moneroSecretViewKey = 'your_secret_view_key'; // Secret view key for wallet

// Define other configuration variables, if needed
$siteTitle = 'Blackjack Web App';  // Your web app's title
$adminEmail = 'admin@example.com'; // Admin contact email

// Error Reporting (Set to 0 for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create a database connection
try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
