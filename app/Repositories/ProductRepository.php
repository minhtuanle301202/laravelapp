<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Products;
use App\Models\Categories;


class ProductRepository extends BaseRepository
{
    const NUMBER_PRODUCT_PER_PAGE = 4;
    public function __construct(Products $products)
    {
        parent::__construct($products);
    }

    public function getNewProductsByCategoryId($categoryId)
    {
        $newProducts = Products::where('category_id',$categoryId)
            ->orderBy('created_at','DESC')
            ->take(self::NUMBER_PRODUCT_PER_PAGE)
            ->with('variants')
            ->get();


        return $newProducts;
    }

    public function getProductsByCategoryId($categoryId)
    {
        $products = Products::where('category_id',$categoryId)
            ->paginate(self::NUMBER_PRODUCT_PER_PAGE);

        return $products;
    }

    public function getProductsByCategoryIdandPagination($id)
    {
        $products = Products::where('category_id',$id)
            ->paginate(self::NUMBER_PRODUCT_PER_PAGE);

        return  $products;
    }

    public function getProductsByCategoryIdInCategoryPage($categoryId)
    {
        $products = Products::where('category_id',$categoryId)
            ->with('variants')
            ->paginate(self::NUMBER_PRODUCT_PER_PAGE);

        return $products;
    }

}
?>