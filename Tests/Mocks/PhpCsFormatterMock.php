<?php
namespace Trovit\PhpCodeFormatter\Tests\Mocks;


use Trovit\PhpCodeFormatter\Formatters\PhpCsFormatter;

class PhpCsFormatterMock
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $testCase;

    /**
     * CodeParserExecutionApiClientMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->testCase = $testCase;
    }

    public function getBasicMock()
    {
        return $this->testCase->getMockBuilder(PhpCsFormatter::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function getFormatterManagerExecuteMock()
    {
        $mock = $this->getBasicMock();

        $mock
            ->expects($this->testCase->exactly(1))
            ->method('formatCode');

        return $mock;
    }
}