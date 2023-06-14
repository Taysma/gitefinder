<?php

class HomeController extends Controller
{
    public function home(){

        echo self::getRender('homepage.html.twig',[]);
    }

    public function getOne($id){

        
        echo self::getRender('article.html.twig', []);
    }
}
