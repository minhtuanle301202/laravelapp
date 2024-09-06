<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Products;


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
        $products = Products::where('category_id',$id)->paginate(self::NUMBER_PRODUCT_PER_PAGE);

        return  $products;
    }

    public function getProductsByCategoryIdInCategoryPage($categoryId)
    {
        $products = Products::where('category_id',$categoryId)
            ->with('variants')
            ->paginate(self::NUMBER_PRODUCT_PER_PAGE);

        return $products;
    }

    public function getAllProducts($perPage)
    {
        $products = Products::orderBy('id','desc')
            ->take($perPage)
            ->get();
        return $products;
    }

    public function findProducts($data)
    {
        $productName = $data->productName;
        $categoryId = $data->categoryId;
        $query = Products::query();

        if (!empty($productName)) {
            $query->whereRaw('? like CONCAT("%", name, "%")', [$productName]);
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        return $query;
    }

    public function getProductsByCategoryIdInPagination($perPage,$offset,$data)
    {
        $products = $this->findProducts($data)
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $products;
    }

    public function searchProduct($data,$perPage)
    {
        $products = $this->findProducts($data)
            ->orderBy('id','desc')
            ->take($perPage)
            ->get();

        return $products;
    }

}
?>