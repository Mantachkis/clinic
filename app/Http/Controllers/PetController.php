<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;
use Validator;
use PDF;

class PetController extends Controller
{
    const RESULT_PER_PAGE = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pets = Pet::orderBy('name')->paginate(self::RESULT_PER_PAGE)->withQueryString();
        $doctors = Doctor::all();
        if ($request->sort) {
            if ('birth_date' == $request->sort && 'asc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date')->paginate(self::RESULT_PER_PAGE)->withQueryString();;
            } else if ('birth_date' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('birth_date', 'desc')->paginate(self::RESULT_PER_PAGE)->withQueryString();;
            } else if ('species' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('species', 'desc')->paginate(self::RESULT_PER_PAGE)->withQueryString();;
            } else if ('species' == $request->sort && 'desc' == $request->sort_dir) {
                $pets = Pet::orderBy('species', 'desc')->paginate(self::RESULT_PER_PAGE)->withQueryString();;
            } else {
                $pets = Pet::all();
            }
        } else if ($request->filter && 'doctor' == $request->filter) {

            $pets = Pet::where('doctor_id', $request->doctor_id)->paginate(self::RESULT_PER_PAGE)->withQueryString();;
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
        return view('pet.show', ['pet' => $pet]);
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
    public function pdf(Pet $pet)
    {
        $pdf = PDF::loadView('pet.pdf', ['pet' => $pet]);
        return $pdf->download($pet->name . '.pdf');
    }
}