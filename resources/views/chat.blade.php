@extends('layouts.app') 

@section('content') 
    {{--
    <messenger-component :user="{{ Auth::user() }}" /> 
    --}}
    <router-view :user="{{ Auth::user() }}" />
@endsection