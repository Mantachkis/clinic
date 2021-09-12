@extends('layouts.app')
   @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New pet</div>
                    <div class="card-body">
                <form method="POST" action="{{route('pet.store')}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="pet_name" value="{{old('pet_name')}}">
                        <small class="form-text text-muted">Name of the pet.</small>
                    </div>
                     <div class="form-group">
                        <label>Species</label>
                        <input type="text" class="form-control" name="pet_species" value="{{old('pet_species')}}">
                        <small class="form-text text-muted">Sepcies of the pet.</small>
                    </div>
                    <div class="form-group">
                        <label>Birth date</label>
                        <input type="text" class="form-control" name="pet_birth_date" value="{{old('pet_birth_date')}}">
                        <small class="form-text text-muted">Pet Birth date.</small>
                    </div>
                    <div>
                      <label>Document</label>
                        <input type="text" class="form-control" name="pet_document" value="{{old('pet_document')}}">
                        <small class="form-text text-muted">Documnents of the pet.</small>
                    </div>
                    <div class="form-group">
                        <label>History</label>
                        <textarea class="form-control" name="pet_history" id="summernote">{{old('pet_history')}}</textarea>
                        <small class="form-text text-muted">About pet.</small>
                    </div>
                     <div class="form-group">
                        <label>owner</label>
                        <select class="form-control" name="owner_id">
                          @foreach ($owners as $owner)
                            <option value="{{$owner->id}}" @if(old('owner_id') == $owner->id) selected @endif>{{$owner->name}} {{$owner->surname}}</option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">Select owner from the list.</small>
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id">
                          @foreach ($doctors as $doctor)
                            <option value="{{$doctor->id}}" @if(old('doctor_id') == $doctor->id) selected @endif>{{$doctor->name}} {{$doctor->surname}}</option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">Select doctor from the list.</small>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">Create new</button>
                 </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endsection