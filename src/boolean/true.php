<?php namespace fizzbuzz\boolean;

use
	fizzbuzz\boolean
;

class true extends boolean
{
	function ifTrue(callable $callable)
	{
		$callable();

		return $this;
	}

	function ifFalse(callable $callable)
	{
		return $this;
	}
}
