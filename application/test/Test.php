<?php

require 'Rest.php';
require 'Db.php';
require 'Bootstrap.php';
require 'Controller.php';
require 'User.php';

/**
 * Simple tests for basic api functions
 */
class Test extends \PHPUnit_Framework_TestCase {

    private $UserId = 1;
    private $Method = 'GET';

    public function testConnectionIsValid() {
        $connObj = new Db($username = 'spwodna_cargo', $password = '9Kib0VgJXh', $host = 'mysql3.zenbox.pl', $dbname = 'spwodna_cargo', $options = array());
        $this->assertTrue($connObj !== false);
    }

    public function testGetUser() {

        $c = new Controller();
        $result = json_encode($c->getUserAction());
        $expected = '{"id":"1","firstName":"Paul","surname":"Crowe","age":28,"gender":"male","friends":[2]}';

        $this->assertEquals($expected, $result);
    }

    public function testGetFriends() {
        $c = new Controller();
        $result = json_encode($c->getfriendsAction());
        $expected = '[{"Id":"2","Name":"Rob","Surname":"Fitz","Age":"23","Gender":"\u0000"}]';

        $this->assertEquals($expected, $result);
    }

    public function testGetFriendsOfFriend() {
        $c = new Controller();
        return $c->getfriendsoffriendAction();
    }

    public function testSuggested() {
        $_POST['UserId'] = 21;
        $c = new Controller();
        return $c->getsuggestedAction();
    }

    public function setUp() {
        $_POST['UserId'] = $this->UserId;
        $_SERVER['REQUEST_METHOD'] = $this->Method;
    }

}
