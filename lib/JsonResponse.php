<?php

/**
 * 
 */
class JsonResponse
{
    
    const RESPONSE_CODE_SUCCESS = 200;
    const RESPONSE_CODE_ERROR   = 500;
    
    /**
     * Returns the provided content in JSON format.
     * 
     * @param array $content
     * @return string JSON format
     */
    public function getSuccessResponse($content)
    {
        return $this->getJson($content);
    }
    
    /**
     * Returns and error message and error code in JSON format.
     * @param string $message
     * @return sting JSON format
     */
    public function getErrorResponse($message)
    {
        $content = array('status' => array('response_code' => self::RESPONSE_CODE_ERROR,
                                           'message'       => $message));

        return $this->getJson($content);
    }
    
    /**
     * Returns the given $content in JSON format.
     * 
     * @param array $content
     * @return string JSON format
     */
    private function getJson($content)
    {
        return json_encode($content);
    }
    
} // JsonResponse