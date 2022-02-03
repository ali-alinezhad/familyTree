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


        /*Now the CSS*/
        * {
            margin: 0;
            padding: 0;
        }

        .tree ul {
            padding-top: 20px;
            position: relative;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        .tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*We will use ::before and ::after to draw the connectors*/

        .tree li::before, .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 20px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        /*We need to remove left-right connectors from elements without
        any siblings*/
        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        /*Remove space from the top of single children*/
        .tree li:only-child {
            padding-top: 0;
        }

        /*Remove left connector from first child and
        right connector from last child*/
        .tree li:first-child::before, .tree li:last-child::after {
            border: 0 none;
        }

        /*Adding back the vertical connector to the last nodes*/
        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        /*Time to add downward connectors from parents*/
        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 20px;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;

            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;

            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
        }

        /*Time for some hover effects*/
        /*We will apply the hover effect the the lineage of the element also*/
        .tree li a:hover, .tree li a:hover + ul li a {
            background: #c8e4f8;
            color: #000;
            border: 1px solid #94a0b4;
        }

        /*Connector styles on hover*/
        .tree li a:hover + ul li::after,
        .tree li a:hover + ul li::before,
        .tree li a:hover + ul::before,
        .tree li a:hover + ul ul::before {
            border-color: #94a0b4;
        }


    </style>
@endsection
@section('content')
    <div class="container">
        @if($profile)
            <div class="main-body">
                <div class="pb-2">
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#displayTree">
                        {{ __('translations.tree') }} <i class="cib-gumtree"></i>
                    </button>
                </div>

                <div class="row gutters-sm">
                    <div class="col-md-5 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img name="{{ $profile['picture'] }}"
                                         src="@if($profile['picture']){{ asset($profile['picture']) }}@else{{ asset('/images/unknown.png') }}@endif"
                                         class="rounded-circle" width="200" height="220">
                                    <div class="mt-3">
                                        <h4>{{ $user['persian_name'] ?? '--' }}</h4>
                                        <p class="text-secondary mb-1">{{ $profile['birthday'] ?? '--' }}</p>
                                        <p class="text-muted font-size-sm">{{ $profile['birthday_place'] ?? '--' }}</p>
                                        @if(!$isSameUser)
                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                    data-target="#sendMessage">
                                                {{ __('translations.send_private_message') }}
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
                                        {{ __('translations.address') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['residence_place'] ?? '--' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        {{ __('translations.telephone') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['telephone'] ?? '--' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        {{ __('translations.email') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['email'] ?? '--' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        {{ __('translations.education') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['education'] ?? '--' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        {{ __('translations.job_title') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['job_title'] ?? '--' }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        {{ __('translations.job_place') }}
                                    </h6>
                                    <span class="text-secondary">{{ $profile['job_place'] ?? '--' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.titles') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $profile['titles'] ?? '--' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.father_name') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $fatherName }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.mother_name') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $profile['mother_name'] ?? '--' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.spouse_name') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $profile['spouse_name'] ?? '--' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.marriage_date') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $profile['marriage_date'] ?? '--' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> {{ __('translations.marriage_place') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $profile['marriage_place'] ?? '--' }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('translations.children') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $kids }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6 class="mb-2">{{ __('translations.about_me') }}</h6>
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
                                                        {{ __('translations.date_time') }}
                                                    </h6>
                                                    <span
                                                        class="text-secondary">{{ $profile['death_date'] ?? '--' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">
                                                        {{ __('translations.death_place') }}
                                                    </h6>
                                                    <span
                                                        class="text-secondary">{{ $profile['death_place'] ?? '--' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                    <h6 class="mb-0">
                                                        {{ __('translations.burial_place') }}
                                                    </h6>
                                                    <span
                                                        class="text-secondary">{{ $profile['burial_place'] ?? '--' }}</span>
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
                            {{ Form::open(['route'=>['message.send',$locale,$user->id], 'method' => 'put']) }}
                            <div>
                                <div class="form-group">
                                    <label for="subject">{{ __('translations.message_subject') }}</label>
                                    <input type="text" name="subject" class="form-control" id="subject">
                                    @error('subject')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">*{{ __('translations.description') }}</label>
                                    <textarea type="text" name="description" class="form-control" id="description"
                                              required></textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mb-2">{{ __('translations.send') }}</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('translations.close') }}</button>
                        </div>
                    </div>

                </div>
            </div>
            <div id="displayTree" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            {{ __('translations.tree') }}
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="content-center">
                                <div class="tree">
                                    <ul>
                                        <li>
                                            @foreach(array_reverse($fatherLinks) as $name => $fatherLink)
                                                <a href="{{ $fatherLink }}">{{ $name }}</a>
                                                <ul>
                                                    <li>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center"> {{ __('translations.no_details') }}</div>
        @endif
    </div>
@endsection

