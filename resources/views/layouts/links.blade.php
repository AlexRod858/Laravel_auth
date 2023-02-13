
    <h1>Community</h1>
    
        @forelse ($links as $link)

            <li>
                <span class="label label-default" style="background: {{ $link->channel->color }}">
                    {{ $link->channel->title }}
                </span>
                <a href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>
                <small>Contributed by: {{ $link->creator->name }}
                    {{ $link->updated_at->diffForHumans() }}</small>

            </li>
            @empty
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h3>No contributiones yet</h3>
                </div>
            

        @endforelse


