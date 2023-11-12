<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */

 if (!defined('_PS_VERSION_')) {
    exit;
}

class AddCustomers extends Module
{
    public $produits; 


    public function __construct()
    {
        $this->name = 'addcustomers';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Doryan Fourrichon';

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => '8.99.99',
        ];

        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Add Customers');
        $this->description = $this->l('Module pour ajouter des utilisateurs');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall');

        $this->produits = new Product();

        
    }

    public function install()
    {
        if(!Parent::install() ||
        !$this->createTable() ||
        !$this->installTab('AdminAddCustomers','Liste clients','AdminCatalog') ||
        !$this->registerHook('header')
        )
        {
            return false;
        }
            return true;
    }

    public function uninstall()
    {
        if(!Parent::uninstall() ||
        !$this->deleteTable() ||
        !$this->uninstallTab()
        )
        {
            return false;
        }
            return true;
    }

    public function getContent()
    {

    }

    public function createTable()
    {
        return DB::getInstance()->execute(
            'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'addcustomers(
                id_client int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                nom VARCHAR(255) NOT NULL, 
                prenom VARCHAR(255) NOT NULL, 
                email VARCHAR(255) NOT NULL
                )'
        );
    }

    public function deleteTable()
    {
        return DB::getInstance()->execute(
            'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . 'addcustomers'
        );
    }

    public function installTab($className, $tabName, $tabParentName)
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = $className;
        $tab->name = array();

        foreach (Language::getLanguages(true) as $lang) 
        {
            $tab->name[$lang['id_lang']] = $tabName;
        }

        if($tabParentName)
        {
            $tab->id_parent = Tab::getIdFromClassName($tabParentName);
        }
        else
        {
            $tab->id_parent = 10;
        }

        $tab->module = $this->name;

        return $tab->add();
    }

    public function uninstallTab()
    {
        $idTable = Tab::getIdFromClassName('AdminAddCustomers');
        $tab = new Tab($idTable);

        $tab->delete();
    }

    public function hookHeader($params)
    {        
        return $this->context->controller->addCSS($this->_path.'views/css/customers.css');
    }
}