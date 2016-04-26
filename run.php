<?php

namespace fizzbuzz;

require __DIR__ . '/vendor/autoload.php';

(new controller(
		new analyzer\meta(
			new analyzer\iterator\fifo(
				new analyzer\concatenator(
					new analyzer\iterator\fifo(
						new analyzer\modulo(new number\modulo(3), new output\value('Fizz')),
						new analyzer\modulo(new number\modulo(5), new output\value('Buzz')),
						new analyzer\modulo(new number\modulo(7), new output\value('Bang'))
					)
				),
				new analyzer\transparent
			)
		)
	)
)
	->outputForNumberIteratorIs(
		new number\iterator\fifo(
			new number,
			new number(1),
			new number(3),
			new number(4),
			new number(5),
			new number(6),
			new number(7),
			new number(3 * 5),
			new number(3 * 7),
			new number(5 * 7),
			new number(3 * 5 * 7)
		),
		new output\stdout
	)
;
