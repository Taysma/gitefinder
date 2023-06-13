<?php
abstract class Controller{
    private static $loader;
    private static $twig;
    private static $render;

    private static function getLoader(){
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig(){
        if (self::$twig === null) {
            $loader = self::getLoader();
            self::$twig = new \Twig\Environment($loader);
            self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('get', $_GET);
    
            // Add the path function to Twig environment
            self::$twig->addFunction(new \Twig\TwigFunction('path', function ($routeName) {
                global $router;
                return $router->generate($routeName);
            }));
    
            // Add the asset function to Twig environment
            self::$twig->addFunction(new \Twig\TwigFunction('asset', function ($assetPath) {
                // Modify this logic according to your asset setup
                $basePath = '/projets/gitefinder/asset'; // Update with your base asset path
                return $basePath . $assetPath;
            }));
        }
        return self::$twig;
    }
    
    protected static function setRender(string $template, $datas){

        global $router;

        //LINKS
        $link = $router->generate('home');
        $link2 = $router->generate('register');
        $link3 = $router->generate('login');
        $link4 = $router->generate('baseCats');        

        // LINKS TABLE + NEW ONES
        $new = [
            //'categorieslink' => $link,
            'link' => $link,
            'link2' => $link2,
            'link3' => $link3,
            'link4' => $link4
        ] + $datas;
        
        echo self::getTwig()->render($template, $new);
    }

    protected static function getRender($template, $datas){
        if (self::$render === null) {
            self::setRender($template, $datas);
        }
        return self::$render;
    }
}
