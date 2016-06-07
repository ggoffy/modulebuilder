<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.5.0
 *
 * @author          Txmod Xoops http://www.txmodxoops.org
 *
 * @version         $Id: TDMCreateHtmlCode.php 12258 2014-01-02 09:33:29Z timgno $
 */

/**
 * Class TDMCreateHtmlCode.
 */
class TDMCreateHtmlCode
{
    /**
     *  @static function getInstance
     *  @param null
     *
     * @return TDMCreateHtmlCode
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /*
    *  @public function getHtmlTag
    *  @param string $tag
    *  @param array  $attributes
    *  @param string $content
    *  @param bool   $closed
    */
    /**
     * @param $tag
     * @param $attributes
     * @param $content
     * @param $closed
     *
     * @return string
     */
    public function getHtmlTag($tag = '', $attributes = array(), $content = '', $noClosed = false, $noBreack = false, $t = '')
    {
        if (empty($attributes)) {
            $attributes = array();
        }
        $attr = $this->getAttributes($attributes);
        if ($noClosed) {
            $ret = "{$t}<{$tag}{$attr} />\n";
        } elseif ($noBreack) {
            $ret = "{$t}<{$tag}{$attr}>{$content}</{$tag}>\n";
        } else {
            $ret = "{$t}<{$tag}{$attr}>\n";
            $ret .= "{$t}{$content}";
            $ret .= "{$t}</{$tag}>\n";
        }

        return $ret;
    }

     /*
    *  @private function setAttributes
    *  @param array $attributes
    */
    /**
     * @param  $attributes
     *
     * @return string
     */
    private function getAttributes($attributes)
    {
        $str = '';
        foreach ($attributes as $name => $value) {
            if ($name != '_') {
                $str .= ' '.$name.'="'.$value.'"';
            }
        }

        return $str;
    }

    /*
    *  @public function getHtmlEmpty
    *  @param string $empty
    */
    /**
     * @param $empty
     *
     * @return string
     */
    public function getHtmlEmpty($empty = '')
    {
        return "{$empty}";
    }

    /*
    *  @public function getHtmlComment
    *  @param string $htmlComment
    */
    /**
     * @param $htmlComment
     *
     * @return string
     */
    public function getHtmlComment($htmlComment = '')
    {
        return "<!-- {$htmlComment} -->";
    }

    /*
    *  @public function getHtmlBr
    *  @param string $brNumb
    *  @param string $class
    */
    /**
     * @param $brNumb
     * @param $class
     *
     * @return string
     */
    public function getHtmlBr($brNumb = 1, $htmlClass = '', $t = '')
    {
        $brClass = ($htmlClass != '') ? " class='{$htmlClass}'" : '';
        $ret = '';
        for ($i = 0; $i < $brNumb; ++$i) {
            $ret .= "{$t}<br{$brClass} />\n";
        }

        return $ret;
    }

    /*
    *  @public function getHtmlHNumb
    *  @param string $htmlHClass
    *  @param string $content
    */
    /**
     * @param $content
     * @param $htmlHClass
     *
     * @return string
     */
    public function getHtmlHNumb($content = '', $n = '1', $htmlHClass = '', $t = '')
    {
        $hClass = ($htmlHClass != '') ? " class='{$htmlHClass}'" : '';
        $ret = "{$t}<h{$n}{$hClass}>{$content}</h{$n}>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlDiv
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlDiv($content = '', $divClass = '', $t = '')
    {
        $rDivClass = ($divClass != '') ? " class='{$divClass}'" : '';
        $ret = "{$t}<div{$rDivClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</div>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlPre
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlPre($content = '', $preClass = '', $t = '')
    {
        $rPreClass = ($preClass != '') ? " class='{$preClass}'" : '';
        $ret = "{$t}<pre{$rPreClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</pre>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlSpan
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlSpan($content = '', $spanClass = '', $t = '')
    {
        $rSpanClass = ($spanClass != '') ? " class='{$spanClass}'" : '';
        $ret = "{$t}<span{$rSpanClass}>{$content}</span>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlParagraph
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlParagraph($content = '', $pClass = '', $t = '')
    {
        $rPClass = ($pClass != '') ? " class='{$pClass}'" : '';
        $ret = "{$t}<p{$rPClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</p>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlI
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlI($content = '', $iClass = '', $t = '')
    {
        $rIClass = ($iClass != '') ? " class='{$iClass}'" : '';
        $ret = "{$t}<i{$rIClass}>{$content}</i>";

        return $ret;
    }

    /*
    *  @public function getHtmlUl
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlUl($content = '', $ulClass = '', $t = '')
    {
        $rUlClass = ($ulClass != '') ? " class='{$ulClass}'" : '';
        $ret = "{$t}<ul{$rUlClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</ul>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlOl
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlOl($content = '', $olClass = '', $t = '')
    {
        $rOlClass = ($olClass != '') ? " class='{$olClass}'" : '';
        $ret = "{$t}<ol{$rOlClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</ol>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlLi
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlLi($content = '', $liClass = '', $t = '')
    {
        $rLiClass = ($liClass != '') ? " class='{$liClass}'" : '';

        return "{$t}<li{$rLiClass}>{$content}</li>\n";
    }

    /*
    *  @public function getHtmlStrong
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlStrong($content = '', $strongClass = '', $t = '')
    {
        $rStrongClass = ($strongClass != '') ? " class='{$strongClass}'" : '';

        return "{$t}<strong{$rStrongClass}>{$content}</strong>\n";
    }

    /*
    *  @public function getHtmlAnchor
    *  @param string $class
    *  @param string $url
    *  @param string $target
    *  @param string $content
    */
    /**
     * @param $url
     * @param $content
     * @param $target
     * @param $class
     *
     * @return string
     */
    public function getHtmlAnchor($url = '#', $content = '&nbsp;', $title = '', $target = '', $aClass = '', $rel = '', $t = '')
    {
        $target = ($target != '') ? " target='{$target}'" : '';
        $rAClass = ($aClass != '') ? " class='{$aClass}'" : '';
        $rel = ($rel != '') ? " rel='{$rel}'" : '';

        return "{$t}<a{$rAClass} href='{$url}' title='{$title}'{$target}{$rel}>{$content}</a>\n";
    }

    /*
    *  @public function getHtmlImage
    *  @param string $src
    *  @param string $alt
    *  @param string $class
    */
    /**
     * @param $src
     * @param $alt
     * @param $class
     *
     * @return string
     */
    public function getHtmlImage($src = 'blank.gif', $alt = 'blank.gif', $imgClass = '', $t = '')
    {
        $rImgClass = ($imgClass != '') ? " class='{$imgClass}'" : '';
        $ret = "{$t}<img{$rImgClass} src='{$src}' alt='{$alt}' />\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTable
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlTable($content = '', $tableClass = '', $t = '')
    {
        $rTableClass = ($tableClass != '') ? " class='{$tableClass}'" : '';
        $ret = "{$t}<table{$rTableClass}>\n";
        $ret .= "{$t}{$content}";
        $ret .= "{$t}</table>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTableThead
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlTableThead($content = '', $theadClass = '', $t = '')
    {
        $rTheadClass = ($theadClass != '') ? " class='{$theadClass}'" : '';
        $ret = "{$t}\t<thead{$rTheadClass}>\n";
        $ret .= "{$t}\t{$content}";
        $ret .= "{$t}\t</thead>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTableTbody
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlTableTbody($content = '', $tbodyClass = '', $t = '')
    {
        $rTbodyClass = ($tbodyClass != '') ? " class='{$tbodyClass}'" : '';
        $ret = "{$t}\t<tbody{$rTbodyClass}>\n";
        $ret .= "{$t}\t{$content}";
        $ret .= "{$t}\t</tbody>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTableTfoot
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlTableTfoot($content = '', $tfootClass = '', $t = '')
    {
        $rTfootClass = ($tfootClass != '') ? " class='{$tfootClass}'" : '';
        $ret = "{$t}\t<tfoot{$rTfootClass}>\n";
        $ret .= "{$t}\t{$content}";
        $ret .= "{$t}\t</tfoot>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTableRow
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     *
     * @return string
     */
    public function getHtmlTableRow($content = '', $trClass = '', $t = '')
    {
        $rTrClass = ($trClass != '') ? " class='{$trClass}'" : '';
        $ret = "{$t}\t<tr{$rTrClass}>\n";
        $ret .= "{$t}\t{$content}";
        $ret .= "{$t}\t</tr>\n";

        return $ret;
    }

    /*
    *  @public function getHtmlTableHead
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     * @param $colspan
     *
     * @return string
     */
    public function getHtmlTableHead($content = '', $thClass = '', $colspan = '', $t = '')
    {
        $rThClass = ($thClass != '') ? " class='{$thClass}'" : '';
        $colspan = ($colspan != '') ? " colspan='{$colspan}'" : '';

        return "{$t}<th{$colspan}{$rThClass}>{$content}</th>\n";
    }

    /*
    *  @public function getHtmlTableData
    *  @param string $class
    *  @param string $content
    */
    /**
     * @param $content
     * @param $class
     * @param $colspan
     *
     * @return string
     */
    public function getHtmlTableData($content = '', $tdClass = '', $colspan = '', $t = '')
    {
        $rTdClass = ($tdClass != '') ? " class='{$tdClass}'" : '';
        $colspan = ($colspan != '') ? " colspan='{$colspan}'" : '';

        return "{$t}<td{$colspan}{$rTdClass}>{$content}</td>\n";
    }
}
