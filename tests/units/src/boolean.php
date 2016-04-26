<?php namespace fizzbuzz\tests\units;

require __DIR__ . '/../runner.php';

use
	fizzbuzz\tests\units,
	fizzbuzz\boolean as testedClass
;

class boolean extends units\test
{
	function testFromExpression()
	{
		$this
			->object(testedClass::fromExpression(true))
				->isEqualTo(new testedClass\true)
			->object(testedClass::fromExpression(false))
				->isEqualTo(new testedClass\false)
		;
	}
}
