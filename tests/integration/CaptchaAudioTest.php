<?php

class CaptchaAudioTest extends Slim_Framework_TestCase {
    private $numberOfImages = 6;

    public function testNotFound() {
        // Try to retreive audio with no session data
        $this->get( '/audio' );
        $this->assertEquals( 404, $this->response->status() );
    }

    public function testOggNotFound() {
        // Try to retreive audio/ogg with no session data
        $this->get( '/audio/ogg' );
        $this->assertEquals( 404, $this->response->status() );
    }

    public function testContentType() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/audio' );
        $this->assertEquals( 200, $this->response->status() );
        $this->assertEquals( 'audio/mpeg', $this->response[ 'Content-Type' ] );
    }

    public function testOggContentType() {
        // Populate the session
        $_SESSION = json_decode( file_get_contents( __DIR__ . '/../fixtures/session.json' ), true );

        $this->get( '/audio/ogg' );
        $this->assertEquals( 200, $this->response->status() );
        $this->assertEquals( 'application/ogg', $this->response[ 'Content-Type' ] );
    }
}

?>