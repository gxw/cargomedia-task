<?php

/**
 *  Bootstrapt class for application start
 */
class Bootstrap extends Rest {

    function __construct() {

        $this->response($this->makeCall());
    }

    /**
     * Manage od all user request
     * 
     * @return json
     */
    private function makeCall() {

//        if (isset($_POST['apikey']) && $_POST['apikey'] === 'a2516653f0bd09f19810a39f35b9f0425f5a7f06c4582927bd2c6c33b663a2f6') {
            $cnt = new Controller();
            $router = new Router();
            $mn = strtolower($router->list[0]) . 'Action';
            if (method_exists($cnt, $mn)) {
                return Rest::response(call_user_method($mn, $cnt), 200);
            } else {
                echo Rest::response('method does not exist ' . $router->list[0], 405);
            }
//        } else {
//            echo Rest::response('Unauthorized', 401);
//        }
    }

}

?>
