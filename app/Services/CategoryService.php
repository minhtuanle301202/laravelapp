<?php
namespace App\Services;
use App\Repositories\CategoryRepository;
class CategoryService {
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handleGetAllCategories()
    {
        $categories = $this->categoryRepository->all();

        return $categories;
    }
}

?>