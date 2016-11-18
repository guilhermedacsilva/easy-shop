@extends('layouts.app')

@section('content')

    @include('partials.generic.top')

    @include('partials.alerts.all')

    @include($includeView)

    @include('pagination.with_limit')

@endsection
