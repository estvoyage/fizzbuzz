<?php namespace fizzbuzz\output\value;

use
	fizzbuzz\output
;

interface recipient
{
	function outputValueIs(output\value $value);
}
