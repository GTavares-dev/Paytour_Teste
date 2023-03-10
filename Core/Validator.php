<?php

namespace Core;


class Validator
{
  public static function string($value, $min = 1, $max = INF)
  {
    $value = trim((string)$value);

    return strlen($value) >= $min && strlen($value) <= $max;
  }
}
