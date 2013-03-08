<?php
class WebTest extends BaseTestCase
{
    protected function setUp()
    {
        parent::setup();
    }

    public function testTitle()
    {
        $this->url('http://www.google.com/');
        echo $this->title();
        // $this->assertEquals('Example WWW Page', $this->title());
    }

}