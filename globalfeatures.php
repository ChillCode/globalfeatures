<?php

// phpcs:disable Generic.Files.LineLength.TooLong, Squiz.Classes.ValidClassName.NotCamelCaps, PSR12.Files.FileHeader.SpacingAfterBlock, PSR1.Classes.ClassDeclaration.MissingNamespace, PSR1.Files.SideEffects.FoundWithSymbols

/*
 * Global Features
 *
 * PHP version 8.1
 *
 * @category Module
 *
 * @author ChillCode https://github.com/chillcode
 * @copyright 2003
 * @license https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *
 * @version GIT: 1.0.0
 *
 * @see https://github.com/chillcode
 */

defined('_PS_VERSION_') || exit;

define('globalfeatures_VERSION', '1.0.0');

class globalfeatures extends Module
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->name = 'globalfeatures';
        $this->tab = 'content_management';
        $this->version = '1.0.0';
        $this->author = 'Chillcode';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '9.0.0', 'max' => _PS_VERSION_];

        parent::__construct();

        /**
         * @var string $displayName
         */
        $displayName = $this->trans(
            'Global Features for PrestaShop',
            [],
            'Modules.Globalfeatures.Admin'
        );

        $this->displayName = $displayName;

        /**
         * @var string $description
         */
        $description = $this->trans(
            'Global Features for PrestaShop',
            [],
            'Modules.Globalfeatures.Admin'
        );

        $this->description = $description;

        /**
         * @var string $confirmUninstall
         */
        $confirmUninstall = $this->trans(
            'Are you sure you want to uninstall Global Features for PrestaShop?',
            [],
            'Modules.Globalfeatures.Admin'
        );

        $this->confirmUninstall = $confirmUninstall;
    }

    /**
     * Installs the module from database.
     *
     * @return bool
     */
    public function install()
    {
        /**
         * @var bool $installResult
         */
        $installResult = parent::install();

        return $installResult;
    }

    /**
     * {@inheritdoc}
     */
    public function uninstall()
    {
        return parent::uninstall();
    }
}
