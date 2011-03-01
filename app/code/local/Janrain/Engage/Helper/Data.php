<?php

class Janrain_Engage_Helper_Data extends Mage_Core_Helper_Abstract {

	public function isEngageEnabled() {
		return Mage::getStoreConfig('engage/options/enable');
	}

	public function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
		$chars_length = (strlen($chars) - 1);

		$string = $chars{rand(0, $chars_length)};

		for ($i = 1; $i < $length; $i = strlen($string)) {
			$r = $chars{rand(0, $chars_length)};

			if ($r != $string{$i - 1})
				$string .= $r;
		}

		return $string;
	}

	public function _baseSkin() {
		return Mage::getBaseUrl('skin') . "frontend/janrain";
	}

}