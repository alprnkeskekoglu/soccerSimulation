@extends('layouts.app')
@section('content')

<div class="container">
    <h3 class="text-center">Generated Fixtures</h3>
    <fixture></fixture>
    <a href="{{ route('simulations.index') }}" class="btn btn-primary">Start Simulation</a>
</div>
@endsection
