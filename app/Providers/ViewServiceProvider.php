<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Categories;
use App\Models\Carts;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Chia sẻ dữ liệu với tất cả các view
        View::share('categories', Categories::all());;
    }
}
?>