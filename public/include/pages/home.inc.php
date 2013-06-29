<?php

// Make sure we are called from index.php
if (!defined('SECURITY')) die('Hacking attempt');

// Include markdown library
use \Michelf\Markdown;

// Fetch active news to display
$aNews = $news->getAllActive();
foreach ($aNews as $key => $aData) {
  // Transform Markdown content to HTML
  $aNews[$key]['content'] = Markdown::defaultTransform($aData['content']);
}

// Load news entries in case news is the homepage
$smarty->assign("NEWS", $aNews);

// Tempalte specifics
if ($detect->isMobile()) {
  if ($config['payout_system'] == 'pps') {
    $smarty->assign("CONTENT", "pps.tpl");
  } else {
    $smarty->assign("CONTENT", "default.tpl");
  }
} else {
  $smarty->assign("CONTENT", "default.tpl");
}
?>
