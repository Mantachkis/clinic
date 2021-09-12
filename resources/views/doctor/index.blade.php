@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Doctors list</div>
                    <div class="card-body">
                         <form action="{{route('doctor.index')}}" method="get">
                                <fieldset>
                                    <legend>Search</legend>
                                    <div class="block">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Search" name="s" value="{{$s}}">
                                            <small class="form-text text-muted">Search for doctor.</small>
                                        </div>
                                    </div>
                                    <div class="block">
                                        <button type="submit" class="btn btn-info" name="search" value="all">Search</button>
                                        <a href="{{route('doctor.index')}}" class="btn btn-warning">Reset</a>
                                    </div>
                                </fieldset>
                            </form>
                      <ul class="list-group">
                         @foreach ($doctors as $doctor)
                            <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <span>{{$doctor->name}} {{$doctor->surname}}</span>
                                            @if($doctor->getPets->count())
                                                <small>Works on {{$doctor->getPets->count()}} patients.</small>
                                            @else
                                            <small>Curently has no patients</small> 
                                            @endif
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('doctor.edit',[$doctor])}}" class="btn btn-success">Edit</a>
                                            <form method="POST" action="{{route('doctor.destroy', $doctor)}}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                          <div class="mt-3">{{$doctors->links()}}</div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('title') Doctor List @endsection











