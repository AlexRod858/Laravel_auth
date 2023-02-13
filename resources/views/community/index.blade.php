@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @include('layouts.links')
            </div>

            @include('../layouts/add-link')
        </div>
        {{ $links->links() }}

    </div>


@stop
