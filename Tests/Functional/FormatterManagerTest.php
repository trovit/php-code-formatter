<?php
namespace Trovit\PhpCodeFormatter\Tests\Functional;

use Trovit\PhpCodeFormatter\Exception\BadClassProvidedException;
use Trovit\PhpCodeFormatter\Formatters\PhpCsFormatter;
use Trovit\PhpCodeFormatter\Managers\FormatterManager;
use Trovit\TemporaryFilesystem\FileHandler;

/**
 * Class FormatterManagerTest
 *
 * @package Kolekti\PhpCodeValidatorBundle\Tests\Model
 */
class FormatterManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testExecuteManager()
    {
        $sut = new FormatterManager(
            [new PhpCsFormatter(new FileHandler(__DIR__.'/../resources/'))]
        );
        $code = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $sut->execute($code);
        $expectedCode = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $this->assertEquals($formattedCode, $expectedCode);
    }

    public function testFormatCodeWithoutFormatters(){
        $sut = new FormatterManager([]);
        $code = file_get_contents(__DIR__.'/../resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $sut->execute($code);
        $this->assertEquals($code, $formattedCode);
    }

    public function testFormatCodeWithBadFormatterClass(){
        $sut = new FormatterManager([new \stdClass]);
        $this->expectException(BadClassProvidedException::class);
        $sut->execute('');
    }
}
