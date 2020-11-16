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
 * PHP 8.0 modified how the empty string is handled by operators.
 *
 * PHP version 8.0
 *
 * @link https://wiki.php.net/rfc/saner-numeric-strings
 *
 * @since 10.0.0
 */
class EmptyStringOperatorSniff extends Sniff
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
        return Tokens::$operators;
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
        // Find the two operands of the operator
        $prevPtr = $phpcsFile->findPrevious(
            Tokens::$emptyTokens,
            $stackPtr - 1,
            null,
            true,
            null,
            true
        );
        $nextPtr = $phpcsFile->findNext(
            Tokens::$emptyTokens,
            $stackPtr + 1,
            null,
            true,
            null,
            true
        );

        // If either operand is the empty string, emit an error
        $tokens = $phpcsFile->getTokens();
        $isError = $this->supportsAbove('8.0');
        foreach ([$prevPtr, $nextPtr] as $operandPtr) {
            $content = $tokens[$operandPtr]['content'];
            if ($content == "''" || $content == '""') {
                $this->addMessage(
                    $phpcsFile,
                    'The empty string is not interpreted as 0 by arithmetic and bitwise operators in PHP 8. Found: %s',
                    $operandPtr,
                    $isError,
                    'Found',
                    [$content]
                );
            }
        }
    }
}
