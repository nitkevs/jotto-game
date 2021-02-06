<?php

/**
 *
 * /player.php
 *
 * Класс Player предоставляет аттрибуты
 * для хранения данных об игроке.
 *
 */

class Player {
  public $answer = '';
  public $alphabet = array();

  public $used_words =  '';

  public function alphabet($string = "uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain, uncertain") {
  	$array = explode(', ', $string);

  	$leters_list = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'];
  	$array = array_combine($leters_list, $array);

  	return $array;
  }
}
