@extends('app')

@section('title', __('Properties'))

@section('content')
    <div class="properties h-screen bg-white flex flex-col space-y-10 items-center">
        <div class="bg-white w-full max-w-screen-lg shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">{{ __('Properties') }}</h1>
            <div class="flex flex-col mt-8" id="properties-wrap"></div>
        </div>
    </div>
@endsection
