<?php
class testLogin extends BaseTestCase
{
	public function setUp()
	{
		parent::setUp();
		$this->browser = 'firefox';
		$this->session->open($this->ini['home_page.url']);
	}
 
	public function tearDown()
	{
		parent::tearDown();
	}
 
	public function testPageLoadStep1()
	{
		$this->assertGreaterThan(0, $this->captureScreen($this->session->screenshot()));
		$this->assertEquals('http://'.$this->ini['base.url.host'].$this->ini['landing_page.url.path'], $this->session->url() );
	}
 
	public function testLocationBoxDefaultValue()
	{
		$this->assertEquals(
				$this->ini['landing_page.location_textbox.default_value'],
				$this->getElementFromKey('landing_page.location_textbox.css_selector')->attribute("value")
		);
	}
 
	public function testLocationBoxEnterKeyCity()
	{
 
		$this->getElementFromKey('landing_page.location_textbox.css_selector')->click();
 
		$this->getElementFromKey('landing_page.location_textbox.css_selector')->clear();
 
		type_keys($this->getElementFromKey('landing_page.location_textbox.css_selector'), "Montr\n", 0.1);
 
		$this->assertWaitForElementToAppear("xpath",
				$this->ini['landing_page.step2.xpath'],
				(int)$this->ini['timeout']);
 
	}
 
}