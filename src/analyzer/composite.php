<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz\analyzer,
	fizzbuzz\number,
	fizzbuzz\output,
	fizzbuzz\boolean,
	fizzbuzz\nill
;

class composite
	implements
		analyzer,
		analyzer\controller,
		analyzer\iterator\recipient,
		output\value\recipient
{
	private
		$analyzerIterator,
		$outputValue,
		$analyzerHandler,
		$analyzerOutputValue
	;

	function __construct(analyzer\iterator $analyzerIterator)
	{
		$this->analyzerIterator = $analyzerIterator;
	}

	function analyzerControllerHasNumber(analyzer\controller $controller, number $number)
	{
		$composite = clone $this;
		$composite->outputValue = new output\value;
		$composite->analyzerHandler = function($iterator, $analyzer) use ($composite, $number) {
			$composite->analyzerOutputValue = new output\value;

			$analyzer->analyzerControllerHasNumber($composite, $number);

			$composite
				->analyzerOutputValue
					->ifIsNotEmptyOutputValue(function() use ($composite) {
							$composite
								->outputValue
									->recipientOfOutputValueWithValueIs($composite->analyzerOutputValue, $composite)
							;
						},
						function() use ($composite, $iterator) {
							$composite->outputValue = new output\value;

							$iterator
								->booleanAboutContinuationOfIterationIs(new boolean\false)
							;
						}
					)
			;
		};

		$composite
			->analyzerIterator
				->recipientOfAnalyzerIs($composite)
		;

		$composite
			->outputValue
				->ifIsNotEmptyOutputValue(function() use ($controller, $composite) {
						$controller->outputValueOfNumberIs($composite->outputValue);
					}
				)
		;

		return $this;
	}

	function iteratorHasAnalyzer(analyzer\iterator $iterator, analyzer $analyzer)
	{
		call_user_func_array($this->analyzerHandler ?: function() {}, func_get_args());

		return $this;
	}

	function outputValueOfNumberIs(output\value $value)
	{
		$this->analyzerOutputValue = $value;

		return $this;
	}

	function outputValueIs(output\value $value)
	{
		$this->outputValue = $value;

		return $this;
	}
}
