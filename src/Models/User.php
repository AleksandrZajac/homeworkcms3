<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Config;

class User extends Model
{
    protected $table = 'users';

    protected $guarded = [];

    public function authorized($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['login'] = $email;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role_id'] = $user->role_id;
            setcookie('login', $email, time() + 60 * 60 * 24 * 30, '/');
            setcookie('user_id', $email, time() + 60 * 60 * 24 * 30, '/');

            return true;
        }

        return false;
    }

    public static function pagination($itemsOnPage)
    {
        $count = User::all()->count();

        if (isset($_GET['page'])) {
            $skip = ($_GET['page'] - 1) * $itemsOnPage;
        } else {
            $skip = 0;
        }

        if ($itemsOnPage > 0) {
            $pages = ceil($count / $itemsOnPage);
            $users = User::select(
                'users.id',
                'users.email',
                'users.name',
                'users.created_at',
                'roles.name as role_name'
            )
                ->join('roles', 'role_id', '=', 'roles.id')
                ->skip($skip)
                ->take($itemsOnPage)
                ->get();
        } else {
            $pages = 0;
            $users = User::select(
                'users.id',
                'users.email',
                'users.name',
                'users.created_at',
                'roles.name as role_name'
            )
                ->join('roles', 'role_id', '=', 'roles.id')
                ->get();
        }

        $pagintion['pages'] = $pages;
        $pagintion['users'] = $users;

        return $pagintion;
    }
}
