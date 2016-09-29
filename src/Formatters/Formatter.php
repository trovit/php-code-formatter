<?php
namespace Trovit\PhpCodeFormatter\Formatters;

/**
 * Class Formatter
 * @package Trovit\PhpCodeFormatter\Formatters
 */
abstract class Formatter
{
    /**
     * @param string $code
     * @return string $formattedCode
     * @throws \Exception
     */
    public abstract function formatCode($code);
}
