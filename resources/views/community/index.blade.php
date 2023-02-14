@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if ($links[0]->title == 'PHP' || $links[1]->title == 'C#' || $links[2]->title == 'javascript')
                <h1 class="h1">Community - {{ $links[0]->title }}</h1>
                @endif
                @include('layouts.links')
            </div>

            @include('../layouts/add-link')
        </div>
        {{ $links->links() }}

    </div>


@stop
