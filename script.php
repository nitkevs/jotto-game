<?php

/**
 *
 * /script.php
 *
 * Класс Script предоставляет аттрибуты
 * для хранения данных о скрипте в качестве игрока.
 *
 */

class Script {
	public $hidden_word = '';
	public $message = '';

	public function random_word() {
		$lines = file('./words_list.txt', FILE_IGNORE_NEW_LINES);
		$word_count = count($lines);
		$word_number = rand(1, $word_count);
		$word = $lines[$word_number];
		return $word;
	}

}