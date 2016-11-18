@extends('layouts.app')

@section('content')

    @include('partials.generic.top')

    @include('partials.alerts.all')

    @include($includeView)

@endsection
