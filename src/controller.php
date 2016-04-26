<?php namespace fizzbuzz;

class controller
	implements
		analyzer\controller,
		number\recipient
{
	private
		$analyzer,
		$payload
	;

	function __construct(analyzer $analyzer)
	{
		$this->analyzer = $analyzer;
		$this->payload = new nill;
	}

	function outputForNumberIs(number $number, output $output)
	{
		$this
			->outputIs($output)
				->numberIs($number)
		;

		return $this;
	}

	function outputValueOfNumberIs(output\value $value)
	{
		$this->outputValue = $value;

		return $this;
	}

	function outputForNumberIteratorIs(number\iterator $iterator, output $output)
	{
		$iterator->recipientOfNumberIs($this->outputIs($output));

		return $this;
	}

	function numberIs(number $number)
	{
		$this->payload->numberIs($number);

		return $this;
	}

	private function outputIs(output $output)
	{
		$controller = clone $this;
		$controller->payload = new controller\payload($this->analyzer, $output);

		return $controller;
	}
}
