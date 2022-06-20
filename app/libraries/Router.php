<!--  URL = www.application.com/controller/method/param1/param2/param3/...  -->

<!--  The Web Browser  -->

<!--  The Web Server  -->

<!--
  The Application :

        * The Router
        * The Controller
        * The Model
        * The View

-->

<!--  The Database  -->

<!-- 
  The Router class is responsible for routing the request to the correct controller and method.
  It also handles the passing of parameters to the method.
-->

<?php

class Router
{
  protected $currentController = 'Home';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parse_url();

    // Check if the controller exists

    if ($url != NULL) {
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      } else {
        echo "Controller does not exist";
      }
    }

    // Require the controller

    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate the controller class

    $this->currentController = new $this->currentController;

    // Check if the method exists

    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {

        $this->currentMethod = $url[1];
        unset($url[1]);
      } else {
        echo "Method does not exist";
      }
    }

    // Get the params

    $this->params = $url ? array_values($url) : [];

    // Call the controller method and Passing the params to it.

    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function parse_url()
  {
    if (isset($_GET["url"])) {
      $url = $_GET['url'];
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }
}
