<?php
namespace Trovit\PhpCodeFormatter\Formatters;

/**
 * Class Formatter
 * @package Trovit\PhpCodeFormatter\Formatters
 */
interface Formatter
{
    /**
     * @param string $code
     * @return string $formattedCode
     * @throws \Exception
     */
    public function formatCode($code);
}
