<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Admins;
use App\Models\Users;
class AdminRepository extends BaseRepository
{
    public function __construct(Admins $admin)
    {
        parent::__construct($admin);
    }

    public function getAllUsers()
    {
        $users = Users::take(8)->get();
        return $users;
    }

}
?>