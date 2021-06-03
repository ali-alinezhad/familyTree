@extends('layouts.app')
@section('third_party_stylesheets')
    <style>
        .banner33 {
            background: #a770ef;
            background: -webkit-linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
            background: linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{ __('translations.gallery') }}</h1>
        <div class="px-lg-5">
            <div class="row">
                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Gallery item -->
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="bg-white rounded shadow-sm"><img
                            src="{{asset('images/unknown.png')}}"
                            alt="" class="img-fluid card-img-top">
                        <div class="p-4">
                            <h5><a href="#" class="text-dark">Red paint cup</a></h5>
                            <p class="small text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit</p>
                            <div
                                class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
                                <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span
                                        class="font-weight-bold">JPG</span></p>
                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">New</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
            <div class="py-5 text-right"><a href="#" class="btn btn-dark px-5 py-3 text-uppercase">Show me more</a></div>
        </div>
    </div>
@endsection
