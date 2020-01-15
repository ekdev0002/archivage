<?php

/**
*
* 
* modele: CFG_DB_DSN = phptype://username:password@hostspec/database 
* 
*
* avec phptype:  
*                   - fbsql         pour        FrontBase
*                   - ibase         pour        Interbase / Firebird
*                   - mssql         pour        MS SQL Server
*                   - mysql         pour        MySQL
*                   - mysqli        pour        MySQLi
*                   - oci           pour        Oracle 7/8/9/10
*                   - pgsql         pour        PostgreSQL
*                   - querysim      pour        QuerySim
*                   - sqlite        pour        SQLite 2
* 
*/




// Adaptez bien s�r le DSN � votre cas
define('CFG_DB_DSN', 'mysql://root:a1l2l3eric@localhost/archivage');

define('LIB_DIR',  dirname(__FILE__).'/../lib/');
define('CFG_DIR',  dirname(__FILE__).'/');

require_once(LIB_DIR.'vendor/doctrine/Doctrine.php');

spl_autoload_register(array('Doctrine_Core', 'autoload'));
spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));

$manager = Doctrine_Manager::getInstance();
$con = Doctrine_Manager::connection(CFG_DB_DSN);

$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
$manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);

// prendre en compte les softDelete
$manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);

Doctrine_Core::loadModels(LIB_DIR.'models/');

?>