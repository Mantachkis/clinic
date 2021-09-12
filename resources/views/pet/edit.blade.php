@extends('layouts.app')
   @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit pet</div>
                    <div class="card-body">
                <form method="POST" action="{{route('pet.update',$pet)}}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="pet_name" value="{{$pet->name}}">
                        <small class="form-text text-muted">Name of the pet.</small>
                    </div>
                     <div class="form-group">
                        <label>Species</label>
                        <input type="text" class="form-control" name="pet_species" value="{{$pet->species}}">
                        <small class="form-text text-muted">Sepcies of the pet.</small>
                    </div>
                    <div class="form-group">
                        <label>Birth date</label>
                        <input type="text" class="form-control" name="pet_birth_date" value="{{$pet->birth_date}}">
                        <small class="form-text text-muted">Pet Birth date.</small>
                    </div>
                    <div>
                      <label>Document</label>
                        <input type="text" class="form-control" name="pet_document" value="{{$pet->document}}">
                        <small class="form-text text-muted">Documnents of the pet.</small>
                    </div>
                    <div class="form-group">
                        <label>History</label>
                        <textarea class="form-control" name="pet_history"id="summernote">{{$pet->history}}</textarea>
                        <small class="form-text text-muted">About pet.</small>
                    </div>
                     <div class="form-group">
                        <label>owner</label>
                        <select class="form-control" name="owner_id">
                          @foreach ($owners as $owner)
                            <option value="{{$owner->id}}" selected >{{$owner->name}} {{$owner->surname}}</option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">Select owner from the list.</small>
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select class="form-control" name="doctor_id">
                          @foreach ($doctors as $doctor)
                            <option value="{{$doctor->id}}"  selected >{{$doctor->name}} {{$doctor->surname}}</option>
                          @endforeach
                        </select>
                        <small class="form-text text-muted">Select doctor from the list.</small>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">Edit</button>
                 </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endsection