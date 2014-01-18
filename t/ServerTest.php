<?php

require 'bootstrap.php';

class StackTest extends PHPUnit_Framework_TestCase {

    protected $webservice = "http://thisdayinmusic.icdif.com/";
    protected $response;
    protected $config;

    protected function setUp() {
        $json = file_get_contents( $this->webservice );
        $this->response = json_decode( $json, true );

        #get the configuration file for the app
        $file = file_get_contents("./etc/config.json");
        $this->config = json_decode( $file, true );
    }

    public function testStructure() {
        $this->assertArrayHasKey('response', $this->response);
        $this->assertArrayHasKey('status', $this->response['response']);
        $this->assertArrayHasKey('events', $this->response['response']);
        $this->assertArrayHasKey('pagination', $this->response['response']);
    }


    public function testParameters() {
        //invalid parameter
        $this->assertEquals($this->response['response']['status']['code'], -3);

    }
}

?>