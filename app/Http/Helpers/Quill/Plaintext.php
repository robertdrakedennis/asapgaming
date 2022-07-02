<?php

namespace App\Http\Helpers\Quill;

/**
 * Created by PhpStorm.
 * User: atlas
 * Date: 12/26/2018
 * Time: 11:41 PM
 */

class Plaintext
{
    public function strip($body){
        $text = '';

        foreach ($body['ops'] as $op) {
            if (!\array_key_exists('insert', $op) || !\is_string($op['insert'])) {
                continue;
            }

            $text = $text.$op['insert'];
        }
        return $text;
    }
}
