<?php

namespace App\Service;

class ArrService
{
    /**
     * @param string $searchKey
     * @param array $arr
     * @param $result
     * @return mixed
     */
    public static function searchKey(string $searchKey, array $arr, &$result)
    {
        if (isset($arr[$searchKey])) {
            return $result = $arr[$searchKey];
        }
        if(!empty($arr) && is_array($arr)){
            foreach ($arr as $key => $param) {
                if (is_array($param)) {
                    ArrService::searchKey($searchKey, $param, $result);
                }
            }
        }
    }
}
