@extends('layouts.app')
   @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$pet->species}} {{$pet->name}}</div>
                    <div class="card-body">
                        <div class="pet-container">
                            <div class="pet-container__spec">
                                <b>Date of birth: </b>{{$pet->birth_date}}
                            </div>
                            <div class="pet-container__spec">
                               <b> Ownwer: </b>{{$pet->getOwner->name}} {{$pet->getOwner->surname}}
                               <b>Phone number:</b> {{$pet->getOwner->contacts}}
                            </div>
                            <div class="pet-container__spec">
                               <b> Doctor: </b>{{$pet->getDoctor->name}} {{$pet->getDoctor->surname}}
                            </div>
                            <div class="pet-container__about">
                                <b>About:</b> {!!$pet->history!!}
                            </div>
                            <a href="{{route('pet.pdf',[$pet])}}"class="btn btn-info">PDF</a> 
                         </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
    @endsection