<?php

namespace App\Http\Traits;

trait ResponseHelperTrait
{

    public function returnAllDataJSON(
        $collection,
        $data      = [],
        $message   = '',
        $status    = true,
        $code      = 200
    ) {
        $responseData = [
            'code'       => (string) $code,
            'status'     => $status,
            'message'    => $message,
            'data'       => $data,
            'pagination' => $collection,
        ];

        http_response_code($code);
        return json_encode($responseData);
    }
    // --------------------------------------
    public function returnJSON(
        $data    = [],
        $message = '',
        $status  = true,
        $code    = 200
    ) {
        $responseData = [
            'code'    => (string) $code,
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];

        http_response_code($code);
        return json_encode($responseData);
    }
    // --------------------------------------
    public function returnSuccess(
        $message = 'Your request done successfully',
        $code    = 200
    ) {
        $responseData = [
            'code'    => (string) $code,
            'status'  => true,
            'message' => $message,
        ];

        http_response_code($code);
        echo json_encode($responseData);
    }
    // --------------------------------------
    public function returnWrong(
        $message = 'Your Request Is Invalid',
        $errors  = [],
        $code    = 400
    ) {

        if ($errors === []) {
            $responseData = [
                'code'    => (string) $code,
                'status'  => false,
                'message' => $message,
            ];
        } else {
            $responseData = [
                'code'    => (string) $code,
                'status'  => false,
                'message' => $message,
                'errors'  => $errors,
            ];
        }

        http_response_code($code);
        echo json_encode($responseData);
    }
}
