<?php

namespace App\Service;

class Slugify{

    public function generate(string $input) : string
    {
        $input = strtr(utf8_decode($input),
            utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'),
            'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

      $input = preg_replace('/[\.\,\/\#\!\$\%\\\\&\*\;\:\{\}\=\_\`\~\(\)]+/','',$input);

        ;
        return  str_replace('+','-',urlencode(mb_strtolower($input)));
    }
}
