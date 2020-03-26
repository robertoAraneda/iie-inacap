<?php

namespace App;

class ReplaceChar

{

  //remplaza los carácteres extraños por letras con tilde o simbolos
  public static function replaceStrangeCharacterArray($array)
  {

    $array_primary = [
      'ÃƒÂ³', 'ÃƒÂ¡', 'Ã‚Â¿',
      'ÃƒÂ©', 'ÃƒÂ±',
      'Ã‚Â°', 'Ã¢Â€Âœ', 'Ã¢Â€Â',
      'Ã¢Â€Â¦', 'Ã‚Â«', 'Ã‚Â»',
      'í‰', 'í¼', 'ÃƒÂ‘', 'ÃƒÂ'
    ];
    $array_format = [
      'ó', 'á', '¿',
      'é', 'ñ',
      '°', '"', '"',
      '...', '«', '»',
      'É', 'ü', 'Ñ', 'í'
    ];

    foreach ($array as $element) {

      if (isset($element->nombre)) {

        $name = $element->nombre;

        $element->nombre = str_replace($array_primary, $array_format, $name);
      }

      if (isset($element->ultimoacceso)) {

        $lastaccess = $element->ultimoacceso;

        $element->ultimoacceso = str_replace($array_primary, $array_format, $lastaccess);
      }
    }

    return $array;
  }

  public static function replaceStrangeCharacterString($string)
  {


    $array_primary = [
      'ÃƒÂ³', 'ÃƒÂ¡', 'Ã‚Â¿',
      'ÃƒÂ©', 'ÃƒÂ±',
      'Ã‚Â°', 'Ã¢Â€Âœ', 'Ã¢Â€Â',
      'Ã¢Â€Â¦', 'Ã‚Â«', 'Ã‚Â»',
      'í‰', 'í¼', 'ÃƒÂ‘', 'ÃƒÂ'
    ];
    $array_format = [
      'ó', 'á', '¿',
      'é', 'ñ',
      '°', '"', '"',
      '...', '«', '»',
      'É', 'ü', 'Ñ', 'í'
    ];


    return str_replace($array_primary, $array_format, $string);
  }
}
