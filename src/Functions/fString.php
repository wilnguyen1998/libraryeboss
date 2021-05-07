<?php

namespace eBOSS\Functions;

class fString
{
    public static function SwitchLanguage($Language, $NameChinese, $NameVietnamese, $NameEnglish, $NameOther)
    {
        switch ($Language) {
            case 'NameChinese':
                return $NameChinese;
            case 'NameEnglish':
                return $NameEnglish;
            case 'NameOther':
                return $NameOther;
            default:
                return $NameVietnamese;
        }
    }

    public static function SelectCommandBuilder($SelectCommand, $Language, $ParameterValue)
    {
        return str_replace($Language, $ParameterValue, $SelectCommand);
    }


    /**
     * @param $BarcodeValue : Giá trị Barcode khi Scan vào hệ thống
     * @return string
     */
    public function BuildBarcode($BarcodeValue): string
    {
        $ArrayBarcode = explode(" ", $BarcodeValue);
        $ArrayDiff = array("");

        $ArrayCompare = array_diff($ArrayBarcode, $ArrayDiff);

        return implode(' ', $ArrayCompare);
    }


    public function ArrayBarcode($BarcodeValue): array
    {
        return explode(' ', $this->BuildBarcode($BarcodeValue));
    }

}