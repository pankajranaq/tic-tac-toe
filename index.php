<!DOCTYPE html>
<html>
<head>
<title>Play Tic Tac Toe Game with Ai</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
@charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=PT+Sans:400,700,300);
body {
  font-family: Arial;
  background-color: #BB4A9F;
  background-image: -webkit-linear-gradient(-320deg, #BB4A9F 0%, #E4E5D7 35%, #BEE8D7 65%, #51C8C8 90%);
  background-image: linear-gradient(50deg,#BB4A9F 0%, #E4E5D7 35%, #BEE8D7 65%, #51C8C8 90%);
  background-repeat: no-repeat;
  background-attachment: fixed;
}

.board-default, .board, .board__settings, .board__difficulty {
  width: 250px;
  height: 250px;
  display: flex;
  justify-content: center;
  align-content: center;
  flex-direction: column;
  text-align: center;
  border-radius: 30px;
  background-color: rgba(255, 255, 255, 0.4);
}
.board-default:before, .board:before, .board__settings:before, .board__difficulty:before {
  content: '';
  position: absolute;
  z-index: -1;
  top: -15px;
  left: -15px;
  right: -15px;
  bottom: -15px;
  border-radius: 51px;
  border: 15px solid rgba(0, 0, 0, 0.05);
}
@media (min-width: 450px) {
  .board-default, .board, .board__settings, .board__difficulty {
    width: 400px;
    height: 400px;
  }
}

.board {
  position: relative;
  margin: 40px auto;
}

.board__wrapper {
  display: inline-flex;
}

.board__row {
  display: block;
}

.board__slot-hidden {
  display: none;
}

.board__slot {
  display: inline-block;
  height: 60px;
  width: 60px;
  box-sizing: border-box;
  position: relative;
  cursor: pointer;
  border-radius: 15px;
  background-color: rgba(0, 0, 0, 0.15);
  margin: 5px;
}
@media (min-width: 450px) {
  .board__slot {
    height: 110px;
    width: 110px;
    border-radius: 30px;
  }
}
.board__slot:hover {
  background-color: rgba(0, 0, 0, 0.1);
}
.board__slot:active {
  border: 2px solid rgba(0, 0, 0, 0.09);
}

.board__settings {
  position: absolute;
  margin: auto;
  right: 0;
  left: 0;
  z-index: 3;
  text-align: center;
  visibility: hidden;
  background-color: #dff4ef;
}

.board__settings-cog {
  position: absolute;
  top: -15px;
  left: -15px;
  width: 30px;
  font-size: 2em;
  background-color: #e0f4ef;
  border-radius: 50%;
  border: 10px solid #e0f4ef;
  cursor: pointer;
  z-index: 9;
  color: rgba(0, 0, 0, 0.5);
}
.board__settings-cog:hover {
  box-shadow: 1px 1px 2px 5px rgba(0, 0, 0, 0.05);
}
.board__settings-cog:after {
  content: '';
  position: absolute;
  top: -10px;
  left: -10px;
  right: -10px;
  bottom: -10px;
  border-radius: 51px;
  border: 3px solid rgba(0, 0, 0, 0.2);
}

.board__settings__choice, .board__settings__choice-cross, .board__settings__choice-nought {
  display: inline-block;
  height: 60px;
  width: 60px;
  box-sizing: border-box;
  position: relative;
  cursor: pointer;
  border-radius: 15px;
  background-color: rgba(0, 0, 0, 0.15);
  margin: 5px;
  z-index: 99;
  padding-top: 8px;
}
@media (min-width: 450px) {
  .board__settings__choice, .board__settings__choice-cross, .board__settings__choice-nought {
    height: 110px;
    width: 110px;
    border-radius: 30px;
  }
}
.board__settings__choice-cross {
  font-size: .7em;
}
.board__settings__choice-nought {
  font-size: .2em;
}
.board__settings__choice:hover, .board__settings__choice-cross:hover, .board__settings__choice-nought:hover {
  background-color: rgba(0, 0, 0, 0.1);
}
.board__settings__choice:active, .board__settings__choice-cross:active, .board__settings__choice-nought:active {
  border: 2px solid rgba(0, 0, 0, 0.09);
}

.board__settings__choice-cross {
  font-family: 'FontAwesome';
  font-size: 2.3em;
  cursor: pointer;
}
@media (min-width: 450px) {
  .board__settings__choice-cross {
    font-size: 3em;
    top: 15px;
  }
}
.board__settings__choice-cross:before {
  color: white;
  content: "";
}

.board__settings__choice-nought {
  font-family: 'FontAwesome';
  font-size: 2.3em;
  cursor: pointer;
}
@media (min-width: 450px) {
  .board__settings__choice-nought {
    font-size: 2.8em;
    top: 10px;
  }
}
.board__settings__choice-nought:before {
  color: white;
  content: "";
}

.board__difficulty {
  position: absolute;
  margin: auto;
  right: 0;
  left: 0;
  z-index: 2;
  text-align: center;
  background-color: rgba(223, 244, 239, 0.8);
}

.board__header, .board__header-settings, .board__header-difficulty {
  font-family: 'PT Sans', Arial, sans-serif;
  color: rgba(0, 0, 0, 0.7);
  font-size: 1.5em;
  position: absolute;
  top: 20px;
  left: 0;
  right: 0;
  text-transform: uppercase;
}
@media (min-width: 450px) {
  .board__header, .board__header-settings, .board__header-difficulty {
    font-size: 2em;
  }
}

.board__difficulty__button, .board__difficulty__button-easy, .board__difficulty__button-medium, .board__difficulty__button-hard {
  position: relative;
  display: block;
  margin: 10px auto;
  padding: 5px;
  font-family: 'PT Sans', arial, sans-serif;
  font-size: 1em;
  width: 150px;
  background-color: #fff;
  border: 1px solid #ccc;
  color: #000;
  text-transform: uppercase;
}
.board__difficulty__button:before, .board__difficulty__button-easy:before, .board__difficulty__button-medium:before, .board__difficulty__button-hard:before, .board__difficulty__button:after, .board__difficulty__button-easy:after, .board__difficulty__button-medium:after, .board__difficulty__button-hard:after {
  content: '';
  position: absolute;
  z-index: -2;
  transition: all 250ms ease-out;
  bottom: 15px;
  width: 50%;
  height: 20%;
  box-shadow: 0 10px 30px rgba(31, 31, 31, 0.5);
}
.board__difficulty__button:before, .board__difficulty__button-easy:before, .board__difficulty__button-medium:before, .board__difficulty__button-hard:before {
  left: 8px;
  transform: rotate(-3deg);
}
.board__difficulty__button:after, .board__difficulty__button-easy:after, .board__difficulty__button-medium:after, .board__difficulty__button-hard:after {
  right: 8px;
  transform: rotate(3deg);
}
.board__difficulty__button:hover, .board__difficulty__button-easy:hover, .board__difficulty__button-medium:hover, .board__difficulty__button-hard:hover {
  border-color: transparent;
  cursor: pointer;
}
.board__difficulty__button:hover:before, .board__difficulty__button-easy:hover:before, .board__difficulty__button-medium:hover:before, .board__difficulty__button-hard:hover:before, .board__difficulty__button:hover:after, .board__difficulty__button-easy:hover:after, .board__difficulty__button-medium:hover:after, .board__difficulty__button-hard:hover:after {
  box-shadow: 0 15px 12px rgba(31, 31, 31, 0.7);
}
.board__difficulty__button-easy {
  margin-top: 70px;
}
@media (min-width: 450px) {
  .board__difficulty__button, .board__difficulty__button-easy, .board__difficulty__button-medium, .board__difficulty__button-hard {
    padding: 10px 40px;
    font-size: 2em;
    width: 200px;
  }
}

.nought:before, .cross:before {
  font-family: 'FontAwesome';
  font-size: 3em;
  position: absolute;
  top: 5px;
  bottom: 0;
  left: 0px;
  right: 0px;
  cursor: default;
}
@media (min-width: 450px) {
  .nought:before, .cross:before {
    font-size: 5em;
    top: 15px;
  }
}

.nought:before {
  content: "";
}

.cross:before {
  content: "";
}

.computer-color {
  color: rgb(255, 255, 255);
}

.player-color {
  color: blue;
}

/* Animations */
.slideUp {
  animation: slideUp 1s ease-in-out;
  animation-fill-mode: forwards;
}

.slideDown {
  animation: slideDown 1s ease-in-out;
  animation-fill-mode: forwards;
}

@keyframes slideUp {
  0% {
    transform: translateY(0);
  }
  100% {
    transform: translateY(-500px);
  }
}
@keyframes slideDown {
  0% {
    transform: translateY(-500px);
  }
  100% {
    transform: translateY(0);
  }
}

</style>

</head>
<body>

<div class="board__settings"><i class="fa fa-cog board__settings-cog"></i>
  <h1 class="board__header-settings">Choose Player
    <div class="board__row">
      <div class="board__settings__choice-cross"></div>
      <div class="board__settings__choice-nought"></div>
    </div>
  </h1>
</div>
<div class="board__difficulty"><i class="fa fa-cog board__settings-cog"></i>
  <h1 class="board__header-difficulty">Select Difficulty</h1>
  <div class="board__difficulty__button-easy" id="easy">Easy</div>
  <div class="board__difficulty__button-medium" id="medium">Medium</div>
  <div class="board__difficulty__button-hard" id="hard">Hard</div>
</div>
<div class="board">
  <div class="board__row">
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="0"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="1"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="2"></label>
  </div>
  <div class="board__row">
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="3"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="4"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="5"></label>
  </div>
  <div class="board__row">
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="6"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="7"></label>
    <input class="board__slot-hidden" type="radio"/>
    <label class="board__slot" id="8"></label>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
/* Globals */
var NUM_ROWS = 3,
  	NUM_COLS = 3,
  	NUM_SQUARES = NUM_ROWS * NUM_COLS,
  	GAMEBOARD = new Array(NUM_SQUARES),
    WIN_COMBOS = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],
                  [1,4,7],[2,5,8],[0,4,8],[2,4,6]],
  	MAX_DEPTH,
  	AI_MOVE,
    PLAYER_CLASS = 'cross',
    COMPUTER_CLASS = 'nought',
    RUNNING = false;

$(document).ready(function() {
	/* Start a new game */
	new_game();

  /* Settings cog clicked, show the settings menu */
  $(".board__settings-cog").click(function() {
    if ($(".board__settings").css('visibility') == 'hidden') {
      $(".board__settings").css('visibility', 'visible');
    } else {
      $(".board__settings").css('visibility', 'hidden');
    }
  });

  /* Player class has been switched from the settings menu */
  $(".board__settings__choice-cross").click(function() {
    PLAYER_CLASS = 'cross';
    COMPUTER_CLASS = 'nought';
    $(".board__settings").css('visibility', 'hidden');
    console.log('set class to cross');
  });

  $(".board__settings__choice-nought").click(function() {
    PLAYER_CLASS = 'nought';
    COMPUTER_CLASS = 'cross';
    $(".board__settings").css('visibility', 'hidden');
  });

  /* Difficulty selected */
  $("div[class*=board__difficulty__button]").click(function() {
    var difficulty = $(this).attr("id");

    if (difficulty === 'easy') MAX_DEPTH = 1;
    else if (difficulty === 'medium') MAX_DEPTH = 3;
    else MAX_DEPTH = 6;

    $(".board__difficulty").removeClass('slideDown').addClass('slideUp');
    new_game();

  });

	/* Process a square being clicked */
  $(".board__slot").click(function() {
    if (RUNNING) {
  		var pos = Number($(this).attr("id"));

  		/* If the square is empty, process the click */
  		if (GAMEBOARD[pos] == "") {
  			$(this).addClass(PLAYER_CLASS + ' player-color');
  			GAMEBOARD[pos] = "X";

  			if (full(GAMEBOARD)) {
          RUNNING = false;
  				$(".board__header-difficulty").html("It's a tie!");
          $(".board__difficulty").removeClass('slideUp').addClass('slideDown');
  			} else if (wins(GAMEBOARD, "X")) {
          RUNNING = false;
  				$(".board__header-difficulty").html("You win!");
          $(".board__difficulty").removeClass('slideUp').addClass('slideDown');
  			} else {
  				minimax(GAMEBOARD, "O", 0);
  				GAMEBOARD[AI_MOVE] = "O";
  				$(".board__slot[id=" + AI_MOVE + "]").addClass(COMPUTER_CLASS + ' computer-color');

  				if (wins(GAMEBOARD, "O")) {
            RUNNING = false;
  					$(".board__header-difficulty").html("You lost!");
            $(".board__difficulty").removeClass('slideUp').addClass('slideDown');
  				}
  			}
  		}
    }
	});
});

/* Starts a new game */
function new_game() {
	/* Clear the table */
	$(".board__slot").each(function() {
		$(this).removeClass(PLAYER_CLASS + ' player-color computer-color ' + COMPUTER_CLASS);
	});

	/* Clear the gameboard */
	for (var i = 0; i < NUM_SQUARES; i++) {
		GAMEBOARD[i] = "";
	}

  RUNNING = true;
}

/* For a given state of the board, returns all the available moves */
function get_available_moves(state) {
	var all_moves = Array.apply(null, {length: NUM_SQUARES}).map(Number.call, Number);
	return all_moves.filter(function(i) { return state[i] == ""; });
}

/* Given a state of the board, returns true if the board is full */
function full(state) {
	return !get_available_moves(state).length;
}

/* Given a state of the board, returns true if the specified player has won */
function wins(state, player) {
	var win;

	for (var i = 0; i < WIN_COMBOS.length; i++) {
		win = true;
		for (var j = 0; j < WIN_COMBOS[i].length; j++) {
			if (state[WIN_COMBOS[i][j]] != player) {
				win = false;
			}
		}
		if (win) {
			return true;
		}
	}
	return false;
}

/* Given a state of the board, returns true if the board is full or a player has won */
function terminal(state) {
	return full(state) || wins(state, "X") || wins(state, "O");
}

/* Returns the value of a state of the board */
function score(state) {
	if (wins(state, "X")) {
		return 10;
	} else if (wins(state, "O")) {
		return -10;
	} else {
		return 0;
	}
}

/* Finds the optimal decision for the AI */
function minimax(state, player, depth) {
	if (depth >= MAX_DEPTH || terminal(state)) {
		return score(state);
	}

	var max_score,
		min_score,
		scores = [],
		moves = [],
		opponent = (player == "X") ? "O" : "X",
		successors = get_available_moves(state);

	for (var s in successors) {
		var possible_state = state;
		possible_state[successors[s]] = player;
		scores.push(minimax(possible_state, opponent, depth + 1));
		possible_state[successors[s]] = "";
		moves.push(successors[s]);
	}

	if (player == "X") {
		AI_MOVE = moves[0];
		max_score = scores[0];
		for (var s in scores) {
			if (scores[s] > max_score) {
				max_score = scores[s];
				AI_MOVE = moves[s];
			}
		}
		return max_score;
	} else {
		AI_MOVE = moves[0];
		min_score = scores[0];
		for (var s in scores) {
			if (scores[s] < min_score) {
				min_score = scores[s];
				AI_MOVE = moves[s];
			}
		}
		return min_score;
	}
}

</script>
</body>
</html>














