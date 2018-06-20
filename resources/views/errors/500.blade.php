@extends('layouts.default')
@section('title', 'Errors')

@section('content')
{{ $e->getMessage() }}
@stop