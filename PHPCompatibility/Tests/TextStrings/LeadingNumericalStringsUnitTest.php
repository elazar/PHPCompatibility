<?php
/**
 * PHPCompatibility, an external standard for PHP_CodeSniffer.
 *
 * @package   PHPCompatibility
 * @copyright 2012-2020 PHPCompatibility Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCompatibility/PHPCompatibility
 */

namespace PHPCompatibility\Tests\TextStrings;

use PHPCompatibility\Tests\BaseSniffTest;

/**
 * Test the LeadingNumericalStrings sniff.
 *
 * @group leadingNumericalStrings
 * @group textStrings
 *
 * @covers \PHPCompatibility\Sniffs\Numbers\LeadingNumericalStringsSniff
 *
 * @since 10.0.0
 */
class LeadingNumericalStringsUnitTest extends BaseSniffTest
{
    /**
     * Test recognizing numerical strings with trailing whitespace and no leading numeric typecast.
     *
     * @dataProvider dataLeadingNumericalStrings
     *
     * @param array $line The line number on which the error should occur.
     *
     * @return void
     */
    public function testLeadingNumericalStrings($line)
    {
        $file = $this->sniffFile(__FILE__, '8.0');
        $this->assertError($file, $line, 'Numerical strings with trailing whitespace can be considered malformed in PHP 8. Found:');
    }

    /**
     * Data provider.
     *
     * @see testLeadingNumericalStrings()
     *
     * @return array
     */
    public function dataLeadingNumericalStrings()
    {
        $data = [];

        for ($i = 28; $i <= 33; $i++) {
            $data[] = [$i];
        }

        return $data;
    }

    /**
     * Verify there are no false positives for a PHP version on which this sniff throws errors.
     *
     * @dataProvider dataNoFalsePositives
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testNoFalsePositives($line)
    {
        $file = $this->sniffFile(__FILE__, '8.0');
        $this->assertNoViolation($file, $line);
    }

    /**
     * Data provider.
     *
     * @see testNoFalsePositives()
     *
     * @return array
     */
    public function dataNoFalsePositives()
    {
        $data = [];

        // No issues expected on the first 25 lines.
        for ($i = 1; $i <= 25; $i++) {
            $data[] = [$i];
        }

        return $data;
    }
}
