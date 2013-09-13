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
  
  public static function response($data, $code = SUCCESS)
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
  
}
