<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class UserPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user){}
    public function view(User $user, User $model){}
    public function create(User $user){}

    public function add_Personal_Information(User $user, User $user_model)
    {
        return $user->id === $user_model->id
                ? Response::allow()
                : Response::deny('You do not own this user.');
    }

    public function delete(User $user, User $model){}
    public function restore(User $user, User $model){}
    public function forceDelete(User $user, User $model){}
}
