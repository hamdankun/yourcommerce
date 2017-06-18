<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Illuminate\Http\Request;
use App\Models\Master\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRegisterRequest;

class MemberController extends Controller
{
    /**
     * The path view
     * @var string
     */
    const PATH_VIEW = 'frontend.member';

    /**
     * The prefix route
     * @var string
     */
    const PREFIX_ROUTE = 'member.';

    /**
     * Get All depedencies here
     */
    public function __construct()
    {
      $this->getTreeCategory();
    }

    /**
     * Register Member
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
      $this->defaultMeta();
      return view(static::PATH_VIEW.'.register');
    }

    /**
     * Save member register
     * @return \Illuminate\Http\Response
     */
    public function saveRegister(MemberRegisterRequest $request)
    {
      try {
        DB::beginTransaction();
        $member = Member::create(request()->all());
        event(new \App\Events\MemberCreated($member, request()->only('username', 'email', 'password')));
        $created = true;
        $message = 'Register has been successfully, Thanks you';
        $hashiId = encrypt($member->id);
        DB::commit();
      } catch (\Exception $e) {
        $this->writeErrors($e);
        $created = false;
        $message = 'Unable to register, please try again';
        $hashiId = 0;
        DB::rollBack();
      }
      session()->flash('member.created', $created);
      session()->flash('member.message', $message);
      return redirect()->route(static::PREFIX_ROUTE.'success-register', [$hashiId]);
    }

    /**
     * Success register member
     * @return \Illuminate\Http\Response
     */
    public function successRegister($hashId = null)
    {
      if (!$hashId) return redirect()->back();

      try {
        $id = decrypt($hashId);
      } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()->back();
      }

      $member = Member::find($id);
      return view(static::PATH_VIEW.'.success-register', ['member' => $member]);
    }
}
