<?php namespace fizzbuzz\output;

use
	fizzbuzz\boolean
;

class value
{
	private
		$value
	;

	function __construct($value = '')
	{
		switch (true)
		{
			case is_string($value):
				break;

			case is_object($value) && method_exists($value, '__toString'):
				$value = (string) $value;
				break;

			default:
				throw new \domainException('Output value should be a string');
		}

		$this->value = $value;
	}

	function __toString()
	{
		return $this->value;
	}

	function recipientOfOutputValueWithValueIs(self $outputValue, value\recipient $recipient)
	{
		$self = clone $this;
		$self->value .= $outputValue->value;

		$recipient->outputValueIs($self);

		return $this;
	}

	function ifIsNotEmptyOutputValue(callable $ifNotEmpty, callable $ifEmpty = null)
	{
		$this
			->valueIsEmpty()
				->ifFalse($ifNotEmpty)
				->ifTrue($ifEmpty ?: function() {})
		;

		return $this;
	}

	function ifIsEmptyOutputValue(callable $ifEmpty, callable $ifNotEmpty = null)
	{
		$this
			->valueIsEmpty()
				->ifTrue($ifEmpty)
				->ifFalse($ifNotEmpty ?: function() {})
		;

		return $this;
	}

	private function valueIsEmpty()
	{
		return boolean::fromExpression($this->value == '');
	}
}
