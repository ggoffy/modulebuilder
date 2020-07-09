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
 * modulebuilder module.
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.5.5
 *
 * @author          Txmod Xoops <support@txmodxoops.org>
 *
 */

// Define main template
$templateMain = 'modulebuilder_index.tpl';

include __DIR__ . '/header.php';
// Recovered value of argument op in the URL $
$op    = \Xmf\Request::getString('op', 'list');

switch ($op) {
    case 'list':
    default:
        

        break;
    case 'fqnreplacer':
        $src_path = TDMC_PATH ;
        $dst_path = TDMC_UPLOAD_REPOSITORY_PATH . '/fqnreplacer';

        $patterns = [
            //remove backslash if alreadyin order to avoid \\
            '\array_diff('             => 'array_diff(',
            '\array_filter('           => 'array_filter(',
            '\array_key_exists('       => 'array_key_exists(',
            '\array_keys('             => 'array_keys(',
            '\array_search('           => 'array_search(',
            '\array_slice('            => 'array_slice(',
            '\array_unshift('          => 'array_unshift(',
            '\assert('                 => 'assert(',
            '\basename('               => 'basename(',
            '\boolval('                => 'boolval(',
            '\call_user_func('         => 'call_user_func(',
            '\call_user_func_array('   => 'call_user_func_array(',
            '\chr('                    => 'chr(',
            '\class_exists('           => 'class_exists(',
            '\closedir('               => 'closedir(',
            '\constant('               => 'constant(',
            '\copy('                   => 'copy(',
            '\count('                  => 'count(',
            '\curl_close('             => 'curl_close(',
            '\curl_error('             => 'curl_error(',
            '\curl_exec('              => 'curl_exec(',
            '\curl_file_create('       => 'curl_file_create(',
            '\curl_getinfo('           => 'curl_getinfo(',
            '\curl_init('              => 'curl_init(',
            '\curl_setopt('            => 'curl_setopt(',
            '\define('                 => 'define(',
            '\defined('                => 'defined(',
            '\dirname('                => 'dirname(',
            '\doubleval('              => 'doubleval(',
            '\explode('                => 'explode(',
            '\extension_loaded('       => 'extension_loaded(',
            '\file_exists('            => 'file_exists(',
            '\finfo_open('             => 'finfo_open(',
            '\floatval('               => 'floatval(',
            '\floor('                  => 'floor(',
            '\formatTimestamp('        => 'formatTimestamp(',
            '\func_get_args('          => 'func_get_args(',
            '\func_num_args('          => 'func_num_args(',
            '\function_exists('        => 'function_exists(',
            '\get_called_class('       => 'get_called_class(',
            '\get_class('              => 'get_class(',
            '\getimagesize('           => 'getimagesize(',
            '\gettype('                => 'gettype(',
            '\imagecopyresampled('     => 'imagecopyresampled(',
            '\imagecreatefromgif('     => 'imagecreatefromgif(',
            '\imagecreatefromjpeg('    => 'imagecreatefromjpeg(',
            '\imagecreatefrompng('     => 'imagecreatefrompng(',
            '\imagecreatefromstring('  => 'imagecreatefromstring(',
            '\imagecreatetruecolor('   => 'imagecreatetruecolor(',
            '\imagedestroy('           => 'imagedestroy(',
            '\imagegif('               => 'imagegif(',
            '\imagejpeg('              => 'imagejpeg(',
            '\imagepng('               => 'imagepng(',
            '\imagerotate('            => 'imagerotate(',
            '\imagesx('                => 'imagesx(',
            '\imagesy('                => 'imagesy(',
            '\implode('                => 'implode(',
            '\in_array('               => 'in_array(',
            '\ini_get('                => 'ini_get(',
            '\intval('                 => 'intval(',
            '\is_array('               => 'is_array(',
            '\is_bool('                => 'is_bool(',
            '\is_callable('            => 'is_callable(',
            '\is_dir('                 => 'is_dir(',
            '\is_double('              => 'is_double(',
            '\is_float('               => 'is_float(',
            '\is_int('                 => 'is_int(',
            '\is_integer('             => 'is_integer(',
            '\is_link('                => 'is_link(',
            '\is_long('                => 'is_long(',
            '\is_null('                => 'is_null(',
            '\is_object('              => 'is_object(',
            '\is_real('                => 'is_real(',
            '\is_resource('            => 'is_resource(',
            '\is_string('              => 'is_string(',
            '\json_decode('            => 'json_decode(',
            '\json_encode('            => 'json_encode(',
            '\mime_content_type('      => 'mime_content_type(',
            '\mkdir('                  => 'mkdir(',
            '\opendir('                => 'opendir(',
            '\ord('                    => 'ord(',
            '\pathinfo('               => 'pathinfo(',
            '\preg_match('             => 'preg_match(',
            '\preg_match_all('         => 'preg_match_all(',
            '\preg_replace('           => 'preg_replace(',
            '\readdir('                => 'readdir(',
            '\readlink('               => 'readlink(',
            '\redirect_header('        => 'redirect_header(',
            '\rename('                 => 'rename(',
            '\rmdir('                  => 'rmdir(',
            '\round('                  => 'round(',
            '\scandir('                => 'scandir(',
            '\sprintf('                => 'sprintf(',
            '\str_replace('            => 'str_replace(',
            '\strip_tags('             => 'strip_tags(',
            '\strlen('                 => 'strlen(',
            '\strpos('                 => 'strpos(',
            '\strtotime('              => 'strtotime(',
            '\strval('                 => 'strval(',
            '\substr('                 => 'substr(',
            '\symlink('                => 'symlink(',
            '\time()'                  => 'time()',
            '\trigger_error('          => 'trigger_error(',
            '\trim('                   => 'trim(',
            '\ucfirst('                => 'ucfirst(',
            '\unlink('                 => 'unlink(',
            '\version_compare('        => 'version_compare(',
            '\xoops_getHandler('       => 'xoops_getHandler(',
            '\xoops_load('             => 'xoops_load(',
            '\xoops_loadLanguage('     => 'xoops_loadLanguage(',

            //add backslash to all functions
            'array_diff('              => '\array_diff(',
            'array_filter('            => '\array_filter(',
            'array_key_exists('        => '\array_key_exists(',
            'array_keys('              => '\array_keys(',
            'array_search('            => '\array_search(',
            'array_slice('             => '\array_slice(',
            'array_unshift('           => '\array_unshift(',
            'assert('                  => '\assert(',
            'basename('                => '\basename(',
            'boolval('                 => '\boolval(',
            'call_user_func('          => '\call_user_func(',
            'call_user_func_array('    => '\call_user_func_array(',
            'chr('                     => '\chr(',
            'class_exists('            => '\class_exists(',
            'closedir('                => '\closedir(',
            'constant('                => '\constant(',
            'copy('                    => '\copy(',
            'count('                   => '\count(',
            'curl_close('              => '\curl_close(',
            'curl_error('              => '\curl_error(',
            'curl_exec('               => '\curl_exec(',
            'curl_file_create('        => '\curl_file_create(',
            'curl_getinfo('            => '\curl_getinfo(',
            'curl_init('               => '\curl_init(',
            'curl_setopt('             => '\curl_setopt(',
            'define('                  => '\define(',
            'defined('                 => '\defined(',
            'dirname('                 => '\dirname(',
            'doubleval('               => '\doubleval(',
            'explode('                 => '\explode(',
            'extension_loaded('        => '\extension_loaded(',
            'file_exists('             => '\file_exists(',
            'finfo_open('              => '\finfo_open(',
            'floatval('                => '\floatval(',
            'floor('                   => '\floor(',
            'formatTimestamp('         => '\formatTimestamp(',
            'func_get_args('           => '\func_get_args(',
            'func_num_args('           => '\func_num_args(',
            'function_exists('         => '\function_exists(',
            'get_called_class('        => '\get_called_class(',
            'get_class('               => '\get_class(',
            'getimagesize('            => '\getimagesize(',
            'gettype('                 => '\gettype(',
            'imagecopyresampled('      => '\imagecopyresampled(',
            'imagecreatefromgif('      => '\imagecreatefromgif(',
            'imagecreatefromjpeg('     => '\imagecreatefromjpeg(',
            'imagecreatefrompng('      => '\imagecreatefrompng(',
            'imagecreatefromstring('   => '\imagecreatefromstring(',
            'imagecreatetruecolor('    => '\imagecreatetruecolor(',
            'imagedestroy('            => '\imagedestroy(',
            'imagegif('                => '\imagegif(',
            'imagejpeg('               => '\imagejpeg(',
            'imagepng('                => '\imagepng(',
            'imagerotate('             => '\imagerotate(',
            'imagesx('                 => '\imagesx(',
            'imagesy('                 => '\imagesy(',
            'implode('                 => '\implode(',
            'in_array('                => '\in_array(',
            'ini_get('                 => '\ini_get(',
            'intval('                  => '\intval(',
            'is_array('                => '\is_array(',
            'is_bool('                 => '\is_bool(',
            'is_callable('             => '\is_callable(',
            'is_dir('                  => '\is_dir(',
            'is_double('               => '\is_double(',
            'is_float('                => '\is_float(',
            'is_int('                  => '\is_int(',
            'is_integer('              => '\is_integer(',
            'is_link('                 => '\is_link(',
            'is_long('                 => '\is_long(',
            'is_null('                 => '\is_null(',
            'is_object('               => '\is_object(',
            'is_real('                 => '\is_real(',
            'is_resource('             => '\is_resource(',
            'is_string('               => '\is_string(',
            'json_decode('             => '\json_decode(',
            'json_encode('             => '\json_encode(',
            'mime_content_type('       => '\mime_content_type(',
            'mkdir('                   => '\mkdir(',
            'opendir('                 => '\opendir(',
            'ord('                     => '\ord(',
            'pathinfo('                => '\pathinfo(',
            'preg_match('              => '\preg_match(',
            'preg_match_all('          => '\preg_match_all(',
            'preg_replace('            => '\preg_replace(',
            'readdir('                 => '\readdir(',
            'readlink('                => '\readlink(',
            'redirect_header('         => '\redirect_header(',
            'rename('                  => '\rename(',
            'rmdir('                   => '\rmdir(',
            'round('                   => '\round(',
            'scandir('                 => '\scandir(',
            'sprintf('                 => '\sprintf(',
            'str_replace('             => '\str_replace(',
            'strip_tags('              => '\strip_tags(',
            'strlen('                  => '\strlen(',
            'strpos('                  => '\strpos(',
            'strtotime('               => '\strtotime(',
            'strval('                  => '\strval(',
            'substr('                  => '\substr(',
            'symlink('                 => '\symlink(',
            'time()'                   => '\time()',
            'trigger_error('           => '\trigger_error(',
            'trim('                    => '\trim(',
            'ucfirst('                 => '\ucfirst(',
            'unlink('                  => '\unlink(',
            'version_compare('         => '\version_compare(',
            'xoops_getHandler('        => '\xoops_getHandler(',
            'xoops_load('              => '\xoops_load(',
            'xoops_loadLanguage('      => '\xoops_loadLanguage(',

            //correct errors
            'mb_\strlen('              => 'mb_strlen(',
            'mb_\substr('              => 'mb_substr(',
            'x\copy'                   => 'xcopy',
            'r\rmdir'                  => 'rrmdir',
            'r\copy'                   => 'rcopy',
            '\dirname()'               => 'dirname()',
            'assw\ord'                 => 'assword',
            'mb_\strpos'               => 'mb_strpos',
        ];

        $patKeys   = \array_keys($patterns);
        $patValues = array_values($patterns);
        cloneFileFolder($src_path, $dst_path, $patKeys, $patValues);

        break;
}

include __DIR__ . '/footer.php';

// recursive cloning script
/**
 * @param $src_path
 * @param $dst_path
 * @param array $patKeys
 * @param array $patValues
 */
function cloneFileFolder($src_path, $dst_path, $patKeys = [], $patValues =[])
{
    // open the source directory
    $dir = \opendir($src_path);
    // Make the destination directory if not exist
    @\mkdir($dst_path);
    // Loop through the files in source directory
    while( $file = \readdir($dir) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( \is_dir($src_path . '/' . $file) ) {
                // Recursively calling custom copy function for sub directory
                cloneFileFolder($src_path . '/' . $file, $dst_path . '/' . $file, $patKeys, $patValues);
            } else {
                cloneFile($src_path . '/' . $file, $dst_path . '/' . $file, $patKeys, $patValues);
            }
        }
    }
    \closedir($dir);
}

/**
 * @param $src_file
 * @param $dst_file
 * @param array $patKeys
 * @param array $patValues
 */
function cloneFile($src_file, $dst_file, $patKeys = [], $patValues =[])
{
    $replace_code = false;
    $changeExtensions = ['php'];
    if (in_array(mb_strtolower(\pathinfo($src_file, PATHINFO_EXTENSION)), $changeExtensions)) {
        $replace_code = true;
    }
    if (\strpos( $dst_file, basename(__FILE__)) > 0) {
        //skip myself
        $replace_code = false;
    }
    if ($replace_code) {
        // file, read it and replace text
        $content = file_get_contents($src_file);
        $content = \str_replace($patKeys, $patValues, $content);
        //check file name whether it contains replace code
        $path_parts = \pathinfo($dst_file);
        $path = $path_parts['dirname'];
        $file =  $path_parts['basename'];
        $dst_file = $path . '/' . \str_replace($patKeys, $patValues, $file);
        file_put_contents($dst_file, $content);
    } else {
        \copy($src_file, $dst_file);
    }
}

