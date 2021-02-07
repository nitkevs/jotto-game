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
        margin: 18px 0;
      }
    :root {
        --letter-size: 24px;
        --letter-default-color: #333;
      }
      * {
        box-sizing: border-box;
        margin: 0px;
        padding: 0px;
      }
      body {
        padding: 20px 80px;
        font-size: 18px;
      }
      h1 {
        margin: 20px 0;
      }
      button, input {
        padding: 2px 4px;
        margin: 20px 2px;
      }
      #alphabet,
      #included-letters {
        margin: 12px auto;
        width: fit-content;
        text-align: center;
        font-size: 20px;
      }
      #alphabet {
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
      }
      #included-letters {
        letter-spacing: 10px;
      }
      .letter {
        display: inline-block;
        width: calc(var(--letter-size) + 2px);
        border: 1px solid transparent;
        border-radius: 3px;
        cursor: pointer;
        text-align: center;
        line-height: var(--letter-size);
        user-select: none;
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
      #recent-words {
        margin-top: 18px;
      }
      #recent-words div {
        display: inline-block;
        width: 100px;
        margin: 5px 0;
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
