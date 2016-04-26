<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz\analyzer,
	fizzbuzz\number,
	fizzbuzz\output
;

class concatenator
	implements
		analyzer,
		analyzer\iterator\recipient,
		analyzer\controller,
		output\value\recipient
{
	private
		$iterator,
		$outputValue,
		$analyzerHandler,
		$analyzerOutputValue
	;

	function __construct(analyzer\iterator $iterator)
	{
		$this->iterator = $iterator;
	}

	function analyzerControllerHasNumber(analyzer\controller $controller, number $number)
	{
		$concatenator = clone $this;
		$concatenator->outputValue = new output\value;
		$concatenator->analyzerHandler = function($analyzer) use ($concatenator, $number) {
			$concatenator->analyzerOutputValue = new output\value;

			$analyzer->analyzerControllerHasNumber($concatenator, $number);

			$concatenator->outputValue->recipientOfOutputValueWithValueIs($concatenator->analyzerOutputValue, $concatenator);
		};

		$concatenator->iterator->recipientOfAnalyzerIs($concatenator);

		$controller->outputValueOfNumberIs($concatenator->outputValue);

		return $this;
	}

	function iteratorHasAnalyzer(analyzer\iterator $iterator, analyzer $analyzer)
	{
		call_user_func_array($this->analyzerHandler ?: function() {}, [ $analyzer ]);

		return $this;
	}

	function outputValueOfNumberIs(output\value $outputValue)
	{
		$this->analyzerOutputValue = $outputValue;

		return $this;
	}

	function outputValueIs(output\value $outputValue)
	{
		$this->outputValue = $outputValue;

		return $this;
	}
}
