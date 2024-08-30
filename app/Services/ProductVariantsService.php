<?php
namespace App\Services;
use App\Repositories\ProductVariantsRepository;

class ProductVariantsService
{
    protected ProductVariantsRepository $productVariantsRepository;

    public function __construct(ProductVariantsRepository $productVariantsRepository)
    {
        $this->productVariantsRepository = $productVariantsRepository;
    }

    public function getPrice($productId, $color, $capacity)
    {
        $variants = $this->productVariantsRepository->getPrice($productId, $color, $capacity);

        return $variants;
    }

    public function getVariantsByProductId($id,$perPage)
    {
        $variants = $this->productVariantsRepository->getVariantsByProductId($id,$perPage);

        return $variants;
    }

    public function getProductById($id)
    {
        $product = $this->productVariantsRepository->getProductById($id);

        return $product;
    }

    public function getPrevVariants($id,$page,$perPage)
    {
        $offset = ($page-2) * $perPage;
        $variants = $this->productVariantsRepository->getVariantsByProductIdInPagination($id,$offset,$perPage);

        return $variants;
    }

    public function getNextVariants($id,$page,$perPage)
    {
        $offset = $page * $perPage;
        $variants = $this->productVariantsRepository->getVariantsByProductIdInPagination($id,$offset,$perPage);

        return $variants;
    }

    public function createVariant($data)
    {
        $variant = $this->productVariantsRepository->create($data);

        return $variant;
    }

    public function getVariantDetails($variantId)
    {
        $variant = $this->productVariantsRepository->find($variantId);

        return $variant;
    }

    public function updateVariantDetails($variantId, $data)
    {
         return $this->productVariantsRepository->updateVariantDetails($variantId, $data);
    }

    public function deleteVariant($variantId)
    {
         return $this->productVariantsRepository->delete($variantId);
    }
}
