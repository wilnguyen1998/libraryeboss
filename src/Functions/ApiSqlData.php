<?php
namespace eBOSS\Functions;

class ApiSqlData
{

    public $vIpApiServer;

    /**
     * @param $SelectCommandView
     * @return array|string|string[]
     */
    private function GetSelectCommandView($SelectCommandView)
    {
        $ParameterOut = array(' ');
        $ParameterValue = array('%20');
        return str_replace($ParameterOut, $ParameterValue, $SelectCommandView);
    }


    /**
     * @param $SelectCommandView: Phải qua xử lý fString:SelectCommandBuilder
     * @return mixed
     */

    public function GetData($SelectCommandView)
    {
        $LinkApi = $this->vIpApiServer . $this->GetSelectCommandView($SelectCommandView);
        $ch = curl_init();
        $timeout = 5; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_URL, $LinkApi);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $Response = curl_exec($ch);
        curl_close($ch);
        return json_decode($Response, true);

    }

    public function GetValue($Table, $CheckColumnName, $CheckValue, $ResultColumnName)
    {
        $Result = "";
        for ($i = 0; $i < count($Table); $i++) {
            if (strtoupper($Table[$i][$CheckColumnName]) === strtoupper($CheckValue))
                $Result = $Table[$i][$ResultColumnName];
        }
        return $Result;
    }

    public function GetValues($Table, $CheckColumnNames, $CheckValues, $ResultColumnName)
    {
        $Result = "";
        for ($i = 0; $i < count($Table); $i++) {
            if (strtoupper($Table[$i][$CheckColumnNames[0]]) == strtoupper($CheckValues[0]) && strtoupper($Table[$i][$CheckColumnNames[1]]) == strtoupper($CheckValues[1]))
                $Result = $Table[$i][$ResultColumnName];
        }
        return $Result;
    }

    public function Translate($SelectCommandView, $ItemID, $Language = null)
    {
        $TableFunctionComponent = $this->GetData($SelectCommandView);

        return $this->GetValue($TableFunctionComponent, 'ItemID', $ItemID, 'TranslateNameVietnamese');

    }

}