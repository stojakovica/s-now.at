<?php

/**
 * Backend Search Addon
 *
 * @author markus[dot]staab[at]redaxo-temp[dot]de Markus Staab
 *
 * @package redaxo4
 * @version svn:$Id$
 */

$error = '';

if ($error != '')
  $REX['ADDON']['installmsg']['be_search'] = $error;
else
  $REX['ADDON']['install']['be_search'] = true;