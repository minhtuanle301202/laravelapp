<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\ProductVariants;

class ProductVariantsRepository extends BaseRepository
{
    public function __construct(ProductVariants $productVariants)
    {
        parent::__construct($productVariants);
    }

    public function getPrice($productId, $color, $capacity)
    {
        $variants = ProductVariants::where('product_id', $productId)
            ->where('color', $color)
            ->where('capacity', $capacity)
            ->first();

        return $variants;
    }
}

?>