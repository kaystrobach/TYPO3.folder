<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Folder',
	array(
		'Folder' => 'list,download,zipdownload',
		
	),
	// non-cacheable actions
	array(
		'Folder' => '',
		
	)
);

// Register cache 'folder_cache'
if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache'] = array();
}
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache']['backend'] = 't3lib_cache_backend_FileBackend';
$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache']['options'] = array(
	'defaultLifetime' => (60 *5) //5 minutes default lifetime for cache
);

// Define string frontend as default frontend, this must be set with TYPO3 4.5 and below
// and overrides the default variable frontend of 4.6
if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache']['frontend'])) {
    $TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['folder_cache']['frontend'] = 't3lib_cache_frontend_VariableFrontend';
}
?>