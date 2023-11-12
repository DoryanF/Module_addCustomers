<?php

//fc = FrontController

//chemin d'access: index.php?fc=module&module=nomDuModule&controller=NomDuFichierFrontController

require_once(_PS_MODULE_DIR_.'addcustomers/classes/AddCustomersClass.php');


class AddCustomersCustomersModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        return $this->setTemplate('module:addcustomers/views/templates/front/customers.tpl');
    }

    public function postProcess()
    {
        if(Tools::isSubmit('validate'))
        {
            $nom = Tools::getValue('nom');
            $prenom = Tools::getValue('prenom');
            $email = Tools::getValue('email');

            $customer = new AddCustomersClass();

            if(Validate::isGenericName($nom) && Validate::isGenericName($prenom) && Validate::isGenericName($email))
            {
                $customer->nom = $nom;
                $customer->prenom = $prenom;
                $customer->email = $email;

                $customer->add();
            }

        }
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->registerStylesheet('front-controller-addcustomers','module/'.$this->module->name.'/views/css/customers.css');
    }
}