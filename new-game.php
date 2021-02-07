<?php

/**
 *
 * /new-game.php
 *
 * Скрипт обнуления всех данных игры.
 *
 */

session_start();
session_destroy();
unset($_SESSION['player']);
unset($_SESSION['script']);

header("Location: /");
exit;

