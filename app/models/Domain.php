<?php

class Domain extends Eloquent {
  
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'domains';
  
  /**
   * The database connection used by the model
   * 
   * @var string
   */
  protected $connection = 'dsstaging';
  
  public static function findInfoById($handle)
  {
    try
    {
      $domainInfo = Domain::where('id', $handle)->first();
      if (count($domainInfo) > 0)
      {
        return Rest::response($domainInfo->toArray());
      }
      else
      {
        return Rest::response(null, 2002);
      }
    }
    catch (\Exception $e) // Query error handling
    {
      return Rest::response($e->getMessage(), 2001);
    }
  }
  
  public static function findInfoByName($handle)
  {
    try
    {
      $domainInfo = Domain::whereRaw('(name||extension) = ?', array($handle))->first();
      if (count($domainInfo) > 0)
      {
        return Rest::response($domainInfo->toArray());
      }
      else
      {
        return Rest::response(null, 2002);
      }
    }
    catch (\Exception $e) // Query error handling
    {
      return Rest::response($e->getMessage(), 2001);
    }
  }

}
