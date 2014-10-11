<?php

/**
 * Textile Addon
 *
 * @author markus[dot]staab[at]redaxo-temp[dot]de Markus Staab
 *
 * @package redaxo4
 * @version svn:$Id$
 */

$mypage = 'textile';

$REX['ADDON']['rxid'][$mypage] = '79';
$REX['ADDON']['name'][$mypage] = 'Textile';
$REX['ADDON']['perm'][$mypage] = 'textile[]';
$REX['ADDON']['version'][$mypage] = '1.5';
$REX['ADDON']['author'][$mypage] = "Markus Staab, Dean Allen www.textism.com, Steve (github.com/netcarver/textile)";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo-temp.de';

$REX['PERM'][] = 'textile[]';
$REX['EXTPERM'][] = 'textile[help]';

require_once($REX['INCLUDE_PATH']. '/addons/textile/vendor/classtextile.php');
require_once $REX['INCLUDE_PATH']. '/addons/textile/functions/function_textile.inc.php';

if ($REX['REDAXO'])
{
  require_once $REX['INCLUDE_PATH'].'/addons/textile/extensions/function_extensions.inc.php';
  require_once $REX['INCLUDE_PATH'].'/addons/textile/functions/function_help.inc.php';

  $I18N->appendFile($REX['INCLUDE_PATH'].'/addons/'.$mypage.'/lang/');

  rex_register_extension('PAGE_HEADER', 'rex_a79_css_add');
}
