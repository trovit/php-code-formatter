<?php
namespace Trovit\PhpCodeFormatter\Formatters;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\CS\Config;
use Symfony\CS\ConfigurationResolver;
use Symfony\CS\ErrorsManager;
use Symfony\CS\Fixer;

/**
 * Class PhpCsFormatter
 *
 * This class use the code sniffer fixer tool to beautify php code
 *
 * @package Trovit\PhpCodeFormatter\Formatters
 */
class PhpCsFormatter extends Formatter
{
    /**
     * @param string $code
     * @return string $formattedCode
     * @throws \Exception
     */
    public function formatCode($code)
    {
        $filePath = $this->fileHandler->createTemporaryFileFromString($code);

        $defaultConfig = new Config();
        $errorsManager = new ErrorsManager();
        $stopwatch = new Stopwatch();

        $fixer = new Fixer();
        $fixer->registerBuiltInFixers();
        $fixer->registerBuiltInConfigs();
        $fixer->setStopwatch($stopwatch);
        $fixer->setErrorsManager($errorsManager);

        $config = $defaultConfig;

        $config->finder(new \ArrayIterator(array(new \SplFileInfo($filePath))));

        $resolver = new ConfigurationResolver();

        $resolver
            ->setAllFixers($fixer->getFixers())
            ->setConfig($config)
            ->setOptions(array(
                'level' => null,
                'fixers' => null,
                'progress' => null,
            ))
            ->resolve();

        $config->fixers($resolver->getFixers());

        $stopwatch->start('fixFiles');

        $fixer->fix($config, false, false);

        $stopwatch->stop('fixFiles');

        $formattedCode = $this->fileHandler->getFileContent($filePath);

        $this->fileHandler->deleteTemporaryFile($filePath);

        return $formattedCode;
    }
}
