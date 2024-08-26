<?php
namespace App\Repositories;
use App\Repositories\BaseRepository;
use App\Models\Users;

class UserRepository extends BaseRepository {
    public function __construct(Users $users) {
        parent::__construct($users);
    }
}
?>