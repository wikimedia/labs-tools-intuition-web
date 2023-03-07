<?php
return [
	'target_php_version' => '7.4',

	'directory_list' => [
		'public_html/',
		'vendor/krinkle/'
	],

	'exclude_analysis_directory_list' => [
		'vendor/'
	],

	// A list of plugin files to execute.
	//
	// Documentation about available bundled plugins can be found
	// at https://github.com/phan/phan/tree/v3/.phan/plugins
	//
	'plugins' => [
		// Recommended set from mediawiki-phan-config
		'AddNeverReturnTypePlugin',
		'DuplicateArrayKeyPlugin',
		'DuplicateExpressionPlugin',
		'LoopVariableReusePlugin',
		'PregRegexCheckerPlugin',
		'RedundantAssignmentPlugin',
		'SimplifyExpressionPlugin',
		'UnreachableCodePlugin',
		'UnusedSuppressionPlugin',
		'UseReturnValuePlugin',

		// Extra ones:
		// 'AlwaysReturnPlugin',
		// 'DollarDollarPlugin',
		// 'EmptyStatementListPlugin',
		// 'PrintfCheckerPlugin',
		// 'SleepCheckerPlugin',
	],

	'suppress_issue_types' => [
		// 'PhanPluginDuplicateExpressionAssignmentOperation',
		// 'PhanTypeMismatchDimFetch',
		// 'PhanTypePossiblyInvalidDimOffset',
		// 'PhanTypeArraySuspiciousNullable',
	],
];
