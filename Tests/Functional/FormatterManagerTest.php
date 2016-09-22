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
        $su = new FormatterManager(
            [new PhpCsFormatter(new FileHandler(__DIR__.'/../Resources/'))]
        );
        $code = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $su->execute($code);
        $expectedCode = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/expectedBadIndentationCode.txt');
        $this->assertEquals($formattedCode, $expectedCode);
    }

    public function testFormatCodeWithoutFormatters(){
        $su = new FormatterManager([]);
        $code = file_get_contents(__DIR__.'/../Resources/PhpCodeFiles/badIndentationCode.txt');
        $formattedCode = $su->execute($code);
        $this->assertEquals($code, $formattedCode);
    }

    public function testFormatCodeWithBadFormatterClass(){
        $su = new FormatterManager([new \stdClass]);
        $this->expectException(BadClassProvidedException::class);
        $su->execute('');
    }
}
