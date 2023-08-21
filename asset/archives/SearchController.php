<?php
class SearchController extends Controller
{
    public function searchResult()
    {
        echo self::getRender('searchresult.html.twig', []);
    }
}