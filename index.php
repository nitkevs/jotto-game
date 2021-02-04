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
  $alphabet .= "<span class=\"{$class} letter\">{$letter}</span>\n";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jotto Game</title>
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
  </script>
</html>

