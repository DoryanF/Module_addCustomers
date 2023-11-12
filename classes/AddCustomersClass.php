<?php

class AddCustomersClass extends ObjectModel
{
    public $id_client;
    public $nom;
    public $prenom;
    public $email;

    public static $definition = array(
        'table' => 'addcustomers',
        'primary' => 'id_client',
        'multilang' => false,
        'fields' => array(
            'id_client' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'nom' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true),
            'prenom' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true),
            'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'required' => true),
        )
    );
}