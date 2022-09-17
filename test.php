<?php
require_once 'includes/autoload.inc.php';
//require_once 'includes/config.inc.php';

//$VT=USingleton::getInstance('VTest');
//$VT->show();

//$p = new VBaseView();
//$p->display('test.tpl');

//function prima($num, $num2 = "bb") {
//    echo $num;
//    echo $num2;
//};
//
//prima(1,2);
//prima("aa","bb");


//
//function seconda (int $p, string $q = null) {
//    if ($q) {prima($p,$q);}
//    else {prima($p);}
//}
//seconda(1,"pp");
//
//$fp = FPersistentManager::getInstance();
//$out = $fp->load("EUtente",0);
//if ($out) {
//print $out->getUsername();
//print $out->getEmail();
//}
//else echo "no";

////
$u = new EUtente();
$u->setUsername("pluto3");
$u->setEmail("aa@bb.it");
$u->setPassword(md5("password"));
$u->setAdmin(true);
$u->setId(4);

USession::set('user',$u);
//USession::del('user');

//session_start();
//$_SESSION['user'] = $u;
//echo ("ciao");
//////$u->setId(19);
//////echo "1";
//if ($u->save()) {echo "id: " . $u->getId();} else {echo "no";}
//
////$fp = FPersistentManager::getInstance();
////
////if ($fp->remove("EUtente", "cc@bb.it", "email") ) {echo "si";}
////else {echo "no";}
////
//
////echo FGenericObject::load() . PHP_EOL;
////echo FUtente::update();
////echo "<br>";
////echo FParametro::update();
//$row['id'] = 3;
//$row['username'] = "root";
//$row['password'] = "ppp";
//$row['email'] = "io@pp.it";
//$row['admin'] = false;
////
////$row[''] = ;
////$row[''] = ;
////$row[''] = ;
////$row[''] = ;
////$row[''] = ;
////$row[''] = ;
////$row[''] = ;
//
//$u = FUtente::createObjectFromRow($row);
////echo gettype($u);
////echo "<br>";
//echo $u->getId();
//echo $u->getUsername();
//array("idEsecuzione", "nome", "descrizione", "pre", "default_value", "post", "obbligatorio", "tipo");
//$row['id'] = 3;
//$row['idEsecuzione'] = 4;
//$row['nome'] = "ppp";
//$row['descrizione'] = "desc";
//$row['pre'] = "si";
//$row['valore'] = "io@pp.it";
//$row['post'] = "no";
//$row['obbligatorio'] = false;
//$row['tipo'] = 7;
//
//$p = FParametro::createObjectFromRow($row);
//echo $p->getId();
//echo $p->getPre();
//echo "<pre>";
//print_r($p);
//echo "</pre>";
////echo $row['admin'];
////echo $row['pippo'];
//
//require_once 'includes/autoload.inc.php';
//$p = new EParametro();
//$p->setNome("pp");
//$p->setDescrizione("pppppppppp");
//$p->setValore("ciao");
//$p->setObbligatorio(0);
//$p->setIdEsecuzione(3);
//$p->setPre("");
//$p->setPost("");
//$p->setTipo(4);

CFrontController::run();
