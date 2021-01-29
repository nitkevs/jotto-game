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

$player = new Player();

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
    <div id="alphabet">А Б В Г Д Е Ё Ж З И К Л М Н О П Р С Т У Ф Х Ц Ч Ш Щ Ъ Ы Ь Э Ю Я</div>
    <form action="/" method="post">
      <input type="text">
      <button>Ответить</button>
    </form>
    <div id="message"></div>
    <div id="recent-words"></div>
    </main>
  </body>
  <script>
  </script>
</html>

