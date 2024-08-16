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
}
