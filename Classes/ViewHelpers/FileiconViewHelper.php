<?php

class Tx_Folder_ViewHelpers_FileiconViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @param $value string filename
	 * @param $path string basepath for the icon set
	 *
	 * @return string
	 */
	public function render($value, $path = 'typo3/gfx/fileicons/') {
		if(is_dir($value)) {
			if(is_file($path . 'folder.gif')) {
				return $path . 'folder.gif';
			} elseif(is_file($path . 'folder.png')) {
				return $path . 'folder.png';
			} else {
				return 'typo3/gfx/fileicons/folder.png';
			}
		} else {
			$extension = array_pop(explode('.', $value));
			if(is_file($path . $extension . '.gif')) {
				return $path . $extension . '.gif';
			} elseif(is_file($path . $extension . '.png')) {
				return $path . $extension . '.png';
			} elseif(is_file($path . 'default.gif')) {
							return $path . 'default.gif';
			} elseif(is_file($path . 'default.png')) {
				return $path . 'default.png';
			} else {
				return 'typo3/gfx/fileicons/default.gif';
			}
		}
	}
}