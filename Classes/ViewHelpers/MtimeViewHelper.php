<?php

class Tx_Folder_ViewHelpers_MtimeViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @param $value  string Object
	 * @param $format string Object
	 */
	public function render($value, $format = 'd.m.Y H:i:s') {
		return date($format, @filemtime($value));
	}
}