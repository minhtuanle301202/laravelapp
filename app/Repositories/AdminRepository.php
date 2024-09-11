<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Admins;
use App\Models\Users;
use App\Models\News;

class AdminRepository extends BaseRepository
{
    const NUMBER_USER_PER_PAGE = 12;

    public function __construct(Admins $admin)
    {
        parent::__construct($admin);
    }

    public function getAllUsers()
    {
        $users = Users::active()->paginate(self::NUMBER_USER_PER_PAGE);
        return $users;
    }


    public function createUser($validatedData)
    {
        $user = Users::create($validatedData);
        return $user;
    }

    public function getUserDetails($id)
    {
        $user = Users::find($id);
        return $user;
    }

    public function updateUserDetails($id, $data)
    {
        $user = Users::find($id);
        $user->update(['username' => $data->username,
            'phone' => $data->phone,
            ]);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = Users::find($id);

        if ($user) {
            $user->delete();
            return true;
        } else {
            return false;
        }
    }


}
?>