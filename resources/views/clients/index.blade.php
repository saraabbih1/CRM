<a href="{{ route('clients.create') }}">Ajouter client</a>

@foreach($clients as $client)
    <div style="margin-bottom:10px;">
        <strong>{{ $client->name }}</strong> -
        {{ $client->phone }} -
        <span>{{ $client->status }}</span>

        <a href="{{ route('clients.edit', $client->id) }}">Edit</a>
    </div>
@endforeach