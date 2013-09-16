<?php

abstract class ApiController extends \BaseController {

  abstract protected function handleRequest($request);
  
  private function processRequest()
  {
    $request = Rest::initializeRequest();
    
    // Check if object 'Rest' has been instantiated
    if ($request instanceof Rest)
    {
      // All request parameters are valid
      return $this->handleRequest($request);
    }
    else
    {
      // There's something wrong in the request parameters
      return Rest::invalidRequest();
    }
  }
  
  public function postReq()
  {
    return $this->processRequest();
  }

}
