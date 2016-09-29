<?php
namespace Trovit\PhpCodeFormatter\Formatters;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\CS\Config;
use Symfony\CS\ConfigurationResolver;
use Symfony\CS\ErrorsManager;
use Symfony\CS\Fixer;
use Trovit\TemporaryFilesystem\FileHandler;

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
     * @var FileHandler
     */
    private $fileHandler;

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
    public function formatCode($code)
    {
        $filePath = $this->fileHandler->createTemporaryFileFromString($code);

        $defaultConfig = new Config();
        $errorsManager = new ErrorsManager();
        $fixer = new Fixer();

        $fixer->registerBuiltInFixers();
        $fixer->registerBuiltInConfigs();
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
        $fixer->fix($config, false, false);
        $formattedCode = $this->fileHandler->getFileContent($filePath);
        $this->fileHandler->deleteTemporaryFile($filePath);

        return $formattedCode;
    }
}
