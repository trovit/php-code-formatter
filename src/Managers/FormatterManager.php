<?php
namespace Trovit\PhpCodeFormatter\Managers;

use Trovit\PhpCodeFormatter\Exception\BadClassProvidedException;
use Trovit\PhpCodeFormatter\Formatters\Formatter;

/**
 * Class FormatterManager
 *
 * This class execute all the formatters in the config
 *
 * @package Trovit\PhpCodeFormatter\Managers
 */
class FormatterManager
{
    /**
     * @var Formatter[]
     */
    private $formatterClasses;

    /**
     * FormatterManager constructor.
     * @param Formatter[] $formatterClasses
     */
    public function __construct(array $formatterClasses)
    {
        $this->formatterClasses = $formatterClasses;
    }

    /**
     * Format code using configured formatters
     *
     * @param string $code
     * @return string $code formatted code
     * @throws BadClassProvidedException
     */
    public function execute($code)
    {
        for ($i = 0, $max = count($this->formatterClasses); $i < $max; $i++) {
            $formatter = $this->formatterClasses[$i];
            if(!$formatter instanceof Formatter){
                throw new BadClassProvidedException('Class should be a formatter');
            }
            $code = $formatter->formatCode($code);
        }
        return $code;
    }
}
