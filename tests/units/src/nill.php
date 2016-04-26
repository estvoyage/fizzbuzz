<?php namespace fizzbuzz\tests\units;

require __DIR__ . '/../runner.php';

use
	fizzbuzz\tests\units
;

class nill extends units\test
{
	function testCall()
	{
		$this->object($this->newTestedInstance->{uniqid()}(uniqid(), uniqid()))->isTestedInstance;
	}
}
