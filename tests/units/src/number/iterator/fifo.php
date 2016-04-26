<?php namespace fizzbuzz\tests\units\number\iterator;

require __DIR__ . '/../../../runner.php';

use
	fizzbuzz\tests\units,
	mock\fizzbuzz as mockOfFizzbuzz
;

class fifo extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('fizzbuzz\number\iterator')
		;
	}

	function testRecipientOfNumberIs()
	{
		$this
			->given(
				$aNumber = new mockOfFizzbuzz\number,
				$bNumber = new mockOfFizzbuzz\number,
				$cNumber = new mockOfFizzbuzz\number,

				$recipient = new mockOfFizzbuzz\number\recipient
			)
			->if(
				$this->newTestedInstance($aNumber, $bNumber, $cNumber)
			)
			->then
				->object($this->testedInstance->recipientOfNumberIs($recipient))
					->isEqualTo($this->newTestedInstance($aNumber, $bNumber, $cNumber))
				->mock($recipient)
					->receive('numberIs')
						->withIdenticalArguments($aNumber)
							->once
						->withIdenticalArguments($bNumber)
							->once
						->withIdenticalArguments($cNumber)
							->once
		;
	}
}
