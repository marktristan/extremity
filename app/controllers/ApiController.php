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
      // Check if client's IP are in whitelist
      if (Rest::checkWhitelist())
      {
        return $this->handleRequest($request);
      }
      else
      {
        return Rest::notAuthorized();
      }
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
