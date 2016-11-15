@extends('layouts.app')

@section('content')

    @include('partials.crud.top')

    @include('partials.alerts.all')

    @include($includeView)

    @include('pagination.default')

@endsection
