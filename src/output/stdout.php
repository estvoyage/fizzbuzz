<?php namespace fizzbuzz\output;

use
	fizzbuzz
;

class stdout
	implements
		fizzbuzz\output
{
	function outputValueIs(fizzbuzz\output\value $value)
	{
		echo $value . PHP_EOL;
	}
}
