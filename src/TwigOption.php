<?php

/**
 * @author juanvladimir13 <juanvladimir13@gmail.com>
 * @see https://github.com/juanvladimir13
 */

declare(strict_types=1);

namespace TwigEngine;

class TwigOption
{
    private $options;

    public function __construct()
    {
        $this->options = [
            'debug' => false,
            'charset' => 'UTF-8',
            'strict_variables' => false,
            'autoescape' => 'html',
            'cache' => false,
            'auto_reload' => false,
            'optimizations' => -1,
        ];
    }

    /** @param string|bool $cache */
    public function setCache($cache): void
    {
        $this->options['cache'] = $cache;
    }

    public function setDebug(bool $debug = false): void
    {
        $this->options['debug'] = $debug;
    }

    public function setCharset(string $charset = 'UTF-8'): void
    {
        $this->options['charset'] = $charset;
    }

    public function setAutoReload(bool $autoReload = false): void
    {
        $this->options['auto_reload'] = $autoReload;
    }

    public function setStrictVariables(bool $strictVariables = false): void
    {
        $this->options['strict_variables'] = $strictVariables;
    }

    public function setAutoEscape($autoEscape = 'html'): void
    {
        $this->options['autoescape'] = $autoEscape;
    }

    public function setOptimizations(int $optimizations = -1): void
    {
        $this->options['optimizations'] = $optimizations;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
