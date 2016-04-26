<?php namespace fizzbuzz\boolean;

use
	fizzbuzz\boolean
;

class false extends boolean
{
	function ifTrue(callable $callable)
	{
		return $this;
	}

	function ifFalse(callable $callable)
	{
		$callable();

		return $this;
	}
}
