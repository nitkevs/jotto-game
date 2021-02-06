<?php

/**
 *
 * /check-answer.php
 *
 * Обработчик ввода игрока.
 *
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require_once "{$_SERVER['DOCUMENT_ROOT']}/player.php";
  require_once "{$_SERVER['DOCUMENT_ROOT']}/script.php";

	session_start();

  $player = unserialize($_SESSION['player']);
  $script = unserialize($_SESSION['script']);

  $player->answer = htmlspecialchars($_POST['player-answer']);
  $alphabet = htmlspecialchars($_POST['alphabet']);
  $player->alphabet = $player->alphabet($alphabet);

  if ($player->answer === $script->hidden_word) {
    $script->message = "<b>Угадали! Слово: " . mb_strtoupper($player->answer) . "</b>";
  }

  for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
      if (mb_substr($player->answer, $i, 1) === mb_substr($script->hidden_word, $j, 1)) {
        $letters .= mb_strtoupper(mb_substr($player->answer, $i, 1));
      }
    }
    if ($i  === 4 and empty($letters)) {
      $script->message = "Вы не угадали ни одной буквы.";
    } elseif ($i  === 4 and $player->answer !== $script->hidden_word) {
      $script->message = "<b>" . $letters . "</b><br>";
    }
  }

  $_SESSION['player'] = serialize($player);
  $_SESSION['script'] = serialize($script);
}

header("Location: /");
exit;
