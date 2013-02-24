<?php

/**
 * 
 */
class JsonResponse
{
    
    const RESPONSE_CODE_SUCCESS = 200;
    const RESPONSE_CODE_ERROR   = 500;
    
    
    public function sendSuccessResponse($content)
    {
        $this->doSendJson($content);
    }
    
    public function sendErrorResponse($message)
    {
        $content = array('status' => array('response_code' => self::RESPONSE_CODE_ERROR,
                                           'message'       => $message));

        $this->doSendJson($content);
    }
    
    private function doSendJson($content)
    {
        echo json_encode($content);
        exit;
    }
    
} // JsonResponse
