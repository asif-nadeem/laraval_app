@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row mb-2">
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <a class="btn btn-primary" style="float: right" href="{{ route('categories.index') }}">Listing</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{ __($title) }}
                    </div>
                    <div class="card-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('categories.update',[$res->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input required type="text" class="form-control" id="name" placeholder="Enter Name"
                                           name="name" value="{{ old('name',$res->name) }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="user_name">Description:</label>
                                    <textarea required class="form-control" name="description">{{ old('description',$res->description) }}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 pull-right">
                                <button type="submit" name="sub_me" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
