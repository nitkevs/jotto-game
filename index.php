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

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jotto Game</title>
    <style type="text/css">
      :root {
        --letter-size: 24px;
        --letter-default-color: #333;
      }
      * {
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
      }
      #alphabet {
        margin: 5px auto;
      }
      .letter {
        user-select: none;
        display: inline-block;
        width: calc(var(--letter-size) + 2px);
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 3px;
        text-align: center;
        line-height: var(--letter-size);
        font-size: 20px;
      }
      .uncertain {
        color: var(--letter-default-color);
        border-color: transparent;
      }
      .included {
        color: var(--letter-default-color);
        border-color: var(--letter-default-color);
      }
      .excluded {
        color: #ccc;
        border-color: transparent;
      }
    </style>
  </head>
  <body>
    <main>
    <h1>Jotto Game</h1>
    <div id="alphabet"><?= $alphabet ?></div>
    <form action="check-answer.php" method="post">
      <input type="hidden">
      <input type="text" name="player-answer">
      <button>Ответить</button>
    </form>
    <div id="message"></div>
    <div id="recent-words"></div>
    </main>
  </body>
  <script>
    let alphabetBlock = document.getElementById('alphabet');
    let letters = alphabetBlock.querySelectorAll('span.letter');
    letters.forEach(function(letter){
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
      });
    });

  </script>
</html>

