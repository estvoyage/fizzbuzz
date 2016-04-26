<?php namespace fizzbuzz\tests\units;

use
	atoum\mock
;

class test extends \atoum
{
	function beforeTestMethod($method)
	{
		mock\controller::disableAutoBindForNewMock();

		$this->mockGenerator->allIsInterface();

		return parent::beforeTestMethod($method);
	}
}
