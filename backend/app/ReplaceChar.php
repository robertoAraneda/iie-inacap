<?php

namespace App;

class ReplaceChar

{

  //remplaza los carácteres extraños por letras con tilde o simbolos
  public static function replaceStrangeCharacter($array)
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
}
