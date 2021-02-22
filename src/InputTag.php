<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

class InputTag
{
    /**
     * Generate HTML input fields
     *
     * @param string $name
     * @param string $type
     * @param string|null $value
     * @param string|null $extra
     * @return string
     */
    public static function x(
        string $name,
        string $type = 'text',
        ?string $value = null,
        ?string $extra = null): string
    {
        // autofill POST value
        if (\is_null($value) && isset($_POST[$name]))
            $value = $_POST[$name];

        if (!\is_null($extra))
            $extra = ' ' . $extra; // just a pet peeve

        $str = '';

        switch ($type) {

            case 'text':
                $str = '<input type="text" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'email':
                $str = '<input type="email" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'number':
                $str = '<input type="number" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'password':
                $str = '<input type="password" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'textarea':
                $str = '<textarea name="' . $name . '" id="' . $name . '"' . $extra . '>' . $value . '</textarea>';
                break;

            case 'file':
                $str = '<input type="file" name="' . $name . '" id="' . $name . '"' . $extra . ' />';
                break;

            case 'radio':
                $str = '<input type="radio" name="' . $name . '" id="' . $name . '_' . $value . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'submit':
                $str = '<input type="submit" name="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'button':
                $str = '<input type="button" name="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'checkbox':
                $str = '<input type="checkbox" name="' . $name . '" id="' . $name . '_' . $value . '" value="' . $value . '"' . $extra . ' />';
                break;

            case 'hidden':
                $str = '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '"' . $extra . ' />';
                break;
        }

        return $str;
    }

}