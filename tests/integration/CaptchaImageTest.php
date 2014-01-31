<?php

class CaptchaImageTest extends Slim_Framework_TestCase {
    private $numberOfImages = 6;

    public function testNotFound() {
        // Try to retreive image with no session data
        $this->get( '/image/0' );
        $this->assertEquals( 404, $this->response->status() );
    }

    public function testInvalidIndex() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/image/2' );
        $this->assertEquals( 404, $this->response->status() );
    }

    public function testValidIndex() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/image/0' );
        $this->assertEquals( 200, $this->response->status() );
    }

    public function testContentType() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/image/0' );
        $this->assertEquals( 200, $this->response->status() );
        $this->assertEquals( 'image/png', $this->response[ 'Content-Type' ] );
    }

    public function testRetinaContentType() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/image/0', [ 'QUERY_STRING' => 'retina=1' ] );
        $this->assertEquals( 200, $this->response->status() );
        $this->assertEquals( 'image/png', $this->response[ 'Content-Type' ] );
    }
}

?>