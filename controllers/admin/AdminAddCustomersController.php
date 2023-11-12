<?php

require_once(_PS_MODULE_DIR_.'addcustomers/classes/AddCustomersClass.php');

class AdminAddCustomersController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = AddCustomersClass::$definition['table'];
        $this->className = AddCustomersClass::class;
        $this->module = Module::getInstanceByName('addcustomers');
        $this->identifier = AddCustomersClass::$definition['primary'];
        $this->_orderBy = AddCustomersClass::$definition['primary'];
        $this->bootstrap = true;

        parent::__construct();

        $this->fields_list = array(
            'id_client' => array(
                'title' => 'Id Client',
                'search' => true
            ),
            'nom' => array(
                'title' => 'Nom Client',
                'search' => true
            ),
            'prenom' => array(
                'title' => 'Prenom Client',
                'search' => true
            ),
            'email' => array(
                'title' => 'Email Client',
                'search' => true
            ),
        );

        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->addRowAction('view');
    }

    public function renderForm()
    {
        $this->fields_form = [
            'legend' => [
                'title' => 'Ajout de Client',
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => 'Nom: ',
                    'name' => 'nom',
                    'placeholder' => 'Doe',
                    'required' => true
                ],
                [
                    'type' => 'text',
                    'label' => 'Prénom: ',
                    'name' => 'prenom',
                    'placeholder' => 'John',
                    'required' => true
                ],
                [
                    'type' => 'text',
                    'label' => 'Email: ',
                    'name' => 'email',
                    'placeholder' => 'John.Doe@email.com',
                    'required' => true
                ],
            ],
            'submit' => [
                'title' => 'Valider',
                'class' => 'btn btn-primary'
            ]
        ];

        return parent::renderForm();
    }


}