<?php namespace fizzbuzz;

class number
{
	private
		$value
	;

	function __construct($value = 0)
	{
		if (! is_numeric($value) || (int) $value != $value)
		{
			throw new \domainException('Value should be an integer');
		}

		$this->value = (int) $value;
	}

	function ifHasModulo(number\modulo $modulo, callable $callable)
	{
		return self::expressionForCallableIs($this->value % $modulo->value == 0, $callable);
	}

	function ifIsEqualToNumber(self $number, callable $callable)
	{
		return self::expressionForCallableIs($this->value == $number->value, $callable);
	}

	function recipientOfOutputValueIs(output\value\recipient $recipient)
	{
		$recipient->outputValueIs(new output\value((string) $this->value));

		return $this;
	}

	private function expressionForCallableIs($expression, $callable)
	{
		boolean::fromExpression($expression)->ifTrue($callable);

		return $this;
	}
}
