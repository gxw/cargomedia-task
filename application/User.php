<?php

/**
 * User model class
 */

class User {

    public $id;
    public $firstName;
    public $surname;
    public $age;
    public $gender;
    public $friends = array(-1);
    
    /**
     * Constructor
     * @param int $UserId
     */
    function __construct( $UserId = -1) {
        if (intval($UserId) > 0) {
            $Db = new Db();
            $userOne = $Db->getRow('SELECT * FROM User WHERE Id = ?', array($UserId));
            $this->id = $userOne['Id'];
            $this->firstName = $userOne['Name'];
            $this->surname = $userOne['Surname'];
            $this->age = intval($userOne['Age']);
            $this->gender = $this->getGenderName($userOne['Gender']);
            $this->friends = $this->getFriendsId();
        }
    }
    /**
     * Return an array with IDs of user's friends
     * @return array()
     */
    private function getFriendsId() {
        $Db = new Db();
        $friendsAll = $Db->getRows('SELECT * FROM Friend WHERE User1 IN (?) OR User2 IN (?)', array($this->id, $this->id));
        $friendsId = array();
        foreach ($friendsAll as $f) {
            if ($f['User1'] !== $this->id)
                $friendsId[] = intval($f['User1']);
            if ($f['User2'] !== $this->id)
                $friendsId[] = intval($f['User2']);
        }
        return $friendsId;
    }
    /**
     * Return a gender name
     * @param inr $GenderId
     * @return string
     */
    private function getGenderName( $GenderId) {
        $Db = new Db();
        $genderOne = $Db->getRow('SELECT * FROM UserGender WHERE Id = ?', array($GenderId));
        return $genderOne['Name'];
    }
    /**
     * Return a full data of user's friends
     * @return type
     */
    public function getFriends() {
        $Db = new Db();
        $friendsAll = $Db->getRows('SELECT * FROM User WHERE Id IN (' . implode(',', $this->friends) . ')');
        return $friendsAll;
    }
    /**
     * Return an array with IDs of user's friends but not connected with user
     * @return array()
     */
    private function getFriendsofFriendsId() {

        $friendsId = array();
        $Db = new Db();
        foreach ($this->friends as $f) {
//            echo $f;
            if ($f !== $this->id) {
                $UserF = $Db->getRows('SELECT * FROM Friend where (User1 IN (?) OR User2 IN (?) ) AND (User1 <> ? AND User2 <> ?)', array($f, $f, $this->id, $this->id));
                foreach ($UserF as $us) {
                    !in_array($us['User1'], $this->friends) ? $friendsId[] = $us['User1'] : "";
                    !in_array($us['User2'], $this->friends) ? $friendsId[] = $us['User2'] : "";
                }
            }
        }
        return $friendsId;
    }
    /**
     * Return a fully information of friends of user's friends but not connected with user
     * @return array()
     */
    public function getFriendsOfFriends() {
        $aFriends = $this->getFriendsofFriendsId();
        $friendsAll = array();
        if (count($aFriends) > 0) {
            $Db = new Db();
            $friendsAll = $Db->getRows('SELECT * FROM User WHERE Id IN (' . implode(',', $aFriends) . ')');
        }
        return $friendsAll;
    }
    /**
     * Return an array with IDs of suggested friends of user's friends but only when user and his friend have two or more the same friends
     * @return array
     */
    private function getSuggestedId() {
        $friendsId = array();
        $suggestedId = array();
        $Db = new Db();
        /**
         * Wybieramy
         */
        foreach ($this->friends as $f) {
            if ($f !== $this->id) {
                $UserF = $Db->getRows('SELECT * FROM Friend where (User1 IN (?) OR User2 IN (?) ) AND (User1 <> ? AND User2 <> ?)', array($f, $f, $this->id, $this->id));
                foreach ($UserF as $us) {
                    if ($us['User1'] != $f)
                        $friendsId[] = intval($us['User1']);
                    if ($us['User2'] != $f)
                        $friendsId[] = intval($us['User2']);
                }
                $cFriendsId = count($friendsId);
                $cFriendsIdDiff = array_diff($friendsId, $this->friends);

                $TheSame = $cFriendsId - count($cFriendsIdDiff);
                if ($TheSame > 1) {
                    foreach ($cFriendsIdDiff as $ss) {
                        !in_array($ss, $this->friends) ? $suggestedId[] = $ss : "";
                    }
                }
                $friendsId = array();
            }
        }
        return $suggestedId;
    }
    /**
     * Return a full information of suggested friends of user's friends but only when user and his friend have two or more the same friends
     * @return array()
     */
    public function getSuggested() {
        $aSuggested = $this->getSuggestedId();
        $friendsAll = array();
        if (count($aSuggested) > 0) {
            $Db = new Db();
            $friendsAll = $Db->getRows('SELECT * FROM User WHERE Id IN (' . implode(',', $aSuggested) . ')');
        }
        return $friendsAll;
    }

    public function __get($var) {
        throw new Exception("Invalid property $var");
    }

    public function __set($var, $value) {
        $this->__get($var);
    }

}
