@extends('layouts.app')

@section('content')

   <div class="row bgTransparentWhite2">
    <div class="col-md-7 bgTransparentWhite9 mx-auto">
   

      @guest
         <user-posts  username="{{ $username }}" guest="{{ $guest }}" id="{{ $id }}" ></user-posts>
      @else
       @if ( $id == Auth::user()->id)
          <user-posts username="{{ $username }}" guest="{{ $guest  }}" id="{{ Auth::user()->id}}"></user-posts>
       @else
          <user-posts username="{{ $username }}" guest="{{ $guest }}" id="{{ $id }}"></user-posts>
       @endif
      
      @endguest
              
    </div>
    {{-- <div class="col-md-5">
      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>

      <!-- Categories Widget -->
      <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">Web Design</a>
                </li>
                <li>
                  <a href="#">HTML</a>
                </li>
                <li>
                  <a href="#">Freebies</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">JavaScript</a>
                </li>
                <li>
                  <a href="#">CSS</a>
                </li>
                <li>
                  <a href="#">Tutorials</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Widget -->
      <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
          You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
      </div>

    </div> --}}
   </div>

{{--    
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-10">
            
            <div class="card">
                <div class="card-header  bg-info">{{ Auth::user()->name }} POSTS</div>
                <h1 class="my-4">
                    Home
                    <small>Explore Our Post!</small>
                  </h1>
                <div class="card-body">
                    @if ( $id == Auth::user()->id)
                        <user-posts id={{ Auth::user()->id}}></user-posts>
                    @else
                        <p>ELSE</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
