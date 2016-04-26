<?php namespace fizzbuzz\number;

use
	fizzbuzz
;

class modulo extends fizzbuzz\number
{
	function __construct($value)
	{
		$exception = null;

		try
		{
			parent::__construct($value);
		}
		catch (\exception $exception) {}

		if ($exception || ! $value)
		{
			throw new \domainException('Modulo should be an integer not equal to 0');
		}
	}
}
