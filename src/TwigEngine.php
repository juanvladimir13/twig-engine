<?php

/**
 * @author juanvladimir13 <juanvladimir13@gmail.com>
 * @see https://github.com/juanvladimir13
 */

declare(strict_types=1);

namespace TwigEngine;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use TwigEngine\Plugin\Functions;

class TwigEngine
{
    private $options;

    private $twig;
    private $loader;
    private static $engine;

    private function __construct()
    {
        $this->options = TWIG_ENGINE_ENV;
        $this->loader = new FilesystemLoader([], TWIG_ENGINE_ROOTPATH);
    }

    private static function getInstance()
    {
        if (!isset(self::$engine)) {
            self::$engine = new self();
        }

        return self::$engine;
    }

    public static function addPathsWithNamespace(array $paths): void
    {
        foreach ($paths as $namespace => $path) {
            try {
                self::getInstance()->loader->addPath($path, $namespace);
            } catch (LoaderError $e) {
                echo $e->getMessage();
                break;
            }
        }
    }

    public static function addPathWithNamespace(string $path, string $namespace): void
    {
        try {
            self::getInstance()->loader->addPath($path, $namespace);
        } catch (LoaderError $e) {
            echo $e->getMessage();
        }
    }

    public static function createEnvironment(): void
    {
        self::getInstance()->twig = new Environment(self::getInstance()->loader, self::getInstance()->options);
        self::getInstance()->twig->addFunction(Functions::randomId());
    }

    public static function render(string $template, array $context = [], string $typeFile = '.html'): string
    {
        try {
            return self::getInstance()->twig->render($template . $typeFile, $context);
        } catch (LoaderError|SyntaxError|RuntimeError $e) {
            return $e->getMessage();
        }
    }

    public static function renderBlock(string $template, string $blockname, array $context = []): string
    {
        try {
            $tpl = self::getInstance()->twig->load($template);
        } catch (LoaderError|SyntaxError|RuntimeError $e) {
            echo $e->getMessage();
            $tpl = null;
        }

        return $tpl != null ? $tpl->renderBlock($blockname, $context) : '';
    }
}
