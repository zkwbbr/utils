<?php

declare(strict_types=1);

namespace Zkwbbr\Utils;

use Zkwbbr\Utils\IsArrayMultiAssoc;
use Zkwbbr\Utils\ForcedAssocArray;

class SelectTag
{
    /**
     *
     * @param mixed[] $choices
     * @param string $name
     * @param string|null $selected
     * @param bool $showSelectOption
     * @param bool $multiSelect
     * @return string
     */
    public static function x(
        array $choices,
        string $name,
        ?string $selected = null,
        bool $showSelectOption = true,
        bool $multiSelect = false): string
    {
        // autofill POST value
        if (\is_null($selected) && isset($_POST[$name]))
            $selected = $_POST[$name];

        // ------------------------------------------------
        // if array is not multidimensional, use basic <select>
        // ------------------------------------------------

        if (!IsArrayMultiAssoc::x($choices)) {

            $data = ForcedAssocArray::x($choices);
            $multiSelect = $multiSelect ? ' multiple' : null;

            $str = '<select id="' . $name . '" name="' . $name . '"' . $multiSelect . '>';
            $str .= ($showSelectOption) ? '<option value="" disabled>- Select -</option>' : null;

            foreach ($data as $k => $v) {

                $selectedAtrr = ($selected == $k) ? ' selected="selected"' : null;
                $str .= '<option value="' . $k . '"' . $selectedAtrr . '>' . $v . '</option>';
            }

            return $str .= '</select>';
        }

        // ------------------------------------------------
        // else, we use <optgroup>. Note: this supports 3 levels, see unit test for sample usage
        // ------------------------------------------------

        $multiSelect = $multiSelect ? ' multiple' : null;

        $str = '<select id="' . $name . '" name="' . $name . '"' . $multiSelect . '>';
        $str .= ($showSelectOption) ? '<option value="" disabled>- Select -</option>' : null;

        foreach ($choices as $level1 => $items1) {

            $str .= '<optgroup label="' . $level1 . '">';

            $items1 = ForcedAssocArray::x((array) $items1);

            foreach ($items1 as $level2 => $items2) {

                if (!\is_array($items2)) {

                    $selectedAtrr = ($selected == $level2) ? ' selected="selected"' : null;
                    $str .= '<option value="' . $level2 . '"' . $selectedAtrr . '>' . $items2 . '</option>';

                } else {

                    $str .= '<optgroup label="&nbsp;&nbsp;&nbsp;' . $level2 . '">';

                    $items2 = ForcedAssocArray::x($items2);

                    foreach ($items2 as $level3 => $items3) {

                        $selectedAtrr = ($selected == $level3) ? ' selected="selected"' : null;
                        $str .= '<option value="' . $level3 . '"' . $selectedAtrr . '>&nbsp;&nbsp;&nbsp;' . $items3 . '</option>';
                    }

                    $str .= '</optgroup>';
                 }
            }

            $str .= '</optgroup>';
        }

        return $str .= '</select>';
    }

}