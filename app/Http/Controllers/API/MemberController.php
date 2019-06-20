<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Member;
use App\Team;
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tid)
    {
        $members = Team::find($tid)->members;
        return Response()->json($members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tid, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()){
            return Response()->json(['error' => $validator->errors()]);
        }
        $inputs = $request->all();
        $member = new Member;
        $member->first_name = $inputs['first_name'];
        $member->last_name = $inputs['last_name'];
        $member->email = $inputs['email'];
        $member->save();
        $member->teams()->attach($tid);
        return Response()->json(['success' => 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::findOrFail($id)->first();
        return Response()->json($User);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()){
            return Response()->json(['error' => $validator->errors()]);
        }
        $inputs = $request->all();
        $member = Member::findOrFail($id) ->first();
        $member->first_name = $inputs['first_name'];
        $member->last_name = $inputs['last_name'];
        $member->email = $inputs['email'];
        $member->save();
        return Response()->json(['success' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return Response()->json(["success" => 200]);
    }
}
