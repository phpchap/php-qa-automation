<?php
namespace Test\WebDriver;

use WebDriver\Storage;

class BaseTestCase extends PHPUnit_Extensions_Selenium2TestCase {

    protected $web_driver;
    protected $session;
    protected $ini;
    protected $browser;

    /**
     * initialise the selenium session
     */
    protected function setUp() {
        // define the path to the website properties ini file
        $ds = DIRECTORY_SEPARATOR;
        $propertiesPath = dirname(__FILE__) . $ds . "..". $ds."properties".$ds."website.properties";
        // parse the ini file
        $this->ini = parse_ini_file($propertiesPath);
        // create the web driver
        $this->web_driver = new WebDriver($this->ini['selenium.server.url']);
        // start the session
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://www.google.com/');
    }

    /**
     * end the session
     */
    public function tearDown() {
//        $this->web_driver->close();
    }

    /**
     * capture a screenshot
     * @param type $screenshot
     * @return type
     */
    public function captureScreen($screenshot) {
        $filename = date('ymdHisu') . '.png';
        $imgData = base64_decode($screenshot);
        return file_put_contents($filename, $imgData);
    }

    /**
     * wait for an element to appear on the page
     * @param type $type
     * @param type $locator
     * @param type $waitTimeInSeconds
     * @return type
     */
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

    /**
     * find an element on a page
     * @param type $key
     * @return type
     * @throws RuntimeException
     */
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