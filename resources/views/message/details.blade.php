@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="pb-5">
            <a href="{{ route('message.inbox',[$locale]) }}"> {{ __('translations.back') }} </a>
        </div>

        <div class="jumbotron">
            <div class="float-right">
                {{ $privateMessage['created_at'] }}
            </div>
            <h1 class="pb-4">
                {{ $privateMessage['subject'] }}
            </h1>
            <div class="pb-5">
                {{ $privateMessage['description'] }}
            </div>
        </div>

        <button data-toggle="collapse" data-target="#reply">{{ __('translations.reply') }}</button>

        <div id="reply" class="collapse pt-5">
            {{ Form::open(['route'=>['message.reply',$locale,$privateMessage->id], 'method' => 'put']) }}
            <input type="hidden" name="old_sender_id" value="{{ $privateMessage['sender_user_id'] }}">
            <div>
                <div class="form-group">
                    <label for="subject">{{ __('translations.submit') }}</label>
                    <input type="text" name="subject" class="form-control col-md-4" id="subject"
                           value="Reply to {{ $privateMessage['subject'] }}">
                    @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">*{{ __('translations.description') }}</label>
                    <textarea type="text" name="description" class="form-control col-md-4" id="description" required></textarea>
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
    </div>
@endsection
