<?php
namespace Trovit\PhpCodeFormatter\Tests\Unit;

use Trovit\PhpCodeFormatter\Formatters\PhpCsFormatter;
use Trovit\PhpCodeFormatter\Managers\FormatterManager;

/**
 * Class FileManagerTest
 *
 * @package Trovit\PhpCodeFormatter\Tests\Model
 */
class FormatterManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $expectedFormattedCode = 'formatted code';
        $sut = new FormatterManager(
            [$this->getPhpCsFormatterMock($expectedFormattedCode)]
        );
        $formattedCode = $sut->execute('code');

        static::assertEquals($expectedFormattedCode, $formattedCode);
    }

    /**
     * @param $formattedCode
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getPhpCsFormatterMock($formattedCode)
    {
        $mock = $this->getMockBuilder(PhpCsFormatter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->exactly(1))
            ->method('formatCode')
            ->willReturn($formattedCode);

        return $mock;
    }
}