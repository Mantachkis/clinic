@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Owners list</div>
                    <div class="card-body">
                         <form action="{{route('owner.index')}}" method="get">
                                <fieldset>
                                    <legend>Search</legend>
                                    <div class="block">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Search" name="s" value="{{$s}}">
                                            <small class="form-text text-muted">Search for owner.</small>
                                        </div>
                                    </div>
                                    <div class="block">
                                        <button type="submit" class="btn btn-info" name="search" value="all">Search</button>
                                        <a href="{{route('owner.index')}}" class="btn btn-warning">Reset</a>
                                    </div>
                                </fieldset>
                            </form>
                      <ul class="list-group">
                         
                         @foreach ($owners as $owner)
                            <li class="list-group-item">
                                    <div class="list-block">
                                        <div class="list-block__content">
                                            <span><b>{{$owner->name}} {{$owner->surname}} </b> </span>
                                            <div>Phone number: {{$owner->contacts}} </div>
                                            @if($owner->getPets->count())
                                                <small>Has {{$owner->getPets->count()}} pets.</small>
                                            @else
                                            <small>Curently has no pets.</small> 
                                            @endif
                                        </div>
                                        <div class="list-block__buttons">
                                            <a href="{{route('owner.edit',[$owner])}}" class="btn btn-success">Edit</a>
                                            <form method="POST" action="{{route('owner.destroy', $owner)}}">
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
@section('title') Owner List @endsection



