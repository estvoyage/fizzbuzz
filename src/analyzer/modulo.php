<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz
;

class modulo
	implements
		fizzbuzz\analyzer
{
	private
		$modulo,
		$outputValue
	;

	function __construct(fizzbuzz\number\modulo $modulo, fizzbuzz\output\value $outputValue)
	{
		$this->modulo = $modulo;
		$this->outputValue = $outputValue;
	}

	function analyzerControllerHasNumber(fizzbuzz\analyzer\controller $controller, fizzbuzz\number $number)
	{
		$number->ifHasModulo($this->modulo, function() use ($controller) {
				$controller->outputValueOfNumberIs($this->outputValue);
			}
		);

		return $this;
	}
}
