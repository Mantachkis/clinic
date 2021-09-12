@extends('layouts.app')
  @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Doctor</div>
                    <div class="card-body">
                    <form method="POST" action="{{route('doctor.store')}}">
                        <div class="form-group">
                            <label>Name: </label>
                            <input type="text" class="form-control" name="doctor_name" value="{{old('doctor_name')}}">
                            <small class="form-text text-muted">Enter new doctor name.</small>
                        </div>
                        <div class="form-group">
                            <label>Surname: </label>
                            <input type="text" class="form-control" name="doctor_surname" value="{{old('doctor_surname')}}">
                            <small class="form-text text-muted">Enter new doctor surname.</small>
                        </div>
                         <div class="form-group">
                            <label>Category: </label>
                            <input type="text" class="form-control" name="doctor_category" value="{{old('doctor_category')}}">
                            <small class="form-text text-muted">Enter new doctor category.</small>
                        </div>
                         
                        @csrf
                        <button type="submit"class="btn btn-success btn-lg" >ADD</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection