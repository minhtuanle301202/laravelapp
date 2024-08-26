<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Categories;

class CategoryRepository extends BaseRepository
{
    public function __construct(Categories $category)
    {
        parent::__construct($category);
    }

}
?>