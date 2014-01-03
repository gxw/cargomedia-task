<?php
/**
 * New instance of Client class
 */
$c = new Client();
/**
 * Register user with ID = 1
 */
$c->registerUser(1);
/**
 * Dump  user's data
 */
var_dump($c->req('getUser'));
echo '<hr>';
/**
 * Dump  user's friends
 */
var_dump($c->req('getFriends'));
echo '<hr>';
/**
 * Dump  friends of friends (user ID = 1)
 */
var_dump($c->req('getFriendsOfFriend'));
echo '<hr>';
/**
 * Dump  suggested friendfs for user with ID = 1
 */
var_dump($c->req('getSuggested'));


class Client {
    /**
     * API URL
     */
    const API_URL = 'http://cargomedia.mutantlab.pl/';
    /**
     * API KEY
     */
    const API_AUTHKEY = 'a2516653f0bd09f19810a39f35b9f0425f5a7f06c4582927bd2c6c33b663a2f6';
    /**
     *  parameters to send
     * @var array
     */
    private $params = array(
        'domain' => Client::API_URL,
        'apikey' => Client::API_AUTHKEY
    );

    /**
     * Registered user ID in parameters
     * @param int $userId
     * @return
     */
    public function registerUser($userId) {
        $this->params ['UserId'] = (int) $userId;
        return;
    }

    /**
     * Sending request to api 
     *
     * @param      string $method		Name of the api's method
     * @param      string $arguments		Optional argument lists
     *
     * @return     array()
     */
    public function req($method, $arguments = array()) {

        $params = $this->params;
        $params['params'] = $arguments;
        $params = http_build_query($params);
        $sess = curl_init(self::API_URL . $method);
        curl_setopt($sess, CURLOPT_POST, 1);
        curl_setopt($sess, CURLOPT_POSTFIELDS, $params);
       /**
        * Response from server
        */
        $response = curl_exec($sess);
        curl_close($sess);
        return $response;
    }

}
