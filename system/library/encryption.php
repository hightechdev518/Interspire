<?php
/**
 * @package		Interspire eCommerce
 * @copyright	Copyright (C) 2015 Interspire Co.,Ltd. All rights reserved. (Interspire.vn)
 * @credits		See CREDITS.txt for credits and other copyright notices.
 * @license		GNU General Public License version 3; see LICENSE.txt
 */

final class Encryption {
	private $key;

	public function __construct($key) {
		$this->key = hash('sha256', $key, true);
	}

	public function encrypt($value) {
		$key = hash('sha256', $this->key, true);
		if (function_exists('mcrypt_encrypt')) {
			return strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB)), '+/=', '-_,');
		}
		$encrypted = openssl_encrypt($value, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
		return strtr(base64_encode($encrypted), '+/=', '-_,');
	}

	public function decrypt($value) {
		$key = hash('sha256', $this->key, true);
		$raw = base64_decode(strtr($value, '-_,', '+/='));
		if (function_exists('mcrypt_decrypt')) {
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $raw, MCRYPT_MODE_ECB));
		}
		return openssl_decrypt($raw, 'AES-256-ECB', $key, OPENSSL_RAW_DATA);
	}
}