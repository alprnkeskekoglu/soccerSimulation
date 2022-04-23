@extends('layouts.app')
@section('content')
    <div class="w-25 m-auto">
        <h3>Tournament Teams</h3>
        <index></index>
        <a href="{{ route('fixtures.index') }}" class="btn btn-primary">Generate Fixtures</a>
    </div>
@endsection
