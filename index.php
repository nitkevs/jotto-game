<?php

/**
 *
 * /index.php
 *
 * Основная страница игры для взаимодействия с игроком.
 *
 */

require_once "{$_SERVER['DOCUMENT_ROOT']}/player.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/script.php";

session_start();

// Если начинается новая игра
if (!isset($_SESSION['player'])) {
  $player = new Player();
  $player->alphabet = $player->alphabet();
  $script = new Script();
  $script->hidden_word = $script->random_word();

// Сохраняем объекты в сессии PHP
  $_SESSION['player'] = serialize($player);
  $_SESSION['script'] = serialize($script);
} else {
  $player = unserialize($_SESSION['player']);
  $script = unserialize($_SESSION['script']);
}

$alphabet = '';

foreach ($player->alphabet as $letter => $class) {
  $alphabet .= "<span class=\"letter {$class}\">{$letter}</span>\n";
}

$included_letters = '';

foreach ($player->alphabet as $letter => $class) {
    if ($class === 'included') {
      $included_letters .= $letter;
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jotto Game</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <main>
    <h1>Jotto Game</h1>
    <div id="alphabet"><?= $alphabet ?></div>
    <div id="included-letters"><?= $included_letters ?></div>
    <form action="check-answer.php" method="post">
      <input type="hidden" name="alphabet" id="alphabet-field">
      <input type="text" name="player-answer" autocomplete="off" autofocus>
      <button>Ответить</button> <button formaction="new-game.php">Новая игра</button> <button formaction="show-answer.php" value="show-answer">Сдаюсь</button>
    </form>
    <div id="message"><?= $script->message ?></div>
    <div id="recent-words">
<?php
foreach ($player->used_words as $word) {
  echo '<div>' . $word . '</div>';
}
?>
    </div>
    </main>
  </body>
  <script>
    let alphabetBlock = document.getElementById('alphabet');
    let letters = alphabetBlock.querySelectorAll('span.letter');
    let alphabetField = document.getElementById('alphabet-field');
    let alphabetClassesArray = [];
    let alphabetClassesString = '';

    letters.forEach(function(letter) {
      alphabetClassesArray.push(letter.classList[1]);
      alphabetClassesString = alphabetClassesArray.join(', ');
      alphabetField.value = alphabetClassesString;
    });

    letters.forEach(function(letter, index){
      letter.addEventListener('click', function(){
        switch (true) {
          case this.classList.contains('uncertain'):
            this.classList.remove('uncertain');
            this.classList.add('included');
            break;
          case this.classList.contains('included'):
            this.classList.remove('included');
            this.classList.add('excluded');
            break;
          case this.classList.contains('excluded'):
            this.classList.remove('excluded');
            this.classList.add('uncertain');
            break;
        }
        alphabetClassesArray[index] = this.classList[1];
        alphabetClassesString = alphabetClassesArray.join(', ');
        alphabetField.value = alphabetClassesString;
      });
    });

  </script>
</html>
