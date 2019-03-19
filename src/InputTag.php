<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class InputTag
{

    /**
     * Genrates HTML input fields
     *
     * @param string $name
     * @param string $type
     * @param string $value
     * @param string $extra
     * @return string
     */
    public static function x($name, $type = 'text', $value = null, $extra = null): string
    {
        if (is_null($value) && isset($_POST[$name]))
            $value = $_POST[$name];

        if (!is_null($extra))
            $extra = ' ' . $extra; // just a pet peeve

        switch ($type) {
            case 'text':
                return '<input type="text" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'email':
                return '<input type="email" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'number':
                return '<input type="number" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'password':
                return '<input type="password" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'textarea':
                return '<textarea name="' . $name . '" id="' . $name . '"' . $extra . '>' . $value . '</textarea>';

            case 'file':
                return '<input type="file" name="' . $name . '" id="' . $name . '"' . $extra . ' />';

            case 'radio':
                return '<input type="radio" name="' . $name . '" id="' . $name . '_' . $value . '" value="' . $value . '"' . $extra . ' />';

            case 'submit':
                return '<input type="submit" name="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'button':
                return '<input type="button" name="' . $name . '" value="' . $value . '"' . $extra . ' />';

            case 'checkbox':
                return '<input type="checkbox" name="' . $name . '" id="' . $name . '_' . $value . '" value="' . $value . '"' . $extra . ' />';

            case 'hidden':
                return '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
        }
    }
}
