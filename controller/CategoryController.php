<?php

class CategoryController extends Controller
{

    public function getOne($id_category)
    {

        $model = new CategoryModel();
        $category = $model->getOneCategory($id_category);
        $rentals = $model->getRentalsByCategory($id_category);

        echo self::getRender('category.html.twig', ['category' => $category, 'rentals' => $rentals]);
    }
}
