<?php namespace fizzbuzz\controller;

use
	fizzbuzz\analyzer,
	fizzbuzz\output,
	fizzbuzz\number
;

class payload
	implements
		analyzer\controller
{
	private
		$analyzer,
		$output,
		$outputValue
	;

	function __construct(analyzer $analyzer, output $output)
	{
		$this->analyzer = $analyzer;
		$this->output = $output;
	}

	function numberIs(number $number)
	{
		$payload = clone $this;
		$payload->outputValue = new output\value;

		$payload->analyzer->analyzerControllerHasNumber($payload, $number);

		$payload->output->outputValueIs($payload->outputValue);

		return $this;
	}

	function outputValueOfNumberIs(output\value $outputValue)
	{
		$this->outputValue = $outputValue;

		return $this;
	}
}
