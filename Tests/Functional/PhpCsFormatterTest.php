<?php
namespace Trovit\PhpCodeFormatter\Tests\Functional;

use Trovit\PhpCodeFormatter\Formatters\PhpCsFormatter;
use Trovit\TemporaryFilesystem\FileHandler;

/**
 * Class PhpCsFormatterTest
 *
 * @package Kolekti\PhpCodeValidatorBundle\Tests\Model
 */
class PhpCsFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PhpCsFormatter
     */
    private $su;

    /**
     * Sets up the required objects
     */
    protected function setUp()
    {
        $this->su = new PhpCsFormatter(new FileHandler(__DIR__.'/../Resources/'));
    }

    public function testFormatCode()
    {
        $code = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $this->su->formatCode($code);
        $expectedCode = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $this->assertEquals($expectedCode, $formattedCode);
    }

    public function testFormatCodeAlreadyFormattedCode()
    {
        $code = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $formattedCode = $this->su->formatCode($code);
        $this->assertEquals($code, $formattedCode);
    }
}
