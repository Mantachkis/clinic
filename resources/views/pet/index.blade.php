



@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pets list</div>
                      <div class="card-body">
                        <form action="{{route('pet.index')}}" method="get">
                            <fieldset class="field">
                                <legend>Sort</legend>
                                 <div class="block">
                                     <button type="submit" class="btn btn-info" name="sort" value="birth_date">Birth date</button>
                                       <button type="submit" class="btn btn-info" name="sort" value="species">Species</button>
                                 </div>
                                <div class="block">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" 
                                            name="sort_dir" id="_1" 
                                            value="asc" @if('desc' != $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_1">
                                        ASC
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                             name="sort_dir" id="_2"
                                             value="desc" @if('desc'== $sortDirection) checked @endif>
                                        <label class="form-check-label" for="_2">
                                         DESC
                                        </label>
                                    </div>
                                </div>
                                <div class="block">
                                    <a href="{{route('pet.index')}}" class="btn btn-danger">Reset</a>
                                </div>
                            </fieldset>
                        </form>
                         <form action="{{route('pet.index')}}" method="get">
                                <fieldset>
                                    <legend>Filter</legend>
                                    <div class="block">
                                        <div class="form-group">
                                            <select class="form-control" name="doctor_id">
                                            <option value="0" disabled selected>Select Doctor</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{$doctor->id}}" @if($doctor_id == $doctor->id) selected @endif>{{$doctor->name}} {{$doctor->surname}}</option>
                                            @endforeach
                                            </select>
                                            <small class="form-text text-muted">Select doctor from the list.</small>
                                        </div>
                                    </div>
                                        <div class="block">
                                        <button type="submit" class="btn btn-info" name="filter" value="doctor">Filter</button>
                                        <a href="{{route('pet.index')}}" class="btn btn-warning">Reset</a>
                                    </div>
                                </fieldset>
                        </form>


                    
                  
                      <ul class="list-group">
                         @foreach ($pets as $pet)
                            <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <div>Name : {{$pet->name}}</div>
                                             <div>Birth date : {{$pet->birth_date}}</div>
                                              <div>Specie :  {{$pet->species}}</div>
                                           <div> Owner :  {{$pet->getOwner->name}}  {{$pet->getOwner->surname}}</div>
                                            <div>Doctor :  {{$pet->getDoctor->name}}  {{$pet->getDoctor->surname}}</div>
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('pet.edit',[$pet])}}" class="btn btn-success">Edit</a>
                                            <form method="POST" action="{{route('pet.destroy', $pet)}}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
               
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('title') Pet List @endsection




