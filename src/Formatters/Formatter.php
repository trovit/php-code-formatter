<?php
namespace Trovit\PhpCodeFormatter\Formatters;

use Trovit\TemporaryFilesystem\FileHandler;

/**
 * Class Formatter
 * @package Trovit\PhpCodeFormatter\Formatters
 */
abstract class Formatter
{
    /**
     * @var FileHandler
     */
    protected $fileHandler;

    /**
     * PhpFormatterValidatorTool constructor.
     * @param FileHandler $fileHandler
     */
    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
    }

    /**
     * @param string $code
     * @return string $formattedCode
     * @throws \Exception
     */
    public abstract function formatCode($code);
}
