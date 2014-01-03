<?php


/**
 * Controller for user's requests
 */
class Controller {

    /**
     * Return those people who are directly connected to the user.
     * @return array
     */
    public function getfriendsAction()
    {
        $User = $this->getUser();
        $data = $User->getFriends();
        return $data;
    }
    /**
     * Return those who are friends of user's friends but not a user's friends.
     * @return array
     */
    public function getfriendsoffriendAction()
    {
        $User = $this->getUser();
        $data = $User->getFriendsOfFriends();
        return $data;
    }
    /**
     * Return those who are friends of user's friends and user have two or more equal friends.
     * @return array
     */
    public function getsuggestedAction()
    {
        $User = $this->getUser();
        $data = $User->getSuggested();
        return $data;
    }
    /**
     * Return basically user's data
     * @return array
     */
    public function getuserAction()
    {
        $User = $this->getUser();
        $data = $User;
        return $data;
    }
    /**
     * Registering user ID in application
     * @return \User
     */
    private function getUser()
    {
        $UserId = -1;
        isset($_POST['UserId']) && intval($_POST['UserId']) > 0 ? $UserId = intval($_POST['UserId']) : $UserId = -1;
        $User = new User ($UserId);
        return $User;
    }
}

?>
