let player1Score = 0;
let player2Score = 0;
let currentPlayer = 1; // Start with Player 1
const winningScore = 20; // Set winning score
const historyContainer = document.getElementById("history");
const currentPlayerSpan = document.getElementById("currentPlayer");

document.getElementById("rollDiceBtn").addEventListener("click", function() {
    let diceRoll = Math.floor(Math.random() * 6) + 1; // Generate random number between 1-6

    if (player1Score >= winningScore || player2Score >= winningScore) {
        return; // Stop the game if someone already won
    }

    // Dice roll animation
    const diceImage = document.getElementById("diceImage");
    diceImage.classList.add("roll-animation");
    setTimeout(() => diceImage.classList.remove("roll-animation"), 500);

    let playerName = (currentPlayer === 1) ? "Player 1" : "Player 2";

    // Update the correct player's score
    if (currentPlayer === 1) {
        player1Score += diceRoll;
        document.getElementById("score1").textContent = "Player 1 Score: " + player1Score;
        if (player1Score >= winningScore) {
            document.getElementById("winner").textContent = "🎉 Player 1 Wins!";
            return;
        }
        currentPlayer = 2; // Switch to Player 2
        currentPlayerSpan.textContent = "Player 2's Turn";
        currentPlayerSpan.classList.remove("highlight-player1");
        currentPlayerSpan.classList.add("highlight-player2");
    } else {
        player2Score += diceRoll;
        document.getElementById("score2").textContent = "Player 2 Score: " + player2Score;
        if (player2Score >= winningScore) {
            document.getElementById("winner").textContent = "🎉 Player 2 Wins!";
            return;
        }
        currentPlayer = 1; // Switch back to Player 1
        currentPlayerSpan.textContent = "Player 1's Turn";
        currentPlayerSpan.classList.remove("highlight-player2");
        currentPlayerSpan.classList.add("highlight-player1");
    }

    document.getElementById("diceResult").textContent = "You rolled a " + diceRoll + "!";
    document.getElementById("diceImage").src = "dice" + diceRoll + ".png"; // Change dice image
    
    // Add roll to history
    let historyItem = document.createElement("p");
    historyItem.classList.add("history-item");
    historyItem.textContent = playerName + " rolled a " + diceRoll;
    historyContainer.appendChild(historyItem);
    historyContainer.scrollTop = historyContainer.scrollHeight; // Auto-scroll to latest roll
});

document.getElementById("resetBtn").addEventListener("click", function() {
    player1Score = 0;
    player2Score = 0;
    currentPlayer = 1; // Reset to Player 1's turn
    document.getElementById("score1").textContent = "Player 1 Score: 0";
    document.getElementById("score2").textContent = "Player 2 Score: 0";
    document.getElementById("history").innerHTML = ""; // Clear history
    document.getElementById("winner").textContent = ""; // Clear winner message
    currentPlayerSpan.textContent = "Player 1's Turn";
    currentPlayerSpan.classList.remove("highlight-player2");
    currentPlayerSpan.classList.add("highlight-player1");
});
