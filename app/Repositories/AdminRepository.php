<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Admins;
use App\Models\Users;
use App\Models\News;
class AdminRepository extends BaseRepository
{
    public function __construct(Admins $admin)
    {
        parent::__construct($admin);
    }

    public function getAllUsers()
    {
        $users = Users::take(4)->get();
        return $users;
    }

    public function getNextUsers($page)
    {
        $perPage = 4;
        $offset = $page  * $perPage;

        $users = Users::orderBy('id','asc')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        return $users;
    }

    public function getPrevUsers($page)
    {
        $perPage = 4;
        $offset = ($page - 2)  * $perPage;

        $users = Users::orderBy('id','asc')
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

    public function updateUserDetails($id, $request)
    {
        $user = Users::find($id);
        $user->update(['username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
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

    public function getAllNews()
    {
        $news = News::take(4)->get();
        return $news;
    }
}
?>