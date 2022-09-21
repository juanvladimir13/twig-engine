<?php

/**
 * @author juanvladimir13 <juanvladimir13@gmail.com>
 * @see https://github.com/juanvladimir13
 */

namespace TwigEngine\Plugin;

use Twig\TwigFunction;

class Functions
{
  public static function randomId(): TwigFunction
  {
    return new TwigFunction('randomIdTagHTML', function (string $prefix = 'id') {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
      return $prefix . '-' . substr(str_shuffle($characters), 0, 5);
    });
  }
}
