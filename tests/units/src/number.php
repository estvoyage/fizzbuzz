<?php namespace fizzbuzz\tests\units;

require __DIR__ . '/../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz,
	fizzbuzz\output,
	mock\fizzbuzz as mockOfFizzbuzz
;

class number extends units\test
{
	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Value should be an integer')
		;
	}

	function testIfHasModulo()
	{
		$this
			->given(
				$modulo = new fizzbuzz\number\modulo(rand(1, PHP_INT_MAX)),
				$callable = function() use (& $called) { $called = true; },
				$called = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifHasModulo($modulo, $callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($called)->isTrue

			->given(
				$modulo = new fizzbuzz\number\modulo(1),
				$called = false
			)
			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->ifHasModulo($modulo, $callable))
					->isEqualTo($this->newTestedInstance(1))
				->boolean($called)->isTrue

			->given(
				$modulo = new fizzbuzz\number\modulo(2),
				$called = false
			)
			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->ifHasModulo($modulo, $callable))
					->isEqualTo($this->newTestedInstance(1))
				->boolean($called)->isFalse
		;
	}

	function testIfIsEqualToNumber()
	{
		$this
			->given(
				$number = $this->newTestedInstance,
				$callable = function() use (& $called) { $called = true; },
				$called = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEqualToNumber($number, $callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($called)->isTrue

			->given(
				$called = false
			)
			->if(
				$this->newTestedInstance(1)
			)
			->then
				->object($this->testedInstance->ifIsEqualToNumber($number, $callable))
					->isEqualTo($this->newTestedInstance(1))
				->boolean($called)->isFalse
		;
	}

	function testRecipientOfOutputValueIs()
	{
		$this
			->given(
				$recipient = new mockOfFizzbuzz\output\value\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOutputValueIs($recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('outputValueIs')
						->withArguments(new output\value('0'))
							->once
		;
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			'foo' . uniqid(),
			M_PI,
			[ [] ],
			new \stdclass
		];
	}
}
