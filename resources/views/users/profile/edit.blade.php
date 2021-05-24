@php $locale = session()->get('locale') ?? 'en'; @endphp
@extends('layouts.app')

@section('content')
<div>
    {{ Form::open(['route'=>['users.profile.update',$locale,$profile->id ?? null], 'method' => 'put']) }}
        <input type="hidden" name="user_id" value="{{  session()->get('user') }}">

        <div id="accordion">

            <h3>{{ __('translations.personal_information') }}</h3>
            <div>
                <div class="form-group">
                    <label for="birthday">{{ __('translations.birthday') }}</label>
                    <input type="date" name="birthday" class="form-control" id="birthday"
                           value="@if($profile) {{ $profile['birthday'] }} @endif" required>
                    @error('birthday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="birthday_place">{{ __('translations.birthday_place') }}</label>
                    <input type="text" name="birthday_place" class="form-control" id="birthday_place"
                           value="@if($profile) {{ $profile['birthday_place'] }} @endif" required>
                    @error('birthday_place')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="residence_place">{{ __('translations.residence_place') }}</label>
                    <input type="text" name="residence_place" class="form-control" id="residence_place"
                           value="@if($profile) {{ $profile['residence_place'] }} @endif" required>

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
                    <input type="text" name="father_name" class="form-control" id="father_name"
                           value="@if($profile) {{ $profile['father_name'] }} @endif" required>

                    @error('father_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mother_name">{{ __('translations.mother_name') }}</label>
                    <input type="text" name="mother_name" class="form-control" id="mother_name"
                           value="@if($profile) {{ $profile['mother_name'] }} @endif" required>

                    @error('mother_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="spouse_name">{{ __('translations.spouse_name') }}</label>
                    <input type="text" name="spouse_name" class="form-control" id="spouse_name"
                           value="@if($profile) {{ $profile['spouse_name'] }} @endif" required>

                    @error('spouse_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="marriage_data">{{ __('translations.marriage_data') }}</label>
                    <input type="date" name="marriage_data" class="form-control" id="marriage_data"
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
                    <label for="picture">{{ __('translations.picture') }}</label>
                    <input type="file" name="picture" class="form-control" id="picture"
                           value="@if($profile) {{ $profile['picture'] }} @endif">

                    @error('picture')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="death_date">{{ __('translations.death_date') }}</label>
                    <input type="date" name="death_date" class="form-control" id="death_date"
                           value="@if($profile) {{ $profile['death_date'] }} @endif">

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
                    <input type="text" name="burial_place" class="form-control" id="burial_place" value="@if($profile) {{ $profile['burial_place'] }} @endif">
                    @error('burial_place')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="pt-5">
            <button type="submit" class="btn btn-primary mb-2">{{ __('translations.submit') }}</button>
        </div>
    {{ Form::close() }}
</div>
@endsection

@section('third_party_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#accordion").accordion();
        })
    </script>
@endsection