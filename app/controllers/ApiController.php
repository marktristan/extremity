<?php

abstract class ApiController extends \BaseController {

  abstract protected function handleRequest($request);
  
  protected function processRequest()
  {
    $req = Rest::initializeRequest();
    
    // Check if object 'Rest' has been instantiated
    if ($req instanceof Rest)
    {
      return $this->handleRequest($req);
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
