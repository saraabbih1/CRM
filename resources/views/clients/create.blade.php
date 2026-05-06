<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter client</title>
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
                    <p class="eyebrow">Nouveau client</p>
                    <h1>Ajouter client</h1>
                    <p class="muted">Cree une fiche client avec status et reminder.</p>
                </div>
                <a class="btn btn-light" href="{{ route('clients.index') }}">Retour</a>
            </header>

            <section class="panel form-shell">
                <div class="panel-title">
                    <h2>Informations client</h2>
                </div>

                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf

                    <div class="form-grid">
                        <div class="field">
                            <label for="name">Nom</label>
                            <input id="name" type="text" name="name" placeholder="Nom du client" required>
                        </div>

                        <div class="field">
                            <label for="phone">Telephone</label>
                            <input id="phone" type="text" name="phone" placeholder="Numero de telephone" required>
                        </div>

                        <div class="field">
                            <label for="reminder_at">Reminder</label>
                            <input id="reminder_at" type="datetime-local" name="reminder_at">
                        </div>

                        <div class="field">
                            <label for="status">Status</label>
                            <select id="status" name="status" required>
                                <option value="new">New</option>
                                <option value="interesse">Interesse</option>
                                <option value="paye">Paye</option>
                                <option value="relance">A relancer</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a class="btn btn-light" href="{{ route('clients.index') }}">Annuler</a>
                        <button class="btn" type="submit">Ajouter</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
