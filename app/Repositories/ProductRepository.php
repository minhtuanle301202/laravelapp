<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Products;


class ProductRepository extends BaseRepository
{
    public function __construct(Products $products)
    {
        parent::__construct($products);
    }

    public function getNewProductsByCategoryId($categoryId)
    {
        $newProducts = Products::where('category_id',$categoryId)
            ->orderBy('created_at','DESC')
            ->take(4)
            ->get();

        return $newProducts;
    }

    public function getProductsByCategoryId($categoryId)
    {
        $products = Products::where('category_id',$categoryId)
            ->paginate(4);

        return $products;
    }

    public function getProductsByCategoryIdandPagination($id)
    {
        $products = Products::where('category_id',$id)->paginate(4);

        return  $products;
    }

    public function getProductsByCategoryIdInCategoryPage($categoryId)
    {
        $products = Products::where('category_id',$categoryId)
            ->paginate(4);

        return $products;
    }
}
?>