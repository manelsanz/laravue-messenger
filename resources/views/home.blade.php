@extends('layouts.app')

@section('content')
    <messenger-component :user-id="{{ Auth::user()->id }}" />
@endsection
