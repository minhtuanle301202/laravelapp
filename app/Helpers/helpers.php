<?php
if (!function_exists('jsonResponse')) {

    function jsonResponse($data, $message = null, $success = true)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
    }
}

?>