<?php

namespace XoopsModules\Modulebuilder\Files\Language;

use XoopsModules\Modulebuilder;
use XoopsModules\Modulebuilder\Files;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * modulebuilder module.
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.5.0
 *
 * @author          Txmod Xoops http://www.txmodxoops.org
 *
 */

/**
 * Class LanguageMain.
 */
class LanguageMain extends Files\CreateFile
{
    /**
     * @var mixed
     */
    private $ld = null;

    /**
     * @var mixed
     */
    private $pc = null;

    /**
     * @public function constructor
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->ld = LanguageDefines::getInstance();
        $this->pc = Modulebuilder\Files\CreatePhpCode::getInstance();
    }

    /**
     * @static function getInstance
     * @param null
     * @return LanguageMain
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * @public function write
     * @param string $module
     * @param mixed  $tables
     * @param string $filename
     */
    public function write($module, $tables, $filename)
    {
        $this->setModule($module);
        $this->setFileName($filename);
        $this->setTables($tables);
    }

    /**
     * @private function getLanguageMain
     * @param string $module
     * @param string $language
     *
     * @return string
     */
    private function getLanguageMain($module, $language)
    {
        /** @var \XoopsModules\Modulebuilder\Utility $utility */
        $utility = new \XoopsModules\Modulebuilder\Utility();

        $moduleName = $module->getVar('mod_name');
        $tables     = $this->getTables();
        $ret        = $this->ld->getBlankLine();
        $ret        .= $this->pc->getPhpCodeIncludeDir('__DIR__', 'admin', true);
        $ret        .= $this->ld->getBlankLine();
        $ret        .= $this->ld->getAboveHeadDefines('Main');
        $ret        .= $this->ld->getDefine($language, 'INDEX', 'Home');
        $ret        .= $this->ld->getDefine($language, 'TITLE', (string)$module->getVar('mod_name'));
        $ret        .= $this->ld->getDefine($language, 'DESC', (string)$module->getVar('mod_description'));
        $ret        .= $this->ld->getDefine(
            $language,
            'INDEX_DESC',
            "Welcome to the homepage of your new module {$moduleName}!<br>
As you can see, you have created a page with a list of links at the top to navigate between the pages of your module. This description is only visible on the homepage of this module, the other pages you will see the content you created when you built this module with the module ModuleBuilder, and after creating new content in admin of this module. In order to expand this module with other resources, just add the code you need to extend the functionality of the same. The files are grouped by type, from the header to the footer to see how divided the source code.<br><br>If you see this message, it is because you have not created content for this module. Once you have created any type of content, you will not see this message.<br><br>If you liked the module ModuleBuilder and thanks to the long process for giving the opportunity to the new module to be created in a moment, consider making a donation to keep the module ModuleBuilder and make a donation using this button <a href='http://www.txmodxoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations' /></a><br>Thanks!<br><br>Use the link below to go to the admin and create content.",
            true
        );
        $ret        .= $this->ld->getDefine($language, 'NO_PDF_LIBRARY', 'Libraries TCPDF not there yet, upload them in root/Frameworks');
        $ret        .= $this->ld->getDefine($language, 'NO', 'No');
        $ret        .= $this->ld->getDefine($language, 'DETAILS', 'Show details');
        $ret        .= $this->ld->getDefine($language, 'BROKEN', 'Notify broken');
        $ret        .= $this->ld->getAboveHeadDefines('Contents');
        $ucfTableName     = '';
        $ucfTableSoleName = '';
        $stuTableSoleName = '';
        $tableSoleName    = '';
        $tableSubmit      = 0;
        $tableBroken      = 0;
        foreach (array_keys($tables) as $i) {
            $tableName        = $tables[$i]->getVar('table_name');
            $tableSoleName    = $tables[$i]->getVar('table_solename');
            if (1 === (int)$tables[$i]->getVar('table_submit')) {
                $tableSubmit = 1;
            }
            if (1 === (int)$tables[$i]->getVar('table_broken')) {
                $tableBroken = 1;
            }
            $stuTableName     = mb_strtoupper($tableName);
            $stuTableSoleName = mb_strtoupper($tableSoleName);
            $ucfTableName     = $utility::UcFirstAndToLower($tableName);
            $ucfTableSoleName = $utility::UcFirstAndToLower($tableSoleName);
            $ret              .= $this->ld->getAboveDefines($ucfTableSoleName);
            $ret              .= $this->ld->getDefine($language, $stuTableSoleName, $ucfTableSoleName);
            $ret              .= $this->ld->getDefine($language, $stuTableName, $ucfTableName);
            $ret              .= $this->ld->getDefine($language, "{$stuTableName}_TITLE", "{$ucfTableName} title");
            $ret              .= $this->ld->getDefine($language, "{$stuTableName}_DESC", "{$ucfTableName} description");
            $ret              .= $this->ld->getDefine($language, "{$stuTableName}_LIST", "List of {$ucfTableName}");
            $ret              .= $this->ld->getAboveDefines("Caption of {$ucfTableSoleName}");
            $fields           = $this->getTableFields($tables[$i]->getVar('table_mid'), $tables[$i]->getVar('table_id'));
            foreach (array_keys($fields) as $f) {
                $fieldName     = $fields[$f]->getVar('field_name');
                $rpFieldName   = $this->getRightString($fieldName);
                $fieldNameDesc = ucfirst($rpFieldName);
                $ret           .= $this->ld->getDefine($language, $stuTableSoleName . '_' . $rpFieldName, $fieldNameDesc);
            }
        }
        $ret .= $this->ld->getDefine($language, 'INDEX_THEREARE', "There are %s {$ucfTableName}");
        $ret .= $this->ld->getDefine($language, 'INDEX_LATEST_LIST', "Last {$module->getVar('mod_name')}");
        $ret .= $this->ld->getAboveDefines('Submit');
        $ret .= $this->ld->getDefine($language, 'SUBMIT', 'Submit');
        $ret .= $this->ld->getDefine($language, "SUBMIT_{$stuTableSoleName}", "Submit {$ucfTableSoleName}");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_ALLPENDING', "All {$tableSoleName}/script information are posted pending verification.");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_DONTABUSE', 'Username and IP are recorded, so please do not abuse the system.');
        $ret .= $this->ld->getDefine($language, 'SUBMIT_ISAPPROVED', "Your {$tableSoleName} has been approved");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_PROPOSER', "Submit a {$tableSoleName}");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_RECEIVED', "We have received your {$tableSoleName} info. Thank you !");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_SUBMITONCE', "Submit your {$tableSoleName}/script only once.");
        $ret .= $this->ld->getDefine($language, 'SUBMIT_TAKEDAYS', "This will take many days to see your {$tableSoleName}/script added successfully in our database.");
        if (1 === $tableSubmit) {
            $ret .= $this->ld->getAboveDefines('Form');
            $ret .= $this->ld->getDefine($language, 'FORM_OK', 'Successfully saved');
            $ret .= $this->ld->getDefine($language, 'FORM_DELETE_OK', 'Successfully deleted');
            $ret .= $this->ld->getDefine($language, 'FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>", true);
            $ret .= $this->ld->getDefine($language, 'FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>", true);
            if (1 === $tableBroken) {
                $ret .= $this->ld->getDefine($language, 'FORM_SURE_BROKEN', "Are you sure to notify as broken: <b><span style='color : Red;'>%s </span></b>", true);
            }
            $ret .= $this->ld->getDefine($language, 'INVALID_PARAM', "Invalid parameter", true);
        }
        return $ret;
    }

    /**
     * @private function getLanguageMainFooter
     * @param string $language
     *
     * @return string
     */
    private function getLanguageMainFooter($language)
    {
        $ret = $this->ld->getAboveDefines('Admin link');
        $ret .= $this->ld->getDefine($language, 'ADMIN', 'Admin');
        $ret .= $this->ld->getBelowDefines('End');
        $ret .= $this->ld->getBlankLine();

        return $ret;
    }

    /**
     * @public function render
     * @param null
     * @return bool|string
     */
    public function render()
    {
        $module        = $this->getModule();
        $filename      = $this->getFileName();
        $moduleDirname = $module->getVar('mod_dirname');
        $language      = $this->getLanguage($moduleDirname, 'MA');
        $content       = $this->getHeaderFilesComments($module);
        $content       .= $this->getLanguageMain($module, $language);
        $content       .= $this->getLanguageMainFooter($language);

        $this->create($moduleDirname, 'language/' . $GLOBALS['xoopsConfig']['language'], $filename, $content, _AM_MODULEBUILDER_FILE_CREATED, _AM_MODULEBUILDER_FILE_NOTCREATED);

        return $this->renderFile();
    }
}
