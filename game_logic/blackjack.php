<?php
class BlackjackGame {
    private $deck;
    private $playerHand;
    private $dealerHand;
    private $playerBet;
    private $playerBalance;

    public function __construct($initialBalance) {
        // Initialize the deck (using simplified card representation)
        $this->deck = $this->createDeck();

        // Initialize player's and dealer's hands
        $this->playerHand = [];
        $this->dealerHand = [];

        // Initialize player's balance
        $this->playerBalance = $initialBalance;
    }

    public function placeBet($amount) {
        if ($amount < 10) {
            return "Minimum bet amount is $10.";
        } elseif ($amount > 1000000) {
            return "Maximum bet amount is $1,000,000.";
        } else {
            $this->playerBet = $amount;
            return "Bet placed: $" . number_format($amount, 2);
        }
    }

    public function dealInitialCards() {
        // Shuffle the deck
        shuffle($this->deck);

        // Deal two cards to the player and two to the dealer
        $this->playerHand = array_slice($this->deck, 0, 2);
        $this->dealerHand = array_slice($this->deck, 2, 2);

        // Check for initial win or loss
        if ($this->calculateHandValue($this->playerHand) == 21) {
            return "Blackjack! You win!";
        } elseif ($this->calculateHandValue($this->dealerHand) == 21) {
            return "Dealer has blackjack. You lose.";
        }

        return "Initial cards dealt.";
    }

    public function hit() {
        // Deal one card to the player
        $this->playerHand[] = array_pop($this->deck);

        // Check if the player busts (hand value > 21)
        if ($this->calculateHandValue($this->playerHand) > 21) {
            return "Bust! You lose.";
        }

        return "Player hits.";
    }

    public function stand() {
        // Dealer's turn: Continue hitting until hand value is 17 or higher
        while ($this->calculateHandValue($this->dealerHand) < 17) {
            $this->dealerHand[] = array_pop($this->deck);
        }

        // Determine the winner
        $playerValue = $this->calculateHandValue($this->playerHand);
        $dealerValue = $this->calculateHandValue($this->dealerHand);

        if ($dealerValue > 21 || $playerValue > $dealerValue) {
            // Player wins
            return "You win!";
        } elseif ($playerValue == $dealerValue) {
            // It's a tie
            return "It's a tie.";
        } else {
            // Dealer wins
            return "Dealer wins.";
        }
    }

    // Function to get the card image URL based on card value and suit
    private function getCardImageURL($value, $suit) {
        // Define the path to the card images folder (assuming it's in the root directory)
        $imageFolderPath = 'images/cards/';

        // Create the filename based on card value and suit
        $filename = $value . '_of_' . $suit . '.png'; // Adjust the file format as needed

        // Return the complete image URL
        return $imageFolderPath . $filename;
    }

    // Function to display the player's hand with card images
    public function displayPlayerHand() {
        $handHTML = '';
        foreach ($this->playerHand as $card) {
            $value = substr($card, 0, -1); // Remove the suit
            $suit = substr($card, -1); // Get the suit

            $cardImageURL = $this->getCardImageURL($value, $suit);

            $handHTML .= '<img src="' . $cardImageURL . '" alt="' . $value . ' of ' . $suit . '">';
        }

        return $handHTML;
    }

    private function createDeck() {
        // Create a deck of cards with simplified representation
        $suits = ['H', 'D', 'C', 'S']; // Hearts, Diamonds, Clubs, Spades
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        $deck = [];
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = $value . $suit;
            }
        }

        return $deck;
    }

    private function calculateHandValue($hand) {
        // Calculate the value of a hand based on card values
        $value = 0;
        $aces = 0;

        foreach ($hand as $card) {
            $rank = substr($card, 0, -1); // Remove the suit
            if ($rank == 'A') {
                $value += 11;
                $aces++;
            } elseif (in_array($rank, ['K', 'Q', 'J'])) {
                $value += 10;
            } else {
                $value += intval($rank);
            }
        }

        // Adjust for aces if needed
        while ($value > 21 && $aces > 0) {
            $value -= 10;
            $aces--;
        }

        return $value;
    }
}
?>

