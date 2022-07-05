@extends('layouts.front')

@section('adminlte')
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white mystyle">{{ __('Home') }}</div>

                <div class="card-body mt-2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-primary">
                              <div class="inner">
                                <h3>150</h3>
                
                                <p>New Orders</p>
                              </div>
                              <div class="icon">
                                <i class="icon fa fa-book"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>

                          <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                              <div class="inner">
                                <h3>150</h3>
                
                                <p>New Orders</p>
                              </div>
                              <div class="icon">
                                <i class="icon fa fa-book"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>

                          <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                              <div class="inner">
                                <h3>150</h3>
                
                                <p>New Orders</p>
                              </div>
                              <div class="icon">
                                <i class="icon fa fa-book"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>

                          
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
