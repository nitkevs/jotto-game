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

  $_SESSION['player'] = serialize($player);
  $_SESSION['script'] = serialize($script);
}

header("Location: /");
exit;