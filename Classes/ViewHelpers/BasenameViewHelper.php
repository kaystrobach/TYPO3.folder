<?php

class Tx_Folder_ViewHelpers_BasenameViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @param $value  string Object
	 */
	public function render($value) {
		return basename($value);
	}
}