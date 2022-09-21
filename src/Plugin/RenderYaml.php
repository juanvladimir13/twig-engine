<?php

/**
 * @author juanvladimir13 <juanvladimir13@gmail.com>
 * @see https://github.com/juanvladimir13
 */

namespace TwigEngine\Plugin;

use TwigEngine\TwigEngine;

class RenderYaml
{
    public static function render(string $template, string $filename, string $typeFile = '.html')
    {
        $data = \yaml_parse_file($filename . '.yml');
        if ($data == false) {
            return 'Fail read YAML file';
        }

        $keys = array_keys($data);
        $items = [];
        foreach ($keys as $key) {
            $keyObject = $data[$key]['key'] ?? $key;
            $items[$keyObject] = $keyObject === $key ? $data[$key] : (object)$data[$key];
            //$items[$data[$key]['key']] = (object)$data[$key];
        }
        return TwigEngine::render($template, $items, $typeFile);
    }
}
