<?php

namespace ider\FlashMessages;

/**
 * Test class for flash messages 
 */
class FlashMessagesTest extends \PHPUnit_Framework_TestCase {
    
    protected $flash;

    /**
     * Creates an instance of the FlashMessage class before every test runs
     */
    protected function setUp() {
        $this->flash = new FlashMessages();
    }

    /**
     * Tests getSessionKey method
     */
    public function testGetSessionKey() {
        $this->assertEquals($this->flash->getSessionKey(), "FlashMessages", "Wrong session key.");
    }

    /**
     * Testing to add a flash message
     */
    public function testAdd() {
        $msg = "message";
        $type = "invalid message type";
        $this->flash->add($msg, $type);
        $messages = $_SESSION[$this->flash->getSessionKey()];
        $this->assertTrue(count($messages) === 1);
        $this->assertEquals("info", $messages[0]["type"], "Error! Wrong message type.");
        $this->assertEquals($msg, $messages[0]["content"], "Error! Wrong message content.");
    }

    /**
     * Testing to find all messages after something gets added
     */
    public function testFindAll() {
        $expected = [];
        $messages = $this->flash->findAll();
        $this->assertEquals($expected, $messages);

        $this->flash->add("message", "info");
        $messages = $this->flash->findAll();
        $expected = $_SESSION[$this->flash->getSessionKey()];
        $this->assertEquals($expected, $messages, "Did not found the right messages.");
    }

    /**
     * Tests addSuccess method
     */
    public function testAddSuccess() {
        $msg = "success message";
        $this->flash->addSuccess($msg);
        $messages = $this->flash->findAll();
        $this->assertTrue(count($messages) === 1, "Not one message in session");
        $this->assertEquals("success", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addInfo method
     */
    public function testAddInfo() {
        $msg = "info message";
        $this->flash->addInfo($msg);
        $messages = $this->flash->findAll();
        $this->assertTrue(count($messages) === 1, "Not one message in session");
        $this->assertEquals("info", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addWarning method
     */
    public function testAddWarning() {
        $msg = "warning message";
        $this->flash->addWarning($msg);
        $messages = $this->flash->findAll();
        $this->assertTrue(count($messages) === 1, "Not one message in session");
        $this->assertEquals("warning", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addError method
     */
    public function testAddError() {
        $msg = "error message";
        $this->flash->addError($msg);
        $messages = $this->flash->findAll();
        $this->assertTrue(count($messages) === 1, "Not one message in session");
        $this->assertEquals("error", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests GetHtml method
     */
    public function testGetHtml() {
        $this->assertEquals('', $this->flash->getHtml(), "Html not empty");

        $successmessage = "This is a success message.";
        $this->flash->addSuccess($successmessage);
        $expectedHtml = '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';
        $this->assertEquals($expectedHtml, $this->flash->getHtml(), "Html did not match (first message)");  

        $class = "myCssClass";

        $errormessage = "This is an error message.";
        $this->flash->addError($errormessage);
        $expectedHtml = '<div class="'. $class . ' '. $class . '-danger" role="alert">'.$errormessage.'</div>';

        $infomessage = "This is an info message.";        
        $this->flash->addInfo($infomessage);
        $expectedHtml .= '<div class="'. $class . ' '. $class . '-info" role="alert">'.$infomessage.'</div>';

        $this->assertEquals($expectedHtml, $this->flash->getHtml($class), "Html did not match (second message)");        
    }

    /**
     * Tests clean method
     */
    public function testClean() {
        $this->flash->add("message", "info");
        $this->flash->clean();
        $this->assertEquals(NULL, $_SESSION[$this->flash->getSessionKey()], "Session was not reset!");
    }

}