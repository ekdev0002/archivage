<?php

require(dirname(__FILE__).'/config/global.php');

// Si elle existe, supprimez la base existante.
// Attention, cela vide totalement la base de donn�es !
Doctrine_Core::dropDatabases();


// Cr�ation de la base (uniquement si elle n'EXISTE PAS)
Doctrine_Core::createDatabases();


// Cr�ation des fichiers de mod�le � partir du schema.yml
// Si vous n'utilisez pas le Yaml, n'ex�cutez pas cette ligne !
Doctrine_Core::generateModelsFromYaml(CFG_DIR.'schema.yml', LIB_DIR.'models', array('generateTableClasses' => true));


// Cr�ation des tables
Doctrine_Core::createTablesFromModels(LIB_DIR.'models');

echo "Compilation effectu�e avec succ�s !!!!!!!!!!"

?>