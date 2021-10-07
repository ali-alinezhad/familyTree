@php $locale = session()->get('locale') ?? 'fas'; @endphp
@extends('layouts.app')
@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('css/styles/passtrength.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles/persianDatepicker.css') }}">
    <style>
        .pdp-header {
            height: 30px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        {{ Form::open(['route'=>['users.info.update',$locale,$user->id], 'method' => 'put']) }}
        <div>
            <div class="form-group">
                <label for="english_name">{{ __('translations.english_name') }}</label>
                <input type="text" name="english_name" class="form-control" id="english_name"
                       value="@if($user) {{ $user['english_name'] }} @endif" required>
                @error('english_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="persian_name">{{ __('translations.persian_name') }}</label>
                <input type="text" name="persian_name" class="form-control" id="persian_name"
                       value="@if($user) {{ $user['persian_name'] }} @endif" required>
                @error('persian_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="hidden" name="tooltip_check" id = "tooltip_check" value="">
                <label for="password">{{ __('translations.password') }}</label>
                <input type="password" name="password" class="form-control" id="password">

                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{ __('translations.password_confirmation') }}</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2" id="submit_auth">{{ __('translations.submit') }}</button>
        </div>
        {{ Form::close() }}
    </div>

    <div>
        {{ Form::open(['route'=>['users.profile.update',$locale,$user->id,$profile->id ?? null], 'method' => 'put', 'enctype'=>"multipart/form-data"]) }}
        <div id="accordion">
            <h3>{{ __('translations.personal_information') }}</h3>
            <div>
                <div class="form-group">
                    <input type="file" name="picture" id="picture" onchange="readURL(this);">
                    <img src="
                        @if($profile && $profile['picture'])
                    {{ asset($profile['picture']) }}
                    @else
                    {{ asset('images/unknown.png') }}
                    @endif" width="100" height="100" id="image"
                    />

                    @if($profile && $profile['picture'])
                        <a href="{{ route('users.profile.delete.avatar',['lang' => $locale,'username'=> $user->username,'profile'=> $profile->id]) }}">
                            <i class="btn text-danger cil-trash"></i>
                        </a>
                    @endif

                    @error('picture')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birthday">{{ __('translations.birthday') }}</label>
                    <input name="birthday" class="form-control" id="birthday"
                           value="@if($profile && $profile['birthday']){{ $profile['birthday']->format('Y-m-d') }}@endif">
                    <span id="span1"></span>
                    @error('birthday')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birthday_place">{{ __('translations.birthday_place') }}</label>
                    <input type="text" name="birthday_place" class="form-control" id="birthday_place"
                           value="@if($profile) {{ $profile['birthday_place'] }} @endif">
                    @error('birthday_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="residence_place">{{ __('translations.residence_place') }}</label>
                    <input type="text" name="residence_place" class="form-control" id="residence_place"
                           value="@if($profile) {{ $profile['residence_place'] }} @endif">

                    @error('residence_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="education">{{ __('translations.education') }}</label>
                    <input type="text" name="education" class="form-control" id="education"
                           value="@if($profile) {{ $profile['education'] }} @endif">
                    @error('education')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="job_title">{{ __('translations.job_title') }}</label>
                    <input type="text" name="job_title" class="form-control" id="job_title"
                           value="@if($profile) {{ $profile['job_title'] }} @endif">

                    @error('job_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="job_place">{{ __('translations.job_place') }}</label>
                    <input type="text" name="job_place" class="form-control" id="job_place"
                           value="@if($profile) {{ $profile['job_place'] }} @endif">

                    @error('job_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h3>{{ __('translations.parent_information') }}</h3>
            <div>
                <div class="form-group">

                    <label for="father_name">{{ __('translations.father_name') }}</label>
                    <select name="father_name" class="form-control" id="father_name">
                        <option></option>
                        @foreach($fathers as $father)
                            <option value="{{ $father->id }}" @if($profile && $profile['father_name'] ===  $father->id) selected @endif>
                                {{ $father->persian_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('father_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mother_name">{{ __('translations.mother_name') }}</label>
                    <input type="text" name="mother_name" class="form-control" id="mother_name"
                           value="@if($profile) {{ $profile['mother_name'] }} @endif">

                    @error('mother_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="spouse_name">{{ __('translations.spouse_name') }}</label>
                    <input type="text" name="spouse_name" class="form-control" id="spouse_name"
                           value="@if($profile) {{ $profile['spouse_name'] }} @endif">

                    @error('spouse_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="marriage_data">{{ __('translations.marriage_date') }}</label>
                    <input name="marriage_data" class="form-control" id="marriage_data"
                           value="@if($profile) {{ $profile['marriage_date'] }} @endif">

                    @error('marriage_data')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="marriage_place">{{ __('translations.marriage_place') }}</label>
                    <input type="text" name="marriage_place" class="form-control" id="marriage_place"
                           value="@if($profile) {{ $profile['marriage_place'] }} @endif">

                    @error('marriage_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="children_number">{{ __('translations.children_number') }}</label>
                    <input type="text" name="children_number" class="form-control" id="children_number"
                           value="@if($profile) {{ $profile['children_number'] }} @endif">

                    @error('children_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h3>{{ __('translations.more_information') }}</h3>
            <div>
                <div class="form-group">
                    <label for="titles">{{ __('translations.titles') }}</label>
                    <input type="text" name="titles" class="form-control" id="titles"
                           value="@if($profile) {{ $profile['titles'] }} @endif">

                    @error('titles')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telephone">{{ __('translations.telephone') }}</label>
                    <input type="text" name="telephone" class="form-control" id="telephone"
                           value="@if($profile) {{ $profile['telephone'] }} @endif">
                    @error('telephone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('translations.email') }}</label>
                    <input type="email" name="email" class="form-control" id="email"
                           value="@if($profile) {{ $profile['email'] }} @endif">

                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="death_date">{{ __('translations.death_date') }}</label>
                    <input name="death_date" class="form-control" id="death_date"
                           value="@if($profile && $profile['death_date']){{ $profile['death_date'] }}@endif">

                    @error('death_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="death_place">{{ __('translations.death_place') }}</label>
                    <input type="text" name="death_place" class="form-control" id="death_place"
                           value="@if($profile) {{ $profile['death_place'] }} @endif">

                    @error('death_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="burial_place">{{ __('translations.burial_place') }}</label>
                    <input type="text" name="burial_place" class="form-control" id="burial_place"
                           value="@if($profile) {{ $profile['burial_place'] }} @endif">
                    @error('burial_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h3>{{ __('translations.about_me') }}</h3>
            <div>
                <div class="form-group">
                    <label for="about_me">{{ __('translations.about_me') }}</label>
                    <textarea class="ckeditor form-control" name="about_me" id="my_ckeditor">
                         @if($profile) {{ $profile['about_me'] }} @endif
                     </textarea>
                    @error('about_me')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="p-3">
            <button type="submit" class="btn btn-primary mb-2">{{ __('translations.submit') }}</button>
        </div>
        {{ Form::close() }}
    </div>
@endsection

@section('third_party_scripts')
    <script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/scripts/jquery.passtrength.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scripts/persianDatepicker.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#accordion").accordion();
            $('#submit_auth').hide();
            CKEDITOR.replace('my_ckeditor');
            $("#birthday,#marriage_data,#death_date").persianDatepicker();
        });

        $('#password').passtrength({
            minChars: 7,
            eyeImg: "{{ asset('/images/eye.svg') }}"
        });

        $('#password').keydown(function () {

            if($(".tooltip").text() === 'Weak' || $(".tooltip").text() === 'Min 7 chars'){
                $('#submit_auth').hide();
            } else {
                $('#submit_auth').show();
            }
        });

        $('#submit_auth').click(function () {
            $('#tooltip_check').attr('value', $(".tooltip").text());
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
