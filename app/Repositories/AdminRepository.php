<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Admins;
use App\Models\Users;
use App\Models\News;

class AdminRepository extends BaseRepository
{
    const NUMBER_USER_PER_PAGE = 4;

    public function __construct(Admins $admin)
    {
        parent::__construct($admin);
    }

    public function getAllUsers()
    {
        $users = Users::active()->take(self::NUMBER_USER_PER_PAGE)->get();
        return $users;
    }

    public function getNextUsers($page)
    {
        $perPage = self::NUMBER_USER_PER_PAGE;
        $offset = $page  * $perPage;

        $users = Users::active()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $users;
    }

    public function getPrevUsers($page)
    {
        $perPage = self::NUMBER_USER_PER_PAGE;
        $offset = ($page - 2)  * $perPage;

        $users = Users::active()
            ->offset($offset)
            ->limit($perPage)
            ->get();

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
            'email' => $data->email,
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