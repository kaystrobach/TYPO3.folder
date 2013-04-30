<?php

class Tx_Folder_ViewHelpers_CharsetViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @param $value  string Object
	 * @param $format string Object
	 */
	public function render() {
		return mb_convert_encoding($this->renderChildren(), 'utf-8');
	}
}