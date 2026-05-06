<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients CRM</title>
    <link rel="stylesheet" href="{{ asset('css/crm.css') }}">
</head>
<body>
    @php
        $statusLabels = [
            'new' => 'New',
            'interesse' => 'Interesse',
            'paye' => 'Paye',
            'relance' => 'A relancer',
        ];

        $totalClients = $clients->count();
        $dueReminders = $clients->filter(fn ($client) => $client->reminder_at && $client->reminder_at <= now())->count();
        $paidClients = $clients->where('status', 'paye')->count();
    @endphp

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
                    <p class="eyebrow">Dashboard</p>
                    <h1>Clients</h1>
                    <p class="muted">Gestion des clients, statuts et rappels.</p>
                </div>
                <a class="btn" href="{{ route('clients.create') }}">Ajouter client</a>
            </header>

            <section class="stats">
                <div class="stat-card">
                    <p class="stat-label">Total clients</p>
                    <p class="stat-value">{{ $totalClients }}</p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Reminders actifs</p>
                    <p class="stat-value">{{ $dueReminders }}</p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Clients payes</p>
                    <p class="stat-value">{{ $paidClients }}</p>
                </div>
            </section>

            <section class="panel">
                <div class="panel-title">
                    <h2>Liste des clients</h2>
                    <span class="muted">{{ $totalClients }} enregistrements</span>
                </div>

                @if($clients->isEmpty())
                    <div class="empty-state">
                        <strong>Aucun client pour le moment</strong>
                        <span>Ajoute ton premier client pour commencer le suivi.</span>
                    </div>
                @else
                    <div class="table-wrap">
                        <table class="client-table">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Status</th>
                                    <th>Reminder</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="client-name">{{ $client->name }}</div>
                                            <div class="client-phone">{{ $client->phone }}</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $client->status }}">
                                                {{ $statusLabels[$client->status] ?? $client->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($client->reminder_at)
                                                <div class="client-date">{{ $client->reminder_at->format('d/m/Y H:i') }}</div>
                                                @if($client->reminder_at <= now())
                                                    <span class="reminder-alert">Contacter maintenant</span>
                                                @endif
                                            @else
                                                <span class="client-date">Aucun reminder</span>
                                            @endif

                                            @if($client->reminder_at)
                                                <span
                                                    class="client-reminder"
                                                    data-client-id="{{ $client->id }}"
                                                    data-client-name="{{ $client->name }}"
                                                    data-reminder-at="{{ $client->reminder_at->format('Y-m-d\TH:i:s') }}"
                                                    hidden
                                                ></span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-row">
                                                <a class="btn btn-light" href="{{ route('clients.edit', $client->id) }}">Edit</a>
                                                <form class="delete-form" action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Supprimer ce client ?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </main>
    </div>

    <script>
        const reminders = [...document.querySelectorAll('.client-reminder')].map((element) => ({
            id: element.dataset.clientId,
            name: element.dataset.clientName,
            reminderAt: new Date(element.dataset.reminderAt).getTime(),
        }));

        function checkReminders() {
            const now = Date.now();

            reminders.forEach((reminder) => {
                const storageKey = `client-reminder-alerted-${reminder.id}-${reminder.reminderAt}`;

                if (reminder.reminderAt <= now && !localStorage.getItem(storageKey)) {
                    localStorage.setItem(storageKey, '1');
                    alert(`Reminder: contacter ${reminder.name}`);
                }
            });
        }

        checkReminders();
        setInterval(checkReminders, 30000);
    </script>
</body>
</html>
