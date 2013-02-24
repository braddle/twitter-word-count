<?php

/**
 * 
 */
class JsonResponse
{
    
    const RESPONSE_CODE_SUCCESS = 200;
    const RESPONSE_CODE_ERROR   = 500;
    
    
    public function getSuccessResponse($content)
    {
        return $this->getJson($content);
    }
    
    public function getErrorResponse($message)
    {
        $content = array('status' => array('response_code' => self::RESPONSE_CODE_ERROR,
                                           'message'       => $message));

        return $this->getJson($content);
    }
    
    private function getJson($content)
    {
        return json_encode($content);
    }
    
} // JsonResponse