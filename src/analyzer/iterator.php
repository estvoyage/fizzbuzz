<?php namespace fizzbuzz\analyzer;

use
	fizzbuzz\boolean
;

interface iterator
{
	function recipientOfAnalyzerIs(iterator\recipient $recipient);
	function booleanAboutContinuationOfIterationIs(boolean $boolean);
}
