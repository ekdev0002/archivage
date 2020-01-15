<?php

require(dirname(__FILE__).'/config/global.php');

// Si elle existe, supprimez la base existante.
// Attention, cela vide totalement la base de données !
Doctrine_Core::dropDatabases();


// Création de la base (uniquement si elle n'EXISTE PAS)
Doctrine_Core::createDatabases();


// Création des fichiers de modèle à partir du schema.yml
// Si vous n'utilisez pas le Yaml, n'exécutez pas cette ligne !
Doctrine_Core::generateModelsFromYaml(CFG_DIR.'schema.yml', LIB_DIR.'models', array('generateTableClasses' => true));


// Création des tables
Doctrine_Core::createTablesFromModels(LIB_DIR.'models');

echo "Compilation effectuée avec succès !!!!!!!!!!"

?>