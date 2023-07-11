<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {

//        if (request()->has('role') && !$user->hasRole($role)) {
//            $role = Role::findById(request()->role);
//            $user->assignRole(request()->role);
//            if ($role->name == 'teacher') {
//                $user->Teacher()->create();
//            } elseif ($role->name == 'student') {
//                $user->Student()->create();
//            }
//        }
        if (request()->has('role')) {
            $role = Role::findById(request()->role);
            if (!$user->hasRole($role)) {
                $user->assignRole(request()->role);
                if ($role->name == 'teacher') {
                    $user->Teacher()->create();
                } elseif ($role->name == 'student') {
                    $user->Student()->create();
                }
            }

        } else {
            $user->assignRole('student');
            $user->Student()->create();

        }
        //now in this code  it checks if the user has the role or not in another if statement instead of in the same one because it was
        //causing problems in the register form
        //if there is no role in request which is only possible in the registration form when the user is not logged in  then it automatically assigns
        //student role to the user and creates the Student which is related to the user.

    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
