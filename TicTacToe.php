<?php
session_start();

class GameBoard {
    public static function display($board) {
        echo "<table border='1'>";
        for ($i = 0; $i < 3; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 3; $j++) {
                echo "<td><a href='?row=$i&col=$j'>" . $board[$i][$j] . "</a></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

class GameLogic {
    public static function initializeBoard() {
        return [['-', '-', '-'], ['-', '-', '-'], ['-', '-', '-']];
    }

    public static function checkWinner($board, $player) {
        // Check rows
        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][0] == $player && $board[$i][1] == $player && $board[$i][2] == $player) {
                return true;
            }
        }

        // Check columns
        for ($j = 0; $j < 3; $j++) {
            if ($board[0][$j] == $player && $board[1][$j] == $player && $board[2][$j] == $player) {
                return true;
            }
        }

        // Check diagonals
        if ($board[0][0] == $player && $board[1][1] == $player && $board[2][2] == $player) {
            return true;
        }
        if ($board[0][2] == $player && $board[1][1] == $player && $board[2][0] == $player) {
            return true;
        }

        return false;
    }
}

class PlayerInput {
    public static function processInput($board, $row, $col, $player) {
        if ($board[$row][$col] == '-') {
            $board[$row][$col] = $player;
        }
        return $board;
    }
}

// Main game logic
$board = isset($_SESSION['board']) ? $_SESSION['board'] : GameLogic::initializeBoard();
$player = isset($_SESSION['player']) ? $_SESSION['player'] : 'X';

if (isset($_GET['row']) && isset($_GET['col'])) {
    $row = $_GET['row'];
    $col = $_GET['col'];

    $board = PlayerInput::processInput($board, $row, $col, $player);

    if (GameLogic::checkWinner($board, $player)) {
        echo "Гравець $player переміг!";
        $board = GameLogic::initializeBoard();
    } elseif (array_reduce($board, function ($carry, $item) {
        return $carry && !in_array('-', $item);
    }, true)) {
        echo "Нічия!";
        $board = GameLogic::initializeBoard();
    } else {
        $player = $player == 'X' ? 'O' : 'X';
    }
}

$_SESSION['board'] = $board;
$_SESSION['player'] = $player;

// Display the game board
GameBoard::display($board);
?>