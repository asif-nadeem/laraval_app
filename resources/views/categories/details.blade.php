@extends('layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row mb-2">
                    <div class="col-md-6">&nbsp;</div>
                    <div class="col-md-6">
                        <a class="btn btn-primary" style="float: right" href="{{ route('categories.index') }}">Back</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{ __($title) }}
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $result->id }}</td>
                                <th>Name</th>
                                <td>{{ $result->name }}</td>
                                <th>Desc</th>
                                <td>{{ $result->description }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card">
                <div class="card-header">
                    {{ __('Category Posts') }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Desc</th>
                        </tr>
                        @if($result->posts->isNotEmpty())

                            @foreach($result->posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td><img width="100" src="{{ asset('storage/'.$post->image) }}"></td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->description }}</td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td>no post found!</td>
                            </tr>
                        @endif

                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
