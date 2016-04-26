<?php namespace fizzbuzz\tests\units\output;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\boolean,
	mock\fizzbuzz as mockOfFizzbuzz
;

class value extends units\test
{
	/**
	 * @dataProvider invalidValueProvider
	 */
	function testWithInvalidValue($value)
	{
		$this
			->exception(function() use ($value) { $this->newTestedInstance($value); })
				->isInstanceOf('domainException')
				->hasMessage('Output value should be a string')
		;
	}

	function testRecipientOfOutputValueWithValueIs()
	{
		$this
			->given(
				$value = $this->newTestedInstance,
				$recipient = new mockOfFizzbuzz\output\value\recipient
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->recipientOfOutputValueWithValueIs($value, $recipient))
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('outputValueIs')
						->withArguments($this->newTestedInstance)
							->once

			->given(
				$value = $this->newTestedInstance('b'),
				$this->newTestedInstance
			)
			->if(
				$this->testedInstance->recipientOfOutputValueWithValueIs($value, $recipient)
			)
			->then
				->mock($recipient)
					->receive('outputValueIs')
						->withArguments($this->newTestedInstance('b'))
							->once

			->given(
				$this->newTestedInstance('a')
			)
			->if(
				$this->testedInstance->recipientOfOutputValueWithValueIs($value, $recipient)
			)
			->then
				->mock($recipient)
					->receive('outputValueIs')
						->withArguments($this->newTestedInstance('ab'))
							->once
		;
	}

	function testIfIsNotEmptyOutputValue()
	{
		$this
			->given(
				$recipient = new mockOfFizzbuzz\boolean\recipient,
				$outputValue = $this->newTestedInstance,
				$callable = function() use (& $called) { $called = true; },
				$called = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsNotEmptyOutputValue($callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($called)
					->isFalse

			->given(
				$this->newTestedInstance(uniqid())
			)
			->if(
				$this->testedInstance->ifIsNotEmptyOutputValue($callable)
			)
			->then
				->boolean($called)
					->isTrue
		;
	}

	function testIfIsEmptyOutputValue()
	{
		$this
			->given(
				$recipient = new mockOfFizzbuzz\boolean\recipient,
				$outputValue = $this->newTestedInstance,
				$ifEmpty = function() use (& $empty) { $empty = true; },
				$empty = false,
				$ifNotEmpty = function() use (& $notEmpty) { $notEmpty = true; },
				$notEmpty = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifIsEmptyOutputValue($ifEmpty))
					->isEqualTo($this->newTestedInstance)
				->boolean($empty)
					->isTrue

			->given(
				$this->newTestedInstance(uniqid()),
				$empty = false
			)
			->if(
				$this->testedInstance->ifIsEmptyOutputValue($ifEmpty, $ifNotEmpty)
			)
			->then
				->boolean($empty)
					->isFalse
				->boolean($notEmpty)
					->isTrue
		;
	}

	protected function invalidValueProvider()
	{
		return [
			true,
			false,
			null,
			rand(- PHP_INT_MAX, 1),
			0,
			rand(1, PHP_INT_MAX),
			(float) rand(- PHP_INT_MAX, 1),
			0.,
			M_PI,
			(float) rand(1, PHP_INT_MAX)
			[ [] ],
			new \stdclass
		];
	}
}
