<?php

// OK: numeric strings with no whitespace
$a = '6.674_083e-11'; // float
$a = '6.674_083e+11'; // float
$a = '299_792_458';   // decimal
$a = '0xCAFE_F00D';   // hexadecimal
$a = '0b0101_1111';   // binary
$a = '0137_041';      // octal

// OK: numeric strings with leading whitespace
$a = ' 6.674_083e-11'; // float
$a = ' 6.674_083e+11'; // float
$a = ' 299_792_458';   // decimal
$a = ' 0xCAFE_F00D';   // hexadecimal
$a = ' 0b0101_1111';   // binary
$a = ' 0137_041';      // octal

// OK: Numeric strings with trailing whitespace and a leading typecast
$a = (float) '6.674_083e-11 '; // float
$a = (float) '6.674_083e+11 '; // float
$a = (int) '299_792_458 ';   // decimal
$a = (int) '0xCAFE_F00D ';   // hexadecimal
$a = (int) '0b0101_1111 ';   // binary
$a = (int) '0137_041 ';      // octal

// Numeric strings with trailing whitespace and no leading typecast
$a = '6.674_083e-11 '; // float
$a = '6.674_083e+11 '; // float
$a = '299_792_458 ';   // decimal
$a = '0xCAFE_F00D ';   // hexadecimal
$a = '0b0101_1111 ';   // binary
$a = '0137_041 ';      // octal
