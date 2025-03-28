// Get DOM Elements
const turnInfo = document.getElementById("turn-info");
const gameArea = document.getElementById("game-area");
const resultDisplay = document.getElementById("result");
const player1ScoreDisplay = document.getElementById("player1-score");
const player2ScoreDisplay = document.getElementById("player2-score");
const player1ChoiceDisplay = document.getElementById("player1-choice");
const player2ChoiceDisplay = document.getElementById("player2-choice");
const player2Name = document.getElementById("player2-name");
const player2ScoreLabel = document.getElementById("player2-score-label");
const resultLabel = document.getElementById("result-label");

// Mode Buttons
const pvpModeButton = document.getElementById("pvp-mode");
const pvcModeButton = document.getElementById("pvc-mode");

// Game Buttons
const rockButton = document.getElementById("rock");
const paperButton = document.getElementById("paper");
const scissorsButton = document.getElementById("scissors");
const resetButton = document.getElementById("reset");

// Game Variables
const choices = ["Rock", "Paper", "Scissors"];
const icons = {
    "Rock": '<i class="far fa-hand-rock"></i>',
    "Paper": '<i class="far fa-hand-paper"></i>',
    "Scissors": '<i class="far fa-hand-scissors"></i>',
    "?": "?",
    "❔": "❔"
};
let player1Choice = "";
let player2Choice = "";
let player1Score = 0;
let player2Score = 0;
let currentPlayer = 1;
let gameMode = "";

// Event Listeners
pvpModeButton.addEventListener("click", () => startGame("PvP"));
pvcModeButton.addEventListener("click", () => startGame("PvC"));
rockButton.addEventListener("click", () => makeChoice("Rock"));
paperButton.addEventListener("click", () => makeChoice("Paper"));
scissorsButton.addEventListener("click", () => makeChoice("Scissors"));
resetButton.addEventListener("click", resetGame);

// Game Functions
function startGame(mode) {
    gameMode = mode;
    gameArea.classList.remove("hidden");
    resetGame();
    
    if (mode === "PvP") {
        turnInfo.textContent = "Player 1, make your choice!";
        player2Name.textContent = "Player 2";
        player2ScoreLabel.textContent = "Player 2";
    } else {
        turnInfo.textContent = "Player 1, make your choice!";
        player2Name.textContent = "Computer";
        player2ScoreLabel.textContent = "Computer";
    }
    
    // Scroll to game area
    gameArea.scrollIntoView({ behavior: "smooth" });
}

function makeChoice(choice) {
    if (gameMode === "PvP") {
        if (currentPlayer === 1) {
            player1Choice = choice;
            player1ChoiceDisplay.innerHTML = "❔";
            turnInfo.textContent = "Player 2, make your choice!";
            currentPlayer = 2;
        } else {
            player2Choice = choice;
            player2ChoiceDisplay.innerHTML = icons[player2Choice];
            player1ChoiceDisplay.innerHTML = icons[player1Choice];
            determineWinner();
        }
    } else if (gameMode === "PvC") {
        player1Choice = choice;
        player1ChoiceDisplay.innerHTML = icons[player1Choice];
        
        // Add a small delay for computer's choice to simulate thinking
        turnInfo.textContent = "Computer is choosing...";
        
        setTimeout(() => {
            player2Choice = choices[Math.floor(Math.random() * choices.length)];
            player2ChoiceDisplay.innerHTML = icons[player2Choice];
            determineWinner();
        }, 800);
    }
}

function determineWinner() {
    let result;
    resultDisplay.className = 'result-text';

    if (player1Choice === player2Choice) {
        result = "It's a Draw!";
        resultDisplay.classList.add('draw');
    } else if (
        (player1Choice === "Rock" && player2Choice === "Scissors") ||
        (player1Choice === "Paper" && player2Choice === "Rock") ||
        (player1Choice === "Scissors" && player2Choice === "Paper")
    ) {
        result = "Player 1 Wins!";
        resultDisplay.classList.add('win');
        player1Score++;
        animateScoreChange(player1ScoreDisplay);
    } else {
        result = gameMode === "PvP" ? "Player 2 Wins!" : "Computer Wins!";
        resultDisplay.classList.add('lose');
        player2Score++;
        animateScoreChange(player2ScoreDisplay);
    }

    // Update display
    resultDisplay.textContent = result;
    player1ScoreDisplay.textContent = player1Score;
    player2ScoreDisplay.textContent = player2Score;

    // Reset for next round with a slight delay
    setTimeout(() => {
        currentPlayer = 1;
        turnInfo.textContent = "Player 1, make your choice!";
        player1ChoiceDisplay.innerHTML = "?";
        player2ChoiceDisplay.innerHTML = "?";
    }, 2000);
}

function animateScoreChange(element) {
    element.classList.add('win');
    setTimeout(() => {
        element.classList.remove('win');
    }, 1000);
}

function resetGame() {
    player1Score = 0;
    player2Score = 0;
    player1Choice = "";
    player2Choice = "";
    player1ChoiceDisplay.innerHTML = "?";
    player2ChoiceDisplay.innerHTML = "?";
    resultDisplay.textContent = "?";
    resultDisplay.className = 'result-text';
    player1ScoreDisplay.textContent = "0";
    player2ScoreDisplay.textContent = "0";
    turnInfo.textContent = "Player 1, make your choice!";
    currentPlayer = 1;
}