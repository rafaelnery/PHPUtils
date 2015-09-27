<?php 
require 'vendor/autoload.php';


$sSql               = "SELECT * FROM testes.teste inner join  coisa.neh on teste.codigo = neh.codigo where teste.xoxo = 1 and teste.xoxb is true;";
$oObjeto            = new StdClass();
$oObjeto->aArray    = array(1,2,3,4,5,"6", array(7));
$oObjeto->backtrace = debug_backtrace();

\PHP\Utils::dump_sql($sSql);
\PHP\Utils::dump($sSql, $oObjeto);
dump_sql($sSql);
dump($sSql, $oObjeto);
kill($sSql, $oObjeto);
\PHP\Utils::kill($sSql, $oObjeto);
echo "Não deve aparecer";


