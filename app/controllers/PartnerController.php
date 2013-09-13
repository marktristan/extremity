<?php

class PartnerController extends \ApiController {

	public function handleRequest($request)
  {
    $method = camel_case($request->method);
    return $this->$method();
  }
  
  private function domainList()
  {
    return Rest::response(array(), SUCCESS);
  }

}
