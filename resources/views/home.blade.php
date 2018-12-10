@extends('layouts.app')

@section('content')
    <messenger-component :user-id="{{ Auth::user()->id }}" user-image="{{ Auth::user()->image }}" />
@endsection
