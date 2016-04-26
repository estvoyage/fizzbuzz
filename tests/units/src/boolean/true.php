<?php namespace fizzbuzz\tests\units\boolean;

require __DIR__ . '/../../runner.php';

use
	fizzbuzz\tests\units
;

class true extends units\test
{
	function testClass()
	{
		$this->testedClass
			->extends('fizzbuzz\boolean')
		;
	}

	function testIfTrue()
	{
		$this
			->given(
				$callable = function() use (& $called) {
					$called = true;
				},
				$called = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifTrue($callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($called)->isTrue
		;
	}

	function testIfFalse()
	{
		$this
			->given(
				$callable = function() use (& $called) {
					$called = true;
				},
				$called = false
			)
			->if(
				$this->newTestedInstance
			)
			->then
				->object($this->testedInstance->ifFalse($callable))
					->isEqualTo($this->newTestedInstance)
				->boolean($called)->isFalse
		;
	}
}
