<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Validator;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search && 'all' == $request->search) {
            //Paieska
            $doctors = Doctor::where('name', 'like', '%' . $request->s . '%')->orWhere('surname', 'like', '%' . $request->s . '%')->get();
        } else {
            $doctors = Doctor::all();
        }
        return view('doctor.index', ['doctors' => $doctors, 's' => $request->s ?? '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');
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
                'doctor_name' => ['required', 'min:3', 'max:64'],
                'doctor_surname' => ['required', 'min:3', 'max:64'],
                'doctor_category' => ['required', 'min:3', 'max:64']
            ]

        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $doctor = new Doctor;
        $doctor->name = $request->doctor_name;
        $doctor->surname = $request->doctor_surname;
        $doctor->category = $request->doctor_category;
        $doctor->save();
        return redirect()->route('doctor.index')->with('success_message', 'Operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctor.edit', ['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'doctor_name' => ['required', 'min:3', 'max:64'],
                'doctor_surname' => ['required', 'min:3', 'max:64'],
                'doctor_category' => ['required', 'min:3', 'max:64']
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $doctor->name = $request->doctor_name;
        $doctor->surname = $request->doctor_surname;
        $doctor->category = $request->doctor_category;
        $doctor->save();
        return redirect()->route('doctor.index')->with('success_message', 'Operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {

        if ($doctor->getPets->count()) {
            return redirect()->route('doctor.index')->with('info_message', 'Not possible to delete.Doctor has pets.');
        }

        $doctor->delete();
        return redirect()->route('doctor.index')->with('success_message', 'Operation successful');
    }
}