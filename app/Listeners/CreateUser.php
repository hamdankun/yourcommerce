<?php

namespace App\Listeners;

use App\Events\MemberCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUser
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
     * @param  MemberCreated  $event
     * @return void
     */
    public function handle(MemberCreated $event)
    {
      $credentials = $event->credentials;
      $member = $event->member;
      $user['related_id'] = $member->id;
      $user['related_type'] = get_class($member);
      $user['username'] = $credentials['username'];
      $user['email'] = $credentials['email'];
      $user['password'] = bcrypt($credentials['password']);
      \App\Models\Master\User::create($user);
    }
}
