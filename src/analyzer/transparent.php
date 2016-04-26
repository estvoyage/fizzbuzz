<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz\analyzer,
	fizzbuzz\number,
	fizzbuzz\output
;

class transparent
	implements
		analyzer,
		output\value\recipient
{
	private
		$outputValue
	;

	function analyzerControllerHasNumber(analyzer\controller $controller, number $number)
	{
		$analyzer = clone $this;
		$analyzer->outputValue = new output\value;

		$number->recipientOfOutputValueIs($analyzer);

		$controller->outputValueOfNumberIs($analyzer->outputValue);

		return $this;
	}

	function outputValueIs(output\value $outputValue)
	{
		$this->outputValue = $outputValue;

		return $this;
	}
}
