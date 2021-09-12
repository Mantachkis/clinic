<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Validator;

class OwnerController extends Controller
{
    const RESULT_PER_PAGE = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $owners = Owner::orderBy('surname')->paginate(self::RESULT_PER_PAGE)->withQueryString();
        if ($request->search && 'all' == $request->search) {
            //Paieska
            $owners = Owner::where('name', 'like', '%' . $request->s . '%')->orWhere('surname', 'like', '%' . $request->s . '%')->paginate(self::RESULT_PER_PAGE)->withQueryString();
        } else {
            $owners = Owner::paginate(self::RESULT_PER_PAGE)->withQueryString();;
        }
        return view('owner.index', ['owners' => $owners, 's' => $request->s ?? '']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('owner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'owner_name' => ['required', 'min:3', 'max:64'],
                'owner_surname' => ['required', 'min:3', 'max:64'],
                'owner_category' => ['required', 'min:3', 'max:64']
            ]

        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $owner = new Owner;
        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->contacts = $request->owner_contacts;
        $owner->save();
        return redirect()->route('owner.index')->with('success_message', 'Operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        return view('owner.edit', ['owner' => $owner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'owner_name' => ['required', 'min:3', 'max:64'],
                'owner_surname' => ['required', 'min:3', 'max:64'],
                'owner_contacts' => ['required', 'min:3', 'max:64']
            ]

        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $owner->name = $request->owner_name;
        $owner->surname = $request->owner_surname;
        $owner->contacts = $request->owner_contacts;
        $owner->save();
        return redirect()->route('owner.index')->with('success_message', 'Operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {

        if ($owner->getPets->count()) {
            return redirect()->route('owner.index')->with('info_message', 'Not possible to delete.Owner has pets.');
        }
        $owner->delete();
        return redirect()->route('owner.index')->with('success_message', 'Operation successful');
    }
}