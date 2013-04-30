<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	'Folder',
	'Folder',
	'Show Folder'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Folder');


$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['folder_folder'] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['folder_folder'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue('folder_folder', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_folder.xml');

?>