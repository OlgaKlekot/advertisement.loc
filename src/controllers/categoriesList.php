<?php
namespace app\src\controllers\categoriesList;
use function app\core\renderView;
use app\src\models\Category;


function categoriesList()
{
    $categories = Category::select('*')->groupBy('id')->orderBy('category')->get()->toArray();
    return renderView(['posts/categories.php'], ['categories' => $categories]);
}
//function categoriesSelect() {
//    $categories = Category::select('*')->groupBy('id')->orderBy('category')->get()->toArray();
//    return $categories;
//}