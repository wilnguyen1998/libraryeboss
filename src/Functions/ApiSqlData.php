<?php
namespace eBOSS\Functions;

class ApiSqlData
{

    public $vIpApiServer;
    /**
     * @param $SelectCommandView: Phải qua xử lý fString:SelectCommandBuilder
     * @return mixed
     */

    function GetData($SelectCommandView)
    {
        $LinkApi = $this->vIpApiServer . $SelectCommandView;

        $Response = file_get_contents($LinkApi, true);

        return json_decode($Response, true);

        /*echo $this->curl($LinkApi);

        return json_decode($this->curl($LinkApi), true);*/



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