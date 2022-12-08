<?php

namespace TechbridgeNearLogin\Helper;

/**
 * Class Data
 * @package TechbridgeNearLogin\Helper
 */
class Data
{
    /**
     * Method to clear string
     *
     * @param $string
     * @return string
     */
    public static function clearString($string): string
    {
        return trim(strip_tags($string));
    }

    /**
     * Method to get max array key
     *
     * @param $arr
     * @return int
     */
    public static function getMaxArrKey($arr): int
    {
        return (int)max((array_keys($arr)));
    }

    /**
     * Method to clear array
     *
     * @param $arr
     * @return array
     */
    public static function clearArray(array $arr): array
    {
        if (!empty($arr)) {
            foreach ($arr as &$value) {
                if (is_array($value)) {
                    self::clearArray($value);
                } else {
                    $value = self::clearString($value);
                }
            }
        }
        return $arr;
    }

    /**
     * Error logger
     *
     * @param $msg
     */
    public static function log($msg)
    {
        $time = date('Y-m-d H:i:s');
        $msg = "tb_n_login: $msg $time ";
        error_log($msg);
    }
}
