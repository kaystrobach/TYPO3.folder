<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "folder".
 *
 * Auto generated 11-03-2013 19:42
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Folder',
	'description' => 'Shows folder content with extbase',
	'category' => 'plugin',
	'author' => 'Kay Strobach',
	'author_email' => 'kay.strobach@typo3.org',
	'author_company' => '(private)',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.5',
	'constraints' => 
	array (
		'depends' => 
		array (
			'extbase' => '1.3',
			'fluid' => '1.3',
			'typo3' => '4.5.0-6.0.99',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
	'_md5_values_when_last_written' => 'a:27:{s:21:"ExtensionBuilder.json";s:4:"9f33";s:12:"ext_icon.gif";s:4:"6759";s:17:"ext_localconf.php";s:4:"0f58";s:14:"ext_tables.php";s:4:"5f32";s:14:"ext_tables.sql";s:4:"d41d";s:39:"Classes/Controller/FolderController.php";s:4:"2a44";s:42:"Classes/ViewHelpers/BasenameViewHelper.php";s:4:"e77b";s:41:"Classes/ViewHelpers/CharsetViewHelper.php";s:4:"23e5";s:40:"Classes/ViewHelpers/CrtimeViewHelper.php";s:4:"04ce";s:42:"Classes/ViewHelpers/FileiconViewHelper.php";s:4:"2afe";s:39:"Classes/ViewHelpers/MtimeViewHelper.php";s:4:"c5a8";s:44:"Configuration/ExtensionBuilder/settings.yaml";s:4:"b217";s:43:"Configuration/FlexForms/flexform_folder.xml";s:4:"a556";s:38:"Configuration/TypoScript/constants.txt";s:4:"ffdb";s:34:"Configuration/TypoScript/setup.txt";s:4:"f6cc";s:40:"Resources/Private/Language/locallang.xml";s:4:"ac41";s:74:"Resources/Private/Language/locallang_csh_tx_folder_domain_model_folder.xml";s:4:"955a";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"5ad1";s:38:"Resources/Private/Layouts/Default.html";s:4:"54ca";s:49:"Resources/Private/Partials/Folder/Properties.html";s:4:"3014";s:48:"Resources/Private/Templates/Folder/Download.html";s:4:"827c";s:44:"Resources/Private/Templates/Folder/List.html";s:4:"7580";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:56:"Resources/Public/Icons/tx_folder_domain_model_folder.gif";s:4:"905a";s:46:"Tests/Unit/Controller/FolderControllerTest.php";s:4:"f2c2";s:38:"Tests/Unit/Domain/Model/FolderTest.php";s:4:"0eef";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>
