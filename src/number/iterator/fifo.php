<?php namespace fizzbuzz\number\iterator;

use
	fizzbuzz\number
;

class fifo
	implements
		number\iterator
{
	function __construct(number... $numbers)
	{
		$this->numbers = $numbers;
	}

	function recipientOfNumberIs(number\recipient $recipient)
	{
		foreach ($this->numbers as $number)
		{
			$recipient->numberIs($number);
		}

		return $this;
	}
}
