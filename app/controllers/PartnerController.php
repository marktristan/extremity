<?php

class PartnerController extends \ApiController {

	public function handleRequest($request)
  {
    $method = camel_case($request->method);
    return $this->$method($request);
  }
  
  private function domainList($request)
  {
    return Rest::response($request);
  }

}
