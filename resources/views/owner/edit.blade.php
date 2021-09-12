@extends('layouts.app')
  @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Owner</div>
                        <div class="card-body">
                            <form method="POST" action={{route('owner.update',$owner )}}>
                                <div class="form-group">
                                    <label>Name: </label>
                                    <input type="text" class="form-control" name="owner_name" value="{{$owner->name}}">
                                    <small class="form-text text-muted">Enter new owner name.</small>
                                </div>
                                <div class="form-group">
                                    <label>Surname: </label>
                                    <input type="text" class="form-control" name="owner_surname" value="{{$owner->surname}}">
                                    <small class="form-text text-muted">Enter new owner surname.</small>
                                </div>
                                <div class="form-group">
                                    <label>Contacts: </label>
                                    <textarea class="form-control" name="owner_contacts" id="summernote">{{$owner->contacts}}</textarea>
                                    <small class="form-text text-muted">Enter owner contacts.</small>
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-warning">EDIT</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
