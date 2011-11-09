<?php

class Janrain_Engage_Model_Session extends Mage_Core_Model_Session_Abstract {
    const ENGAGE_ALLOWED_LOGIN_METHODS = 'validatePassword,authenticateAction';
    const ENGAGE_ALLOWED_CLASS_PREFIX = 'Janrain_Engage';

    public function __construct() {
        $namespace = 'engage';
        $namespace .= '_' . (Mage::app()->getStore()->getWebsite()->getCode());

        $this->init($namespace);
        Mage::dispatchEvent('engage_session_init', array('engage_session' => $this));
    }

    public function setLoginRequest($value) {

        /**
         * Added security measure. Test whether the setLoginRequest session var
         * is being set from within this module or from another.
         *
         */
        $allowed_methods = explode(',', self::ENGAGE_ALLOWED_LOGIN_METHODS);
        $trace = debug_backtrace();

        if (isset($trace[1]['class']) && strpos($trace[1]['class'], self::ENGAGE_ALLOWED_CLASS_PREFIX) == 0 && in_array($trace[1]['function'], $allowed_methods))
            $this->setData("login_request", $value);
        else
            Mage::throwException('Method request not allowed');

        return $this;
    }

}
