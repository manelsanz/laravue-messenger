@extends('layouts.app')

@section('content')
    <messenger-component :user="{{ Auth::user() }}" />
@endsection
