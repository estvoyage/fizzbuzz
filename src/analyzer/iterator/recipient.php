<?php namespace fizzbuzz\analyzer\iterator;

use
	fizzbuzz\analyzer
;

interface recipient
{
	function iteratorHasAnalyzer(analyzer\iterator $iterator, analyzer $analyzer);
}
