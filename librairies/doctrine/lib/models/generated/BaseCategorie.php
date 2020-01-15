<?php

/**
 * BaseCategorie
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $libelle
 * @property Doctrine_Collection $Archive
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCategorie extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('categorie');
        $this->hasColumn('libelle', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Archive', array(
             'local' => 'fk_ref_categorie',
             'foreign' => 'id'));
    }
}