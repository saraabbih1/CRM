<a href="{{ route('clients.create') }}">Ajouter client</a>

@foreach($clients as $client)
    <div style="margin-bottom:10px;">

        <strong>{{ $client->name }}</strong> -
        {{ $client->phone }} -

        @if($client->status == 'new')
            <span style="color:blue;">New</span>
        @elseif($client->status == 'interesse')
            <span style="color:orange;">Intéressé</span>
        @elseif($client->status == 'paye')
            <span style="color:green;">Payé</span>
        @elseif($client->status == 'relance')
            <span style="color:red;">À relancer</span>
        @else
            <span>{{ $client->status }}</span>
        @endif

        <a href="{{ route('clients.edit', $client->id) }}">Edit</a>

    </div>
@endforeach