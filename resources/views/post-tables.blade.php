@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header  bg-info">Post Table</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{-- <posts-component id ="{{ Auth::user()->id }}" ></posts-component> --}}
                          
                    <posts-data-tables>
                    </posts-data-tables>

                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
