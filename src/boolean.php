<?php namespace fizzbuzz;

abstract class boolean
{
	abstract function ifTrue(callable $calalble);
	abstract function ifFalse(callable $calalble);

	static function fromExpression($expression)
	{
		return
			$expression
			?
			new boolean\true
			:
			new boolean\false
		;
	}
}
