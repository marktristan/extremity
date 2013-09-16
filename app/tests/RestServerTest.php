<?php

class RestServerTest extends TestCase {
  
  public function testIncomingRequest()
  {
    //error_reporting(E_ALL ^ E_WARNING); // Temporary solution for 'headers already sent' exception
    
    $response = $this->call('POST', 'partner/req', array('id' => 1, 'method' => 'domain_list', 'action' => '', 'params' => '{"domain":"test.ph"}'));
    
    // Assert if status code is 200
    $this->assertResponseOk();
    
    // Assert if contents 'msg' are equal to 'Success'
    $contents = json_decode($response->getContent());
    $this->assertEquals('Success', $contents->msg);
  }
  
}
