<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Kay Strobach <typo3@kay-strobach.de>, (private)
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package folder
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Folder_Controller_FolderController extends Tx_Extbase_MVC_Controller_ActionController {
	protected function initializeAction() {
		$this->settings['path'] = t3lib_div::fixWindowsFilePath($this->settings['path']);
		$cacheIdentifier = md5($this->settings['path']);

		$this->initCachingFramework();

		if (false === ($this->allowedItems = $GLOBALS['typo3CacheManager']->getCache('folder_cache')->get($cacheIdentifier))) {
			$this->allowedItems = $this->fix37701bug(t3lib_div::getAllFilesAndFoldersInPath(array(), $this->settings['path'], '', TRUE));
			$tags               = array();
			$GLOBALS['typo3CacheManager']->getCache('folder_cache')->set(
				$cacheIdentifier,
				$this->allowedItems,
				$tags
			);
		} else {
			#$this->allowedItems = $this->allowedItems;
		}
	}

	protected function initCachingFramework() {
		t3lib_cache::initializeCachingFramework();
		try {
			$this->cacheInstance = $GLOBALS['typo3CacheManager']->getCache('folder_cache');
		} catch (t3lib_cache_exception_NoSuchCache $e) {
			$this->cacheInstance = $GLOBALS['typo3CacheFactory']->create(
				'folder_cache',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['folder_cache']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['folder_cache']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['folder_cache']['options']
			);
		}
	}

	private function fix37701bug($folders) {
		foreach($folders as $key => $value) {
			if(intval($key) == $key) {
				unset($folders[$key]);
				$folders[md5($value)] = $value;
			}
		}
		return $folders;
	}

	private function getMimeType($path) {
		if(function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $path);
			finfo_close($finfo);
		} else {
			$mimeType = 'application/octet-stream';
		}

		return $mimeType;
	}

	/**
	 * action list
	 *
	 * @param $folder string
	 * @return void
	 */
	public function listAction($folderMd5 = null) {
		if(array_key_exists($folderMd5, $this->allowedItems) && is_dir($this->allowedItems[$folderMd5])) {
			$path = $this->allowedItems[$folderMd5];
		} else {
			$path = $this->settings['path'];
		}

		$folders = $this->fix37701bug(t3lib_div::getAllFilesAndFoldersInPath(array(), $path, '---',                            TRUE,  1));
		unset($folders[md5($path)]);
		natsort($folders);

		$files   =                    t3lib_div::getAllFilesAndFoldersInPath(array(), $path, $this->settings['extensionList'], FALSE, 0);
		natsort($files);

		$topFolderId = md5(dirname($path) . '/');
		if((!array_key_exists($topFolderId, $this->allowedItems)) || ($this->settings['path'] == $path)) {
			$topFolderId = null;
		}

		$this->view->assign('topFolderId',     $topFolderId);
		$this->view->assign('currentFolderId', md5($path));
		$this->view->assign('absolutePath',    $path);
		$this->view->assign('relativePath',    str_replace($this->settings['path'], '', $path));
		$this->view->assign('folders',         $folders);
		$this->view->assign('files',           $files);
		$this->view->assign('settings',        $this->settings);
		$this->view->assign('allowedItems',    $this->allowedItems);
	}

	/**
	 * action download
	 *
	 * @param $fileMd5 string
	 * @return void
	 */
	public function downloadAction($fileMd5 = '') {
		if(array_key_exists($fileMd5, $this->allowedItems) && is_file($this->allowedItems[$fileMd5])) {
			$path = $this->allowedItems[$fileMd5];
			header('Content-Type: ' . $this->getMimeType($path));
			header('Content-Disposition: attachment; filename="' . basename($path) . '"');
			header('Content-Transfer-Encoding: binary');
			readfile($path);
			die();
		} else {
			print_r($fileMd5);
			print_r($this->allowedItems);
		}
	}

	/**
	 * action zipdownload
	 *
	 * @param $fileMd5 string
	 * @return void
	 */
	public function zipdownloadAction($fileMd5 = '') {
		if(array_key_exists($fileMd5, $this->allowedItems)) {
			$path = $this->allowedItems[$fileMd5];
			$zipFileName = t3lib_div::tempNam('zipDownload');
			$zip = new ZipArchive();
			$zip->open($zipFileName);
			foreach($this->allowedItems as $item) {
				if(substr($item, 0, strlen($path)) == $path) {
					if(is_file($item)) {
						$zip->addFile($item, str_replace($path, '', $item));
					}
				}
			}
			$zip->close();
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . basename($path) . '.zip"');
			#header('Content-Length: ' . filesize($path));
			header('Content-Transfer-Encoding: binary');
			readfile($zipFileName);
			unlink($zipFileName);
			die();
		} else {
			die('failed');
		}
	}
}
?>