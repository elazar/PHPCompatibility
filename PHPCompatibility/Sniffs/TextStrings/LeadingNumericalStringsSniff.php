<?php
/**
 * PHPCompatibility, an external standard for PHP_CodeSniffer.
 *
 * @package   PHPCompatibility
 * @copyright 2012-2020 PHPCompatibility Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCompatibility/PHPCompatibility
 */

namespace PHPCompatibility\Sniffs\TextStrings;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;
use PHPCompatibility\Sniff;
use PHPCSUtils\Utils\Numbers;

/**
 * PHP 8.0 modified how leading numerical string literals may be interpreted.
 *
 * PHP version 8.0
 *
 * @link https://wiki.php.net/rfc/saner-numeric-strings
 *
 * @since 10.0.0
 */
class LeadingNumericalStringsSniff extends Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @since 10.0.0
     *
     * @return array
     */
    public function register()
    {
        return [
            \T_CONSTANT_ENCAPSED_STRING,
        ];
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @since 10.0.0
     *
     * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
     * @param int                         $stackPtr  The position of the current token in
     *                                               the stack.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        $content = \trim($tokens[$stackPtr]['content'], '"\'');
        $trimmed = \rtrim($content);

        // If the string is non-numerical or has no trailing whitespace, ignore it
        if (Numbers::getDecimalValue($trimmed) === false
            || $content === $trimmed) {
            return;
        }

        // Find the first non-empty token preceding the numerical string
        $prevPtr = $phpcsFile->findPrevious(
            Tokens::$emptyTokens,
            $stackPtr - 1,
            null,
            true
        );

        // If the preceding token is a numeric typecast, the numerical string can be ignored
        if ($tokens[$prevPtr]['code'] === \T_INT_CAST
            || $tokens[$prevPtr]['code'] === \T_DOUBLE_CAST) {
            return;
        }

        $isError = $this->supportsAbove('8.0');
        $this->addMessage(
            $phpcsFile,
            'Numerical strings with trailing whitespace can be considered malformed in PHP 8. Found: %s',
            $stackPtr,
            $isError,
            'Found',
            [$content]
        );
    }
}
