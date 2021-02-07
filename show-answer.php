<?php

/**
 *
 * /show-answer.php
 *
 * Страница показа загаданного слова.
 *
 */

require_once "{$_SERVER['DOCUMENT_ROOT']}/script.php";

session_start();

$script = unserialize($_SESSION['script']);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Jotto Game</title>
    <style type="text/css">
      #answer {
        font-size: 20px;
        font-weight: bold;
      }
    </style>
  </head>
  <body>
    <main>
    <h1>Jotto Game</h1>
    <div id="answer"><?= 'Ответ: ' . mb_strtoupper($script->hidden_word); ?></div>
    <div><a href="/">Новая игра</a></div>
    </main>
  </body>
  <script>
  </script>
</html>
<?php

session_destroy();
unset($_SESSION['player']);
unset($_SESSION['script']);
