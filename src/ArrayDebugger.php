<?php 

class DebugArray extends \ArrayObject { 

  const TYPE_GET    = 'GET';
  const TYPE_SET    = 'SET';
  const TYPE_EXISTS = 'EXISTS';
  const TYPE_UNSET  = 'UNSET';

  private $logger;

  public function __construct() {

    $this->logger = function($type, $key, $value = null,  array $backtrace ) {

      $log = $type.' | Key: '.$key;
      
      if ($type === static::TYPE_SET) {
        $log .= ' -> Value:' . $value;
      }
      dump($log, $backtrace);
    };

    return call_user_func_array('parent::__construct', func_get_args()); 
  }

  public function setLogger(\Closure $logger) {
    $this->logger = $logger;
  }

  public function offsetGet($name) { 

    $logger = $this->logger;
    $logger(static::TYPE_GET, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetGet', func_get_args()); 
  } 

  public function offsetSet($name, $value) { 

    $logger = $this->logger;
    $logger(static::TYPE_SET, $name, $value, debug_backtrace());
    return call_user_func_array('parent::offsetSet', func_get_args()); 
  } 

  public function offsetExists($name) { 

    $logger = $this->logger;
    $logger(static::TYPE_EXISTS, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetExists', func_get_args()); 
  } 

  public function offsetUnset($name) { 

    $logger = $this->logger;
    $logger(static::TYPE_UNSET, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetUnset', func_get_args()); 
  } 
} 
