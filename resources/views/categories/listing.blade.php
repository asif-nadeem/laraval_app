@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <form action="">
                                {{--                                @csrf--}}
                                <div class="mb-3">
                                    <div class="form-group">
                                        {{--                            <label for="cat_name">Cat Name:</label>--}}
                                        <input type="text" class="form-control" id="cat_name" placeholder="Enter Name"
                                               name="cat_name" value="{{@$cat_name}}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="desc" placeholder="Enter Desc"
                                               name="desc" value="{{@$desc}}">
                                    </div>
                                </div>
                                <div class="mb-3 pull-right">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary" style="float: right" href="{{ route('categories.create') }}">Add
                            Category</a>
                    </div>
                </div>
                <div class="card">

                    <div class="card-header">
                        {{ __($title) }}
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <p>{{ session('success') }}</p>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <p>{{ session('error') }}</p>
                            </div>
                        @endif
                        <table id="ex" class="table table-striped table-bordered">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>image</th>
                                <th>Desc</th>
                                <th>Posts</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($categories))
                                @foreach($categories as $cat)
                                    <tr>
                                        <td>{{ $cat->id }}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td><img width="100" src="{{ asset('storage/'.$cat->image) }}"></td>
                                        <td>{{ $cat->description }}</td>
                                        <td>{{ $cat->posts->count() }}</td>
{{--                                        <td>--}}
{{--                                            <table>--}}
{{--                                                <tr>--}}
{{--                                                    <th>post name</th>--}}
{{--                                                </tr>--}}
{{--                                                @if($cat->posts->isNotEmpty())--}}

{{--                                                    @foreach($cat->posts as $post)--}}
{{--                                                        <tr>--}}
{{--                                                            <td>{{$post->name}}</td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endforeach--}}

{{--                                                @else--}}
{{--                                                    <tr>--}}
{{--                                                        <td>no post found!</td>--}}
{{--                                                    </tr>--}}
{{--                                                @endif--}}
{{--                                            </table>--}}
{{--                                        </td>--}}

                                        <td>
                                            <form action="{{ route('categories.destroy',[$cat->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-primary"
                                                   href="{{ route('categories.edit',[$cat->id]) }}">Edit</a>
                                                <a class="btn btn-info"
                                                   href="{{ route('categories.show',[$cat->id]) }}">Details</a>

                                                <button onclick="return confirm_del();" class="btn btn-danger"
                                                        type="submit">Delete
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No Data Found!</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                        @if(!empty($categories))
                            {!! $categories->links('pagination::bootstrap-4') !!}
                            {{--                            {!! $categories->links() !!}--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
