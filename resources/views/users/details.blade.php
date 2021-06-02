@php $locale = session()->get('locale') ?? 'fas'; @endphp
@extends('layouts.app')

@section('third_party_stylesheets')
    <style>
        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm > .col, .gutters-sm > [class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3, .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
@endsection
@section('content')
<div class="container">
    @if($profile)
        <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img name="{{ $profile['picture'] }}" src="@if($profile['picture']){{ asset($profile['picture']) }}@else{{ asset('/images/unknown.png') }}@endif"
                                 class="rounded-circle" width="200">
                            <div class="mt-3">
                                <h4>{{ $user['persian_name'] ?? '--' }}</h4>
                                <p class="text-secondary mb-1">{{ $profile['birthday'] ?? '--' }}</p>
                                <p class="text-muted font-size-sm">{{ $profile['birthday_place'] ?? '--' }}</p>
                                @if(!$isSameUser)
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#sendMessage">
                                        Send a private message
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Address
                            </h6>
                            <span class="text-secondary">{{ $profile['residence_place'] ?? '--' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Telephone
                            </h6>
                            <span class="text-secondary">{{ $profile['telephone'] ?? '--' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Email
                            </h6>
                            <span class="text-secondary">{{ $profile['email'] ?? '--' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Education
                            </h6>
                            <span class="text-secondary">{{ $profile['education'] ?? '--' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Job Title
                            </h6>
                            <span class="text-secondary">{{ $profile['job_title'] ?? '--' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                Work place
                            </h6>
                            <span class="text-secondary">{{ $profile['job_place'] ?? '--' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Title</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['titles'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Father Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['father_name'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mother Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['mother_name'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Spouse Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['spouse_name'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Marriage Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['marriage_date'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Place of Marriage</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['marriage_place'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Children</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $profile['children_number'] ?? '--' }}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="mb-2">About Me</h6>
                                <hr>
                                <div class="row">
                                    <div class="col text-justify">
                                       @php echo $profile['about_me'] ?? '--' ; @endphp
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card mt-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                Date of Death
                                            </h6>
                                            <span class="text-secondary">{{ $profile['death_date'] ?? '--' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                Place of death
                                            </h6>
                                            <span class="text-secondary">{{ $profile['death_place'] ?? '--' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                            <h6 class="mb-0">
                                                Place of burial
                                            </h6>
                                            <span class="text-secondary">{{ $profile['burial_place'] ?? '--' }}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div id="sendMessage" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(['route'=>['users.send.message',$locale,$user->id], 'method' => 'put']) }}
                        <div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" id="subject">
                                @error('subject')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">*Description</label>
                                <textarea type="text" name="description" class="form-control" id="description" required></textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Send</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    @else
        <div class="text-center"> There is no detail informations</div>
    @endif
</div>
@endsection

