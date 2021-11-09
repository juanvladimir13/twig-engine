<?php
/**
 * @author juanvladimir13 <juanvladimir13@gmail.com>
 * @see https://github.com/juanvladimir13
 */


namespace TwigEngine;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
// crear esta class como un singleton, parametrizado con variables globales
//
class TwigEngine
{
  private array $paths;
  private array $options;

  private Environment $twig;
  private FilesystemLoader $loader;

  public function __construct(string $rootPath = null, array $paths = [])
  {
    $this->options = TWIG_ENGINE_ENV;
    $this->paths = $paths;
    $this->loader = new FilesystemLoader($paths, $rootPath);
  }

  public function addPathsWithNamespace(array $paths)
  {
    foreach ($paths as $namespace => $path) {
      try {
        $this->loader->addPath($path, $namespace);
      } catch (LoaderError $e) {
        echo $e->getMessage();
        break;
      }
    }
  }

  public function addPathWithNamespace(string $path, string $namespace)
  {
    try {
      $this->loader->addPath($path, $namespace);
    } catch (LoaderError $e) {
      echo $e->getMessage();
    }
  }

  public function createEnvironment(): void
  {
    $this->twig = new Environment($this->loader, $this->options);
  }

  public function render(string $template, array $context): string
  {
    try {
      return $this->twig->render($template, $context);
    } catch (LoaderError | SyntaxError | RuntimeError $e) {
      return $e->getMessage();
    }
  }

  public function renderBlock(string $template, string $blockname, array $context): string
  {
    try {
      $tpl = $this->twig->load($template);
    } catch (LoaderError | SyntaxError | RuntimeError $e) {
      echo $e->getMessage();
      $tpl = null;
    }

    return $tpl != null ? $tpl->renderBlock($blockname, $context) : '';
  }
}