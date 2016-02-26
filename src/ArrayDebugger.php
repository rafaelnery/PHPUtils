<?php 
namespace PHP;

class ArrayDebugger extends \ArrayObject { 

  const TYPE_GET    = 'GET';
  const TYPE_SET    = 'SET';
  const TYPE_EXISTS = 'EXISTS';
  const TYPE_UNSET  = 'UNSET';

  private $logger;

  public function __construct() {

    $this->logger = function($data_log) {
      return dump($data_log);
    };

    return call_user_func_array('parent::__construct', func_get_args()); 
  }

  public function sendLog($type, $key, $value = null, array $backtrace ) {

    $logger           = $this->logger;
    $retorno['type']  = $type;  
    $retorno['key']   = $key;
    $retorno['value'] = $value;
    $retorno['file']  = $backtrace[0]['file'];
    $retorno['line']  = $backtrace[0]['line'];
    return $logger($retorno);
  }

  public function setLogger(\Closure $logger) {
    $this->logger = $logger;
  }

  public function offsetGet($name) { 

    $this->sendLog(static::TYPE_GET, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetGet', func_get_args()); 
  } 

  public function offsetSet($name, $value) { 

    $this->sendLog(static::TYPE_SET, $name, $value, debug_backtrace());
    return call_user_func_array('parent::offsetSet', func_get_args()); 
  } 

  public function offsetExists($name) { 

    $this->sendLog(static::TYPE_EXISTS, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetExists', func_get_args()); 
  } 

  public function offsetUnset($name) { 

    $this->sendLog(static::TYPE_UNSET, $name, null, debug_backtrace());
    return call_user_func_array('parent::offsetUnset', func_get_args()); 
  } 
} 
