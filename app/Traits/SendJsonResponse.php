<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait SendJsonResponse
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $data = null, $code = Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data)
            $response['data'] = $data;

        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $errorMessages = [], $code = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];


        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}
