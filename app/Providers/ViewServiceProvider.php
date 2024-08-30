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
        View::share('categories', Categories::all());

        View::composer('*', function ($view) {
            $statusCollection = collect([
                'Chờ xử lý',
                'Đang giao hàng',
                'Giao hàng thành công',
                'Đã hủy',
            ]);

            $view->with('statusCollection', $statusCollection);
        });
    }
}
?>