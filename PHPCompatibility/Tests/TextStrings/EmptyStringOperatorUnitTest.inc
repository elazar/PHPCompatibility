<?php

// OK: operators with no empty string operands
$a = 0 - 0;
$a = 0 + 0;
$a = 0 * 0;
$a = 0 / 0;
$a = 0 % 0;
$a = 0 ** 0;
$a = 0 <=> 0;
$a = 0 ?? 0;
$a = 0 & 0;
$a = 0 ^ 0;
$a = 0 << 0;
$a = 0 >> 0;

// Right operand is the empty string
$a = 0 - '';
$a = 0 + '';
$a = 0 * '';
$a = 0 / '';
$a = 0 % '';
$a = 0 ** '';
$a = 0 <=> '';
$a = 0 ?? '';
$a = 0 & '';
$a = 0 ^ '';
$a = 0 << '';
$a = 0 >> '';

// Left operand is the empty string
$a = '' - 0;
$a = '' + 0;
$a = '' * 0;
$a = '' / 0;
$a = '' % 0;
$a = '' ** 0;
$a = '' <=> 0;
$a = '' ?? 0;
$a = '' & 0;
$a = '' ^ 0;
$a = '' << 0;
$a = '' >> 0;
