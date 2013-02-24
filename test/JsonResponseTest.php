<?php

class JsonResponseTest extends PHPUnit_Framework_TestCase
{
    
    public function testGetSuccessResponse()
    {
        $json_response = new JsonResponse();
        
        $message = 'Testing error response.';
        
        $expected_json = json_encode(array('status' => array('response_code' => JsonResponse::RESPONSE_CODE_ERROR,
                                                             'message'       => $message)));
                
        $this->assertJsonStringEqualsJsonString($expected_json, 
                                                $json_response->getErrorResponse($message));
    }
    
    public function testGetErrorResponse()
    {
        $json_response = new JsonResponse();
        
        $content = array('test_a' => 123,
                         'test_b' => 456,
                         'test_c' => 789,
            );
        
        $this->assertJsonStringEqualsJsonString(json_encode($content), 
                                                $json_response->getSuccessResponse($content));
    }
           
} // JsonResponseTest
