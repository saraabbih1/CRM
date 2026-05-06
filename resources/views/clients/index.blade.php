<a href="{{ route('clients.create') }}">Ajouter client</a>

@foreach($clients as $client)
    <p>{{ $client->name }} - {{ $client->phone }} - {{ $client->status }}</p>
@endforeach