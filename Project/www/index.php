
<?php

  spl_autoload_register(function ($className){
    require_once(dirname(__DIR__).'/'.str_replace('\\', '/', $className).'.php');
    
  });

  $isRouteFound = false;
  $url = $_GET['route'] ?? '';
  $routes = require('../src/routes.php');
 

  foreach($routes as $pattern=>$controllerAndAction){
    preg_match($pattern, $url, $matches);
    if(!empty($matches)){
      $isRouteFound=true;
    
        break;
    }

  }
  
  unset($matches[0]);
  $action = $controllerAndAction[1];
  $controllerName = $controllerAndAction[0];

  if($isRouteFound){
    $controller = new $controllerName;
    $controller->$action(...$matches);
  }
  else echo "Страница не найдена";

  

 // $pattern = $routes[1];
 // var_dump($matches);
  /*$controller = new src\Controllers\MainController;
  $pattern = '~^$~';
  preg_match($pattern, $url, $matches);
 if(!empty($matches)){
    $controller->main();
    return;   
  }
*/


  


 // $controller->main();

  
   //require('../src/models/Users/Users.php');
   //require('../src/models/Articles/Articles.php');

    //$user = new src\models\Users\Users("Ivan");
    //$article = new src\models\Articles\Articles("title", "text", $user);
    //echo $article->getAuthor()->getName();
  //  var_dump($article);






?>