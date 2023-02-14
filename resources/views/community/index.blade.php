@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                    <div class="col-md-8">



                <h1 class="h1">Community - {{$channel == null ? " " : $channel->title }}</h1>

                @include('layouts.links')
            </div>

            @include('../layouts/add-link')
        </div>
        {{ $links->links() }}

    </div>


@stop
