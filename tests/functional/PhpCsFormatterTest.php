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
    private $sut;

    /**
     * Sets up the required objects
     */
    protected function setUp()
    {
        $this->sut = new PhpCsFormatter(new FileHandler(__DIR__.'/../resources/'));
    }

    public function testFormatCode()
    {
        $code = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $this->sut->formatCode($code);
        $expectedCode = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $this->assertEquals($expectedCode, $formattedCode);
    }

    public function testFormatCodeAlreadyFormattedCode()
    {
        $code = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $formattedCode = $this->sut->formatCode($code);
        $this->assertEquals($code, $formattedCode);
    }
}
