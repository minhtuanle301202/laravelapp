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

    public function getAllProducts($perPage)
    {
        $products = $this->productRepository->getAllProducts($perPage);

        return $products;
    }


    public function getPrevProductsByCategoryId($page,$perPage,$data)
    {
        $offset = ($page - 2) * $perPage;
        $products = $this->productRepository->getProductsByCategoryIdInPagination($perPage,$offset,$data);

        return $products;
    }

    public function getNextProductsByCategoryId($page,$perPage,$data)
    {
        $offset = $page * $perPage;
        $products = $this->productRepository->getProductsByCategoryIdInPagination($perPage,$offset,$data);

        return $products;
    }

    public function searchProduct($data,$perPage)
    {
        return $this->productRepository->searchProduct($data,$perPage);

    }

    public function updateProductDetails($id,$data)
    {
        $product = $this->productRepository->update($id,$data);

        return $product;
    }

    public function deleteProduct($id)
    {
        $state = $this->productRepository->delete($id);

        return $state;
    }

    public function createProduct($data)
    {
        $product = $this->productRepository->create($data);

        return $product;
    }

}
?>