<?php namespace fizzbuzz\analyzer\iterator;

use
	fizzbuzz\boolean,
	fizzbuzz\analyzer
;

class fifo
	implements
		analyzer\iterator
{
	private
		$analyzers,
		$break
	;

	function __construct(analyzer... $analyzers)
	{
		$this->analyzers = $analyzers;
	}

	function recipientOfAnalyzerIs(analyzer\iterator\recipient $recipient)
	{
		$iterator = clone $this;

		foreach ($iterator->analyzers as $analyzer)
		{
			$iterator->break = false;

			$recipient->iteratorHasAnalyzer($iterator, $analyzer);

			if ($iterator->break)
			{
				break;
			}
		}

		return $this;
	}

	function recipientOfAnalyzerGoAway()
	{
		$this->break = true;

		return $this;
	}
}
