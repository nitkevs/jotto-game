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

  function are_letters_unique($word) {
    for (;mb_strlen($word) >= 2;) {
      $letter = mb_substr($word,  0, 1);
      $word = mb_substr($word, 1);
      if (mb_strpos($word, $letter) !== false) {
        return false;
      }
    }
    return true;
  }

  function validate_word_pattern($word) {
    preg_match('/[а-яА-ЯёЁ]{5}/u', $word, $match);
    if (isset($match[0]) and $match[0] === $word) {
      return true;
    } else {
      return false;
    }
  }

	session_start();

  $player = unserialize($_SESSION['player']);
  $script = unserialize($_SESSION['script']);

  $player->answer = htmlspecialchars($_POST['player-answer']);
  $alphabet = htmlspecialchars($_POST['alphabet']);
  $player->alphabet = $player->alphabet($alphabet);

  if (validate_word_pattern($player->answer) and are_letters_unique($player->answer)) {
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
    $player->used_words[] = $player->answer;
} else {
  $script->message = 'Слово "' . mb_strtoupper($player->answer) . '" не соотвтествует <a href="">правилам игры</a>.';
}

  $_SESSION['player'] = serialize($player);
  $_SESSION['script'] = serialize($script);
}

header("Location: /");
exit;
