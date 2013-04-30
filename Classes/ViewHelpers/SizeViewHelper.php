<?php

class Tx_Folder_ViewHelpers_SizeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @param $value  string Object
	 */
	public function render($value) {

		return t3lib_div::formatSize(@filesize($value));
	}
}