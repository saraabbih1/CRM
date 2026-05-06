<form method="POST" action="{{ route('clients.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nom">
    <input type="text" name="phone" placeholder="Téléphone">
    <button type="submit">Ajouter</button>
</form>