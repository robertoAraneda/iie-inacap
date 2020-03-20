<?php

namespace App;

class ReplaceChar

{

  //remplaza los carácteres extraños por letras con tilde o simbolos
  public static function replaceStrangeCharacterArray($array)
  {

    $array_primary = ['ÃƒÂ³', 'ÃƒÂ¡', 'Ã‚Â¿', 'ÃƒÂ©', 'ÃƒÂ±', 'ÃƒÂ', 'Ã‚Â°'];
    $array_format = ['ó', 'á', '¿', 'é', 'ñ', 'í', '°'];

    foreach ($array as $element) {

      if (isset($element->nombre)) {

        $name = $element->nombre;

        $element->nombre = str_replace($array_primary, $array_format, $name);
      }
    }

    return $array;
  }

  public static function replaceStrangeCharacterString($string)
  {

    $array_primary = ['ÃƒÂ³', 'ÃƒÂ¡', 'Ã‚Â¿', 'ÃƒÂ©', 'ÃƒÂ±', 'ÃƒÂ', 'Ã‚Â°'];
    $array_format = ['ó', 'á', '¿', 'é', 'ñ', 'í', '°'];

    return str_replace($array_primary, $array_format, $string);
  }
}
