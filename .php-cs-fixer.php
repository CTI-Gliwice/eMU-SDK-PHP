<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()->in(__DIR__)->name('*.php')->name('*.ngcs')->exclude('vendor')->exclude('resources')->exclude('storage')->notPath('cache');

$config = [
	'array_indentation' => true,
	'binary_operator_spaces' => ['default' => 'single_space'],
	'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
	'no_trailing_whitespace' => true,
	'whitespace_after_comma_in_array' => true,
];

return (new Config())->setRules($config)->setIndent("\t")->setLineEnding("\n")->setFinder($finder);