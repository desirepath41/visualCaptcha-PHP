<?php

class CaptchaStartTest extends Slim_Framework_TestCase {
    private $numberOfImages = 6;

    public function testContentType() {
        $this->get( "/start/{$this->numberOfImages}" );
        $this->assertEquals( 200, $this->response->status() );
        $this->assertEquals( 'application/json', $this->response[ 'Content-Type' ] );
    }

    public function testJsonResponse() {
        $this->get( "/start/{$this->numberOfImages}" );
        $this->assertEquals( 200, $this->response->status() );

        $bodyJSON = json_decode( $this->response->body(), true );

        $this->assertNotEmpty( $bodyJSON[ 'values' ] );
        $this->assertNotEmpty( $bodyJSON[ 'imageName' ] );
        $this->assertNotEmpty( $bodyJSON[ 'imageFieldName' ] );
        $this->assertNotEmpty( $bodyJSON[ 'audioFieldName' ] );

        $this->assertCount( $this->numberOfImages, $bodyJSON[ 'values' ] );
        $this->assertEquals( 20, strlen( $bodyJSON[ 'imageFieldName' ] ) );
        $this->assertEquals( 20, strlen( $bodyJSON[ 'audioFieldName' ] ) );
    }
}

?>