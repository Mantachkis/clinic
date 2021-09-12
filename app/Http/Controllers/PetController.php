<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;
use Validator;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pets = Pet::orderBy('name')->get();
        $doctors = Doctor::all();
        if ($request->sort) {
            if ('birth_date' == $request->sort && 'asc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date')->get();
            } else if ('birth_date' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date', 'desc')->get();
            } else if ('species' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('species', 'desc')->get();
            } else if ('species' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('species', 'desc')->get();
            } else {
                $pets = Pet::all();
            }
        } else if ($request->filter && 'doctor' == $request->filter) {

            $pets = Pet::where('doctor_id', $request->doctor_id)->get();
        }

        return view('pet.index', [
            'pets' => $pets,
            'sortDirection' => $request->sort_dir ?? 'asc',
            'doctors' => $doctors,
            'doctor_id' => $request->doctor_id ?? '0'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = Owner::all();
        $doctors = Doctor::all();
        return view('pet.create', ['owners' => $owners, 'doctors' => $doctors]);
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
                'pet_name' => ['required', 'min:3', 'max:64'],
                'pet_species' => ['required', 'min:3', 'max:64'],
                'pet_birth_date' => ['required', 'min:3', 'max:64'],
                'pet_document' => ['required', 'min:3', 'max:64'],
                'pet_history' => ['required']
            ]

        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $pet = new Pet;
        $pet->name = $request->pet_name;
        $pet->species = $request->pet_species;
        $pet->birth_date = $request->pet_birth_date;
        $pet->document = $request->pet_document;
        $pet->history  = $request->pet_history;
        $pet->owner_id = $request->owner_id;
        $pet->doctor_id = $request->doctor_id;
        $pet->save();
        return redirect()->route('pet.index')->with('success_message', 'Operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        $owners = Owner::all();
        $doctors = Doctor::all();
        return view('pet.edit', ['pet' => $pet, 'owners' => $owners, 'doctors' => $doctors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pet_name' => ['required', 'min:3', 'max:64'],
                'pet_species' => ['required', 'min:3', 'max:64'],
                'pet_birth_date' => ['required', 'min:3', 'max:64'],
                'pet_document' => ['required', 'min:3', 'max:64'],
                'pet_history' => ['required']
            ]

        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $pet->name = $request->pet_name;
        $pet->species = $request->pet_species;
        $pet->birth_date = $request->pet_birth_date;
        $pet->document = $request->pet_document;
        $pet->history  = $request->pet_history;
        $pet->owner_id = $request->owner_id;
        $pet->doctor_id = $request->doctor_id;
        $pet->save();
        return redirect()->route('pet.index')->with('success_message', 'Operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pet.index')->with('success_message', 'Operation successful');
    }
}