<?php 

function kill() {
  return call_user_func_array("\\PHP\\Utils::kill", func_get_args());
}


function dump_sql($sSql) {
  return \PHP\Utils::dump_sql($sSql);
}
