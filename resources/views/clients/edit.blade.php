<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit client</title>
    <link rel="stylesheet" href="{{ asset('css/crm.css') }}">
</head>
<body>
    <div class="shell">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-mark">CRM</div>
                <div>
                    <p class="brand-title">BlueDesk</p>
                    <p class="brand-subtitle">Client manager</p>
                </div>
            </div>

            <nav>
                <a class="nav-link active" href="{{ route('clients.index') }}">Clients</a>
            </nav>
        </aside>

        <main class="main">
            <header class="page-head">
                <div>
                    <p class="eyebrow">Modification</p>
                    <h1>{{ $client->name }}</h1>
                    <p class="muted">Mets a jour les informations et le reminder.</p>
                </div>
                <a class="btn btn-light" href="{{ route('clients.index') }}">Retour</a>
            </header>

            <section class="panel form-shell">
                <div class="panel-title">
                    <h2>Fiche client</h2>
                </div>

                <form method="POST" action="{{ route('clients.update', $client->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="field">
                            <label for="name">Nom</label>
                            <input id="name" type="text" name="name" value="{{ $client->name }}" required>
                        </div>

                        <div class="field">
                            <label for="phone">Telephone</label>
                            <input id="phone" type="text" name="phone" value="{{ $client->phone }}" required>
                        </div>

                        <div class="field">
                            <label for="reminder_at">Reminder</label>
                            <input
                                id="reminder_at"
                                type="datetime-local"
                                name="reminder_at"
                                value="{{ $client->reminder_at ? $client->reminder_at->format('Y-m-d\TH:i') : '' }}"
                            >
                        </div>

                        <div class="field">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="new" {{ $client->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="interesse" {{ $client->status == 'interesse' ? 'selected' : '' }}>Interesse</option>
                                <option value="paye" {{ $client->status == 'paye' ? 'selected' : '' }}>Paye</option>
                                <option value="relance" {{ $client->status == 'relance' ? 'selected' : '' }}>A relancer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a class="btn btn-light" href="{{ route('clients.index') }}">Annuler</a>
                        <button class="btn" type="submit">Update</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
