<?php
namespace App\Services;
use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handleGetNewProductsByCategoryId($categoryId)
    {
        $newProducts = $this->productRepository->getNewProductsByCategoryId($categoryId);
        return $newProducts;
    }

    public function handleGetProductsByCategoryId($categoryId)
    {
        $products = $this->productRepository->getProductsByCategoryId($categoryId);
        return $products;
    }

    public function getProductsByCategoryId($id)
    {
        $products = $this->productRepository->getProductsByCategoryIdandPagination($id);
        return $products;
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->find($id);

        return $product;
    }

    public function getProductsByCategoryIdInCategoryPage($categoryId)
    {
        $product = $this->productRepository->getProductsByCategoryIdInCategoryPage($categoryId);

        return $product;
    }

}
?>