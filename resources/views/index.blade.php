@extends('layouts.app')

@section('content')
<div class="container">

    @if(auth()->user()->is_admin)
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if(count($proposals) > 0)
                    @foreach ($proposals as $proposal)
                        <div class="card mb-2">
                            <div class="card-header">
                                <h5 class="card-title">Created by {{$proposal->user->name}} at {{$proposal->created_at}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Email {{$proposal->user->email}}</h6>

                                @if($errors->has('title'))
                                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('title')}}</small>
                                @endif

                                @if(!$proposal->readed)
                                    <form action="{{ route('proposals.update', [$proposal->id]) }}" method="post">
                                        {{ method_field('PUT') }}
                                        {{ csrf_field() }}
                                        <div class="form-group form-check">
                                            <input type="checkbox" name="readed" class="form-check-input" id="checkbox" value="1">
                                            <label class="form-check-label" for="checkbox">Check me out</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$proposal->title}}</h5>
                                <p class="card-text">{{$proposal->message}}</p>
                                @if(!empty($proposal->attached_file))
                                    <a href="{{route('proposals.download', $proposal->id)}}" class="card-link">Link</a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{ $proposals->links() }}
                @endif
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session()->has('message') && session()->has('status'))
                    <div class="alert alert-{{session()->get('status')}}">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <form action="{{route('proposals.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter proposal" value="{{ old('title') }}">
                        @if($errors->has('title'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('title')}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea class="form-control" id="text" rows="3" name="message" >{{ old("message") }}</textarea>
                        @if($errors->has('message'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('message')}}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="image">Example file input</label>
                        <input type="file" class="form-control-file" name="attached_file" id="image">
                        @if($errors->has('attached_file'))
                            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('attached_file')}}</small>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection
