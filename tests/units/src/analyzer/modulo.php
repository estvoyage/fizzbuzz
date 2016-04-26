<?php namespace fizzbuzz\tests\units\analyzer;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	mock\fizzbuzz as mockOfFizzbuzz
;

class modulo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\analyzer')
		;
	}

	function testControllerHasNumber()
	{
		$this
			->given(
				$controller = new mockOfFizzbuzz\analyzer\controller,
				$controllerNumber = new mockOfFizzbuzz\number,
				$analyzerModulo = new mockOfFizzbuzz\number\modulo,
				$outputValue = new mockOfFizzbuzz\output\value
			)
			->if(
				$this->calling($controllerNumber)->ifHasModulo = function($modulo, $callable) use ($analyzerModulo) {
					if ($modulo === $analyzerModulo)
					{
						$callable();
					}
				},
				$this->newTestedInstance($analyzerModulo, $outputValue)
			)
			->then
				->object($this->testedInstance->analyzerControllerHasNumber($controller, $controllerNumber))
					->isEqualTo($this->newTestedInstance($analyzerModulo, $outputValue))
				->mock($controller)
					->receive('outputValueOfNumberIs')
						->withIdenticalArguments($outputValue)
							->once
		;
	}
}
