<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MemberResource;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user', 'service')->orderByDesc('created_at')->get();

        return $this->responseJson(MemberResource::collection($members));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'service_id' => 'required',
            'expired_at' => 'required',
        ]);

        Member::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'expired_at' => Carbon::parse($request->expired_at)
        ]);

        return $this->responseJson([
            'message' => 'Successfully create member'
        ]);
    }

    public function show(Member $member)
    {
        return $this->responseJson(new MemberResource($member));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'user_id' => 'required',
            'service_id' => 'required',
            'expired_at' => 'required',
        ]);

        $member->update([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'expired_at' => $request->expired_at
        ]);

        return $this->responseJson([
            'message' => 'Successfully update member'
        ]);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return $this->responseJson([
            'message' => 'Successfully delete member'
        ]);
    }
}
