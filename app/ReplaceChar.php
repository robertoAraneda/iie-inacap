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
      'í‰', 'í¼', 'ÃƒÂ‘', 'ÃƒÂ', 'ÃƒÂ¼', 'ÃƒÂº'
    ];
        $array_format = [
      'ó', 'á', '¿',
      'é', 'ñ',
      '°', '"', '"',
      '...', '«', '»',
      'É', 'ü', 'Ñ', 'í', 'ü', 'ú'
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


    public static function replaceVocalUpperCaseString($string)
    {
        $arrayStrageCharacter = ['í', 'í‰', 'í', 'í“', 'íš', 'ÃƒÂ‘', 'ÃƒÂ‰', 'ÃƒÂ', 'ÃƒÂ', 'ÃƒÂ“', 'ÃƒÂš', 'ÃƒÂƒ', 'ÃƒÂ‹', 'ÃƒÂˆ', 'ÃƒÂ€'];

        $arrayCorrectCharacter = ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ', 'É', 'Í', 'Á', 'Ó', 'Ú', 'Ó', 'Ë', 'É', 'Á'];

        return str_replace($arrayStrageCharacter, $arrayCorrectCharacter, $string);
    }


    public static function replaceCharacterString($string)
    {
        $arrayStrageCharacter = ['Ã‚Â', 'Ã¢Â€Âœ', 'Ã¢Â€Â', 'Ã¢Â€Â¦'];

        $arrayCorrectCharacter = ['', '"', '"', '... '];

        return str_replace($arrayStrageCharacter, $arrayCorrectCharacter, $string);
    }

    public static function replaceVocalLowerCaseString($string)
    {
        $arrayStrageCharacter = ['ÃƒÂ¡', 'ÃƒÂ©', 'ÃƒÂ­', 'ÃƒÂ³', 'ÃƒÂ±', 'í¼'];

        $arrayCorrectCharacter = ['á', 'é', 'í', 'ó', 'ñ', 'ü'];

        return str_replace($arrayStrageCharacter, $arrayCorrectCharacter, $string);
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
