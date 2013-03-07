<?php

class BaseTestCase extends PHPUnit_Extensions_Selenium2TestCase {

    protected $web_driver;
    protected $session;
    protected $ini;
    protected $browser;

    public function setUp() {
        $this->ini = parse_ini_file(dirname(__FILE__) . "/website.properties");
        $this->web_driver = new WebDriver($this->ini['selenium.server.url']);
    }

    public function tearDown() {
        $this->session->close();
    }

    public function captureScreen($screenshot) {
        $filename = date('ymdHisu') . '.png';
        $imgData = base64_decode($screenshot);
        return file_put_contents($filename, $imgData);
    }

    public function assertWaitForElementToAppear($type, $locator, $waitTimeInSeconds) {
        $timerUp = time() + $waitTimeInSeconds;
        $lastException = '';

        while ($timerUp > time()) {
            try {
                if ($this->session->element($type, $locator)->displayed()) {
                    return;
                }
            } catch (Exception $e) {
                $lastException = $e->getMessage();
                usleep(50000);
            }
        }

        $this->fail('The element of type "' . $type . '" located by "' . $locator . '" is not visible. ' . $lastException);
    }

    public function getElementFromKey($key) {
        $location = $this->ini[$key];
        if (preg_match('/.*\.xpath/', $key)) {
            return $this->getElementFrom("xpath", $location, null);
        } else if (preg_match('/.*\.css_selector/', $key)) {
            return $this->getElementFrom("css selector", $location, null);
        } else {
            throw new RuntimeException("Unable to extract the selector type from the key '" . $key . "'");
        }
    }

    private function getElementsFrom($selectorType, $location, $session) {
        if (is_null($session)) {
            $session = $this->session;
        }

        $returnValue = null;
        try {
            $returnValue = $session->elements($selectorType, $location);
        } catch (NoSuchElementWebDriverError $e) {
            $returnValue = null;
        }

        return $returnValue;
    }
}