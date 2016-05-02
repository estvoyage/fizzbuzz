<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz\analyzer,
	fizzbuzz\number,
	fizzbuzz\output
;

class meta
	implements
		analyzer,
		analyzer\iterator\recipient,
		analyzer\controller
{
	private
		$iterator,
		$outputValue,
		$analyzerHandler
	;

	function __construct(iterator $iterator)
	{
		$this->iterator = $iterator;
		$this->outputValue = new output\value;
	}

	function analyzerControllerHasNumber(analyzer\controller $controller, number $number)
	{
		$meta = clone $this;
		$meta->outputValue = new output\value;
		$meta->analyzerHandler = function($iterator, $analyzer) use ($meta, $number) {
			$analyzer->analyzerControllerHasNumber($meta, $number);

			$meta->outputValue->ifIsNotEmptyOutputValue(function() use ($iterator) {
					$iterator->recipientOfAnalyzerGoAway();
				}
			);
		};

		$meta->iterator->recipientOfAnalyzerIs($meta);

		$meta->outputValue->ifIsNotEmptyOutputValue(function() use ($controller, $meta) {
				$controller->outputValueOfNumberIs($meta->outputValue);
			}
		);

		return $this;
	}

	function iteratorHasAnalyzer(analyzer\iterator $iterator, analyzer $analyzer)
	{
		call_user_func_array($this->analyzerHandler ?: function() {}, [ $iterator, $analyzer ]);

		return $this;
	}

	function outputValueOfNumberIs(output\value $outputValue)
	{
		$this->outputValue = $outputValue;

		return $this;
	}
}
