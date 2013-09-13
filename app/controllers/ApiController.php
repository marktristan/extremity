<?php

abstract class ApiController extends \BaseController {

  abstract protected function handleRequest($request);
  
  protected function processRequest()
  {
    $request = Rest::initializeRequest();
    
    // Check if object 'Rest' has been instantiated
    if ($request instanceof Rest)
    {
      return $this->handleRequest($request);
    }
    else
    {
      return Rest::invalidRequest();
    }
  }
  
  public function postReq()
  {
    return $this->processRequest();
  }

}
