<form method="POST" action="{{ route('clients.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nom">
    <input type="text" name="phone" placeholder="Téléphone">
    <input type="datetime-local" name="reminder_at">

     <select name="status">
        <option value="new">New</option>
        <option value="interesse">Intéressé</option>
        <option value="paye">Payé</option>
        <option value="relance">À relancer</option>
    </select>

    <button type="submit">Ajouter</button>
</form>