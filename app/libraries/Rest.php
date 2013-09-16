<?php

class Rest {
  
  public $id;
  public $method;
  public $action;
  public $params;
  
  public function __construct($request)
  {
    // Initialize request fields
    $this->id = $request->id;
    $this->method = $request->method;
    $this->action = $request->action;
    $this->params = $request->params;
    
    $this->_checkWhitelist();
  }
  
  public static function initializeRequest()
  {
    $request = (Object) Input::all();
    
    // This request fields are required
    if (isset($request->id) && isset($request->method) && isset($request->action) && isset($request->params))
    {
      return new Rest($request);
    }
  }
  
  public static function response($data, $code = 1000)
  {
    $status = Config::get('status');
    $build = array(
      'code' => $code,
      'msg' => isset($status[$code]) ? $status[$code] : 'Not defined',
      'data' => $data
    );
    
    return Response::json($build);
  }
  
  public static function invalidRequest()
  {
    $build = array(
      'code' => 2000,
      'msg' => 'Invalid request'
    );
    
    return Response::json($build, 400);
  }
  
  public static function undefinedMethod()
  {
    $build = array(
      'code' => 2000,
      'msg' => 'Undefined method'
    );
    
    return Response::json($build, 400);
  }
  
  public static function notAuthorized()
  {
    $build = array(
      'code' => 2000,
      'msg' => 'Not authorized'
    );
    
    return Response::json($build, 401);
  }
  
  private function _checkWhitelist()
  {
    $tmpWhitelist = Config::get('rest.whitelist_ip');
    if (Config::get('rest.whitelist_enabled'))
    {
      array_push($tmpWhitelist, '127.0.0.1', '0.0.0.0');
      $whitelist = array_map('trim', $tmpWhitelist);
      
      if (!in_array(Request::getClientIp(), $whitelist))
      {
        $this->_rawNotAuthorized();
      }
    }
  }
  
  private function _rawNotAuthorized()
  {
    $this->_rawHttpJsonOutput(2000, 'Not authorized', 401);
  }
  
  /**
   * Note: This method will throw an ([ErrorException] Cannot modify header information - headers already sent)
   * when UNIT TESTING using $this->call() method. I'm still investigating how to resolve this problem.
   * Update: Setting error_reporting(E_ALL ^ E_WARNING) was the temporary solution.
   * 
   */
  private function _rawHttpJsonOutput($code = 1000, $msg = 'Success', $httpCode = 200)
  {
    header('Content-Type: application/json');
    header('HTTP/1.1: ' . $httpCode);
		header('Status: ' . $httpCode);
    
    $build = array(
      'code' => $code,
      'msg' => $msg
    );
    
    exit(json_encode($build));
  }
  
}
