<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\ProductVariants;
use App\Models\Products;

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

    public function getVariantsByProductId($id,$perPage)
    {
        $variants = ProductVariants::where('product_id', $id)
            ->orderBy('id','desc')
            ->take($perPage)
            ->get();

        return $variants;
    }

    public function getProductById($id)
    {
        $product = Products::find($id);

        return $product;
    }

    public function getVariantsByProductIdInPagination($id,$offset,$perPage)
    {
        $variants = ProductVariants::where('product_id',$id)
                    ->orderBy('id','desc')
                    ->offset($offset)
                    ->limit($perPage)
                    ->get();

        return $variants;
    }
}

?>