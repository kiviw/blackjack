<?php
// Function to insert a private message
function insertPrivateMessage($senderUsername, $receiverUsername, $message) {
    global $db;
    $sql = "INSERT INTO private_messages (sender_username, receiver_username, message) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$senderUsername, $receiverUsername, $message]);
}

// Function to retrieve private messages between two users
function getPrivateMessages($user1, $user2) {
    global $db;
    $sql = "SELECT * FROM private_messages WHERE (sender_username = ? AND receiver_username = ?) OR (sender_username = ? AND receiver_username = ?) ORDER BY timestamp ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute([$user1, $user2, $user2, $user1]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to insert a public chat message
function insertPublicChatMessage($username, $message) {
    global $db;
    $sql = "INSERT INTO public_chat (username, message) VALUES (?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $message]);
}

// Function to retrieve public chat messages
function getPublicChatMessages() {
    global $db;
    $sql = "SELECT * FROM public_chat ORDER BY timestamp ASC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add more database functions as needed
?>
