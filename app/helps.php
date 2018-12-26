<?php
if (!function_exists('responseJson')) {

    function responseJson($data, $message = 'success', $error_code = 0)
    {
        $json = (object)[
            'error_code' => $error_code,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($json);
    }

}

if (!function_exists('myLog')) {
    /**
     * 打印日志
     *
     * @param $val
     */
    function myLog($val)
    {
        if (is_array($val)) {
            $val = var_export($val, true);
        }
        file_put_contents('myLog.txt', date('Y-m-d H:i:s', time()) . '  myLog:  ' . $val . "\r\n", FILE_APPEND);
    }
}