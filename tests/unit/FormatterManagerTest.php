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
        $sut = new FormatterManager(
            [$this->getPhpCsFormatterMock()]
        );

        $sut->execute('code');

    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getPhpCsFormatterMock()
    {
        $mock = $this->getMockBuilder(PhpCsFormatter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->exactly(1))
            ->method('formatCode')
            ->willReturn('code');

        return $mock;
    }
}