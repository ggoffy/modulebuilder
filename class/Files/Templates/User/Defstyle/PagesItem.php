<?php declare(strict_types=1);

namespace XoopsModules\Modulebuilder\Files\Templates\User\Defstyle;

use XoopsModules\Modulebuilder;
use XoopsModules\Modulebuilder\{
    Files,
    Constants
};

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
 * @license         GNU GPL 2 (https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.5.0
 *
 * @author          Txmod Xoops https://xoops.org 
 *                  Goffy https://myxoops.org
 */

/**
 * class PagesItem.
 */
class PagesItem extends Files\CreateFile
{
    /**
     * @var mixed
     */
    private $hc = null;
    /**
     * @var mixed
     */
    private $sc = null;

    /**
     * @public function constructor
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->hc = Modulebuilder\Files\CreateHtmlCode::getInstance();
        $this->sc = Modulebuilder\Files\CreateSmartyCode::getInstance();
    }

    /**
     * @static function getInstance
     * @param null
     * @return PagesItem
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
     * @param        $module
     * @param        $table
     * @param string $filename
     * @param        $tables
     */
    public function write($module, $table, $tables, $filename): void
    {
        $this->setModule($module);
        $this->setTable($table);
        $this->setTables($tables);
        $this->setFileName($filename);
    }

    /**
     * @private function getTemplatesUserPagesItemPanel
     * @param string $moduleDirname
     * @param        $tableId
     * @param        $tableMid
     * @param        $tableName
     * @param        $tableSoleName
     * @param        $tableRate
     * @param        $tableBroken
     * @param        $language
     * @return string
     */
    private function getTemplatesUserPagesItemPanel($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableRate, $tableBroken, $language)
    {
        $fields  = $this->getTableFields($tableMid, $tableId);
        $ret     = '';
        $retNumb = '';
        $fieldId   = '';
        $ccFieldId = '';
        $keyDouble = '';
        foreach (\array_keys($fields) as $f) {
            if (0 == $f) {
                $fieldId = $fields[$f]->getVar('field_name');
                $ccFieldId = $this->getCamelCase($fieldId, false, true);
                $keyDouble = $this->sc->getSmartyDoubleVar($tableSoleName, $this->getRightString($fieldId));
            }
            $fieldElement = $fields[$f]->getVar('field_element');
            if (1 == $fields[$f]->getVar('field_user')) {
                if (1 == $fields[$f]->getVar('field_thead')) {
                    switch ($fieldElement) {
                        default:
                            $fieldName = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $retNumb .= $this->hc->getHtmlHNumb($doubleVar, '3', 'panel-title', "\t");
                            break;
                        case Constants::FIELD_ELE_TEXTAREA:
                        case Constants::FIELD_ELE_DHTMLTEXTAREA:
                            $fieldName = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_short');
                            $retNumb .= $this->hc->getHtmlHNumb($doubleVar, '3', 'panel-title', "\t");
                            break;
                        case Constants::FIELD_ELE_SELECTSTATUS:
                        case Constants::FIELD_ELE_RADIOYN:
                        case Constants::FIELD_ELE_SELECTUSER:
                        case Constants::FIELD_ELE_DATETIME:
                        case Constants::FIELD_ELE_TEXTDATESELECT:
                            $fieldName = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_text');
                            $retNumb .= $this->hc->getHtmlHNumb($doubleVar, '3', 'panel-title', "\t");
                            break;
                        case Constants::FIELD_ELE_IMAGELIST:
                            $fieldName = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar = $this->sc->getSmartySingleVar('xoops_icons32_url');
                            $doubleVar = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img = $this->hc->getHtmlImage($singleVar . '/' . $doubleVar, (string)$tableName);
                            $retNumb .= $this->hc->getHtmlHNumb($doubleVar, '3', 'panel-title', "\t");
                            unset($img);
                            break;
                        case Constants::FIELD_ELE_UPLOADIMAGE:
                            $fieldName = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar = $this->sc->getSmartySingleVar($moduleDirname . '_upload_url');
                            $doubleVar = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img = $this->hc->getHtmlImage($singleVar . "/images/{$tableName}/" . $doubleVar, (string)$tableName);
                            $retNumb .= $this->hc->getHtmlHNumb($doubleVar, '3', 'panel-title', "\t");
                            unset($img);
                            break;
                    }
                }
            }
        }
        $ret     .= $this->hc->getHtmlI('', '', $ccFieldId . '_' . $keyDouble);
        $ret     .= $this->hc->getHtmlDiv($retNumb, 'panel-heading');
        $retElem = '';
        foreach (\array_keys($fields) as $f) {
            $fieldElement = $fields[$f]->getVar('field_element');
            if (1 == $fields[$f]->getVar('field_user')) {
                if (1 == $fields[$f]->getVar('field_tbody')) {
                    switch ($fieldElement) {
                        default:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $retElem     .= $this->hc->getHtmlSpan($doubleVar, 'col-sm-9 justify', "\t");
                            break;
                        case Constants::FIELD_ELE_TEXTAREA:
                        case Constants::FIELD_ELE_DHTMLTEXTAREA:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_short');
                            $retElem     .= $this->hc->getHtmlSpan($doubleVar, 'col-sm-9 justify', "\t");
                            break;
                        case Constants::FIELD_ELE_SELECTSTATUS:
                        case Constants::FIELD_ELE_RADIOYN:
                        case Constants::FIELD_ELE_SELECTUSER:
                        case Constants::FIELD_ELE_DATETIME:
                        case Constants::FIELD_ELE_TEXTDATESELECT:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_text');
                            $retElem     .= $this->hc->getHtmlSpan($doubleVar, 'col-sm-9 justify', "\t");
                            break;
                        case Constants::FIELD_ELE_IMAGELIST:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar   = $this->sc->getSmartySingleVar('xoops_icons32_url');
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img         = $this->hc->getHtmlImage($singleVar . '/' . $doubleVar, (string)$tableName);
                            $retElem     .= $this->hc->getHtmlSpan($img, 'col-sm-9 justify', "\t");
                            unset($img);
                            break;
                        case Constants::FIELD_ELE_UPLOADIMAGE:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar   = $this->sc->getSmartySingleVar($moduleDirname . '_upload_url');
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img         = $this->hc->getHtmlImage($singleVar . "/images/{$tableName}/" . $doubleVar, (string)$tableName);
                            $retElem     .= $this->hc->getHtmlSpan($img, 'col-sm-9 justify',"\t");
                            unset($img);
                            break;
                    }
                }
            }
        }
        $ret .= $this->hc->getHtmlDiv($retElem, 'panel-body');

        $retFoot   = '';
        foreach (\array_keys($fields) as $f) {
            if (1 == $fields[$f]->getVar('field_user')) {
                if (1 == $fields[$f]->getVar('field_tfoot')) {
                    $fieldElement = $fields[$f]->getVar('field_element');
                    switch ($fieldElement) {
                        default:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $langConst   = \mb_strtoupper($tableSoleName) . '_' . \mb_strtoupper($rpFieldName);
                            $lang        = $this->sc->getSmartyConst($language, $langConst);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $retFoot     .= $this->hc->getHtmlSpan($lang . ': ' . $doubleVar, 'block-pie justify',"\t");
                            break;
                        case Constants::FIELD_ELE_TEXTAREA:
                        case Constants::FIELD_ELE_DHTMLTEXTAREA:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $langConst   = \mb_strtoupper($tableSoleName) . '_' . \mb_strtoupper($rpFieldName);
                            $lang        = $this->sc->getSmartyConst($language, $langConst);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_short');
                            $retFoot     .= $this->hc->getHtmlSpan($lang . ': ' . $doubleVar, 'block-pie justify',"\t");
                            break;
                        case Constants::FIELD_ELE_SELECTSTATUS:
                        case Constants::FIELD_ELE_RADIOYN:
                        case Constants::FIELD_ELE_SELECTUSER:
                        case Constants::FIELD_ELE_DATETIME:
                        case Constants::FIELD_ELE_TEXTDATESELECT:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $langConst   = \mb_strtoupper($tableSoleName) . '_' . \mb_strtoupper($rpFieldName);
                            $lang        = $this->sc->getSmartyConst($language, $langConst);
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName . '_text');
                            $retFoot     .= $this->hc->getHtmlSpan($lang . ': ' . $doubleVar, 'block-pie justify',"\t");
                            break;
                        case Constants::FIELD_ELE_IMAGELIST:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar   = $this->sc->getSmartySingleVar('xoops_icons32_url');
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img         = $this->hc->getHtmlImage($singleVar . '/' . $doubleVar, (string)$tableName);
                            $retElem     .= $this->hc->getHtmlSpan($img, 'block-pie justify', "\t");
                            unset($img);
                            break;
                        case Constants::FIELD_ELE_UPLOADIMAGE:
                            $fieldName   = $fields[$f]->getVar('field_name');
                            $rpFieldName = $this->getRightString($fieldName);
                            $singleVar   = $this->sc->getSmartySingleVar($moduleDirname . '_upload_url');
                            $doubleVar   = $this->sc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $img         = $this->hc->getHtmlImage($singleVar . "/images/{$tableName}/" . $doubleVar, (string)$tableName);
                            $retElem     .= $this->hc->getHtmlSpan($img, 'block-pie justify',"\t");
                            unset($img);
                            break;
                    }
                }
            }
        }

        $anchors  = '';
        $lang     = $this->sc->getSmartyConst($language, \mb_strtoupper($tableName) . '_LIST');
        $contIf   =  $this->hc->getHtmlAnchor($tableName . '.php?op=list&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>#' .$ccFieldId . '_' . $keyDouble, $lang, $lang, '', 'btn btn-success right', '', "\t\t\t", "\n");
        $lang     = $this->sc->getSmartyConst($language, 'DETAILS');
        $contElse =  $this->hc->getHtmlAnchor($tableName . ".php?op=show&amp;{$fieldId}=" . $keyDouble . '&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>', $lang, $lang, '', 'btn btn-success right', '', "\t\t\t", "\n");
        $anchors .= $this->sc->getSmartyConditions('showItem', '', '', $contIf, $contElse, '', '', "\t\t", "\n", true, 'bool');
        $lang     = $this->sc->getSmartyConst('', '_EDIT');
        $contIf   =  $this->hc->getHtmlAnchor($tableName . ".php?op=edit&amp;{$fieldId}=" . $keyDouble . '&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>', $lang, $lang, '', 'btn btn-primary right', '', "\t\t\t", "\n");
        $lang     = $this->sc->getSmartyConst('', '_CLONE');
        $contIf   .=  $this->hc->getHtmlAnchor($tableName . ".php?op=clone&amp;{$fieldId}_source=" . $keyDouble, $lang, $lang, '', 'btn btn-primary right', '', "\t\t\t", "\n");
        $lang     = $this->sc->getSmartyConst('', '_DELETE');
        $contIf   .=  $this->hc->getHtmlAnchor($tableName . ".php?op=delete&amp;{$fieldId}=" . $keyDouble, $lang, $lang, '', 'btn btn-danger right', '', "\t\t\t", "\n");
        $anchors  .= $this->sc->getSmartyConditions('permEdit', '', '', $contIf, false, '', '', "\t\t", "\n", true, 'bool');
        if (1 == $tableBroken) {
            $lang        = $this->sc->getSmartyConst($language, 'BROKEN');
            $anchors .=  $this->hc->getHtmlAnchor($tableName . ".php?op=broken&amp;{$fieldId}=" . $keyDouble . '&amp;start=<{$start|default:0}>&amp;limit=<{$limit|default:0}>', $lang, $lang, '', 'btn btn-warning right', '', "\t\t", "\n");
        }
        $retFoot     .= $this->hc->getHtmlDiv($anchors, 'col-sm-12 right',"\t");
        $ret .= $this->hc->getHtmlDiv($retFoot, 'panel-foot');
        if ($tableRate) {
            $rate = $this->sc->getSmartyIncludeFile($moduleDirname, 'rate', false, "\t", "\n", 'item=$' . $tableSoleName);
            $ret .= $this->sc->getSmartyConditions('rating', '', '', $rate, false, false, false, '', "\n", true, 'bool');
        }

        return $ret;
    }

    /**
     * @public function render
     * @param null
     * @return bool|string
     */
    public function render()
    {
        $module = $this->getModule();
        $table  = $this->getTable();
        $moduleDirname = $module->getVar('mod_dirname');
        $filename      = $this->getFileName();
        $language      = $this->getLanguage($moduleDirname, 'MA', '', false);
        $content       = '';
        $tableId         = $table->getVar('table_id');
        $tableMid        = $table->getVar('table_mid');
        $tableName       = $table->getVar('table_name');
        $tableSoleName   = $table->getVar('table_solename');
        $tableRate       = $table->getVar('table_rate');
        $tableBroken     = $table->getVar('table_broken');
        $tableCategory[] = $table->getVar('table_category');
        if (\in_array(0, $tableCategory)) {
            $content .= $this->getTemplatesUserPagesItemPanel($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableRate, $tableBroken, $language);
        }

        $this->create($moduleDirname, 'templates', $filename, $content, \_AM_MODULEBUILDER_FILE_CREATED, \_AM_MODULEBUILDER_FILE_NOTCREATED);

        return $this->renderFile();
    }
}
