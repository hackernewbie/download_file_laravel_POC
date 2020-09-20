@extends('layouts.app')

@section('content')
<style>
    .success{
        background: #00FF00;
        color: #fff;
    }
    img{
        max-height: 200px !important; 
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard - File Upload') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <form action="{{route('file-upload')}}" method="POST" class="needs-validation repeater novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="file" class="repeater-file-upload upload-document form-control" name="file-name[]" multiple id="file-name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-control">
                                        <input type="submit" name="upload" value="Upload"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @include('inc.messages')
                </div>
            </div>


            @if(isset($files))
            <div class="card">
                <div class="card-header">Uploaded Files</div>
                <div class="card-body">
                    @foreach ($files as $file)
                    <div class="row py-4">
                        <div class="col-lg-6">
                            <img src="{{asset('storage/files/').'/'.$file->file_name}}" class="image-resize" /> 
                        </div>
                        <div class="col-lg-6">
                            <a href="{{route('file-download',$file->id)}}" class="btn btn-success">Download</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            

        </div>
    </div>
</div>
@endsection
