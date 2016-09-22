<?php
namespace Trovit\PhpCodeFormatter\Tests\Model;

use Trovit\PhpCodeFormatter\Managers\FormatterManager;
use Trovit\PhpCodeFormatter\Tests\Mocks\PhpCsFormatterMock;

/**
 * Class FileManagerTest
 *
 * @package Trovit\PhpCodeFormatter\Tests\Model
 */
class FormatterManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PhpCsFormatterMock
     */
    private $phpCsFormatterMock;

    public function setUp()
    {
        $this->phpCsFormatterMock = new PhpCsFormatterMock($this);
    }

    public function testExecute()
    {
        $su = new FormatterManager(
            [$this->phpCsFormatterMock->getFormatterManagerExecuteMock()]
        );

        $su->execute('code');

    }
}