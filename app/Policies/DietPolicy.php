<?php

namespace App\Policies;

use App\Models\Diet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DietPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user){}

    public function view(User $user, Diet $diet){}
    public function create(User $user){}

    public function update(User $user, Diet $diet){}

    public function delete(User $user, Diet $diet){}

    public function restore(User $user, Diet $diet){}

    public function forceDelete(User $user, Diet $diet){}
}
