<form method="POST" action="{{ route('clients.update', $client->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $client->name }}">
    <input type="text" name="phone" value="{{ $client->phone }}">

    <select name="status">
        <option value="new" {{ $client->status == 'new' ? 'selected' : '' }}>New</option>
        <option value="interesse" {{ $client->status == 'interesse' ? 'selected' : '' }}>Intéressé</option>
        <option value="paye" {{ $client->status == 'paye' ? 'selected' : '' }}>Payé</option>
        <option value="relance" {{ $client->status == 'relance' ? 'selected' : '' }}>À relancer</option>
    </select>

    <button type="submit">Update</button>
</form>