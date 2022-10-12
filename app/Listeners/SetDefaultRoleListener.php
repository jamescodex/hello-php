<?php

namespace App\Listeners;

use App\Role;
use App\Events\UserCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetDefaultRoleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreatedEvent  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $role = Role::where('name', 'staff')->firstOrFail();

        $event->user->roles()->attach($role->id);
    }
}
