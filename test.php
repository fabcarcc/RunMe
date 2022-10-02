<?php
require_once 'includes/autoload.inc.php';
require_once 'includes/config.inc.php';

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

//CFrontController::run();
//$fp = FPersistentManager::getInstance();

//if ($fp->exist('EPermesso',-1,'idUtente','3','idEsecuzione')) {echo "SI";} else {echo "NO";}
//echo "<pre>";
//print_r($fp->load('EParametro',1, 'idEsecuzione',false));
//echo "</pre>";
//echo "<pre>";
//$e = $fp->load("EEsecuzione",1);
//
////print_r($e);
//
//$e->caricaParametri();
//print_r($e);
//
//echo "</pre>";



$fp = FPersistentManager::getInstance();
//
//
//$e = new EEsecuzione();
//$e->setNome('Prova');
//$e->setDescrizione('');
//$e->setEseguibile('aa.sh');
//$e->setMostraOutput(true);
//$e->setAbilitato(true);
//
//$param = [];
//
//$p = new EParametro();
//$p->setNome('aaa');
//$p->setDescrizione('bbb');
//$p->setPre('');
//$p->setValore('');
//$p->setPost('');
//$p->setTipoParametro(0);
//$p->setTipoValore(0);
//
//$p2 = new EParametro();
//$p2->setNome('ccc');
//$p2->setDescrizione('ddd');
//$p2->setPre('');
//$p2->setValore('');
//$p2->setPost('');
//$p2->setTipoParametro(0);
//$p2->setTipoValore(0);
//
//
//
//
//
//$param[] = $p;
//$param[] = $p2;
//$e->setParametri($param);


$e = $fp->load('EEsecuzione',14);
$e->caricaParametri();
debug($e);
$e->setDescrizione('ciao');
$e->getParametri()[0]->setPre('ciao');

$arr = $e->getParametri();
unset($arr[1]);
$e->setParametri($arr);

if ($e->save()) echo 'SI'; else echo 'NO';




