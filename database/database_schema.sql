-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    deposit_balance DECIMAL(10, 2) DEFAULT 0.00,
    games_won INT DEFAULT 0,
    money_won DECIMAL(10, 2) DEFAULT 0.00,
    deposit_history TEXT,
    withdrawals_done TEXT,
    money_lost DECIMAL(10, 2) DEFAULT 0.00
);

-- Games Table
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player1_username VARCHAR(255) NOT NULL,
    player2_username VARCHAR(255),
    player3_username VARCHAR(255),
    dealer_username VARCHAR(255),
    outcome ENUM('win', 'lose', 'tie') NOT NULL,
    bets DECIMAL(10, 2) DEFAULT 0.00,
    dealer_actions TEXT,
    game_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Private Messages Table
CREATE TABLE private_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_username VARCHAR(255) NOT NULL,
    receiver_username VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Public Chat Table
CREATE TABLE public_chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
