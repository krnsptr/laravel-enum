<?php

$finder = \PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
    ])
    ->in(__DIR__);

$config = new \PhpCsFixer\Config();

return $config
    ->setFinder($finder)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache')
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'array_push' => true,
        'no_alias_functions' => true,
        'no_alias_language_construct_call' => true,
        'no_mixed_echo_print' => true,
        'pow_to_exponentiation' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_trailing_comma_in_singleline_array' => true,
        'no_whitespace_before_comma_in_array' => true,
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        'braces' => true,
        'octal_notation' => true,
        'cast_spaces' => ['space' => 'single'],
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'one',
                'method' => 'one',
                'property' => 'one',
                'trait_import' => 'none',
            ],
        ],
        'class_definition' => [
            'multi_line_extends_each_single_line' => true,
            'single_item_single_line' => true,
        ],
        'no_blank_lines_after_class_opening' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant',
                'property',
                'construct',
                'destruct',
                'magic',
                'phpunit',
                'method',
            ],
        ],
        'control_structure_continuation_position' => true,
        'no_break_comment' => true,
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arrays', 'arguments'],
        ],
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
            'sort_algorithm' => 'alpha',
        ],
        'explicit_indirect_variable' => true,
        'single_space_after_construct' => true,
        'list_syntax' => ['syntax' => 'short'],
        'assign_null_coalescing_to_coalesce_equal' => true,
        'binary_operator_spaces' => true,
        'concat_space' => ['spacing' => 'one'],
        'operator_linebreak' => true,
        'ternary_operator_spaces' => true,
        'unary_operator_spaces' => true,
        'no_empty_statement' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'array_indentation' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'case',
                'continue',
                'default',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'use',
                'use_trait',
            ],
        ],
        'method_chaining_indentation' => true,
        'no_spaces_around_offset' => true,
    ]);
