<?php

class RestServerTest extends TestCase {
  
  public function testIncomingRequest()
  {
    $response = $this->call('POST', 'partner/req', array('id' => 1, 'method' => 'domain_list', 'action' => '', 'params' => array()));
    
    // Assert if status code is 200
    $this->assertResponseOk();
    
    // Assert if contents are equal
    $contents = json_decode($response->getContent());
    $this->assertEquals('Success', $contents->msg);
  }
  
}
