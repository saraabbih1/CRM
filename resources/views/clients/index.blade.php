<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients CRM</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #eef5ff;
            color: #102033;
            font-family: Arial, Helvetica, sans-serif;
        }

        .page {
            width: min(1100px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            padding: 18px 20px;
            background: #ffffff;
            border: 1px solid #d7e6fb;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(25, 86, 165, 0.08);
        }

        h1 {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            color: #0f3d75;
        }

        .subtitle {
            margin: 5px 0 0;
            color: #61748c;
            font-size: 14px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 9px 14px;
            border: 0;
            border-radius: 8px;
            background: #1769d2;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #0f56b3;
        }

        .btn-secondary {
            background: #e8f1ff;
            color: #1156a8;
        }

        .btn-secondary:hover {
            background: #d8e9ff;
        }

        .btn-danger {
            background: #fee2e2;
            color: #b42318;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        .clients {
            display: grid;
            gap: 12px;
        }

        .client-card {
            display: grid;
            grid-template-columns: minmax(180px, 1.3fr) minmax(140px, 0.8fr) auto auto;
            align-items: center;
            gap: 14px;
            padding: 16px;
            background: #ffffff;
            border: 1px solid #d7e6fb;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(25, 86, 165, 0.06);
        }

        .name {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: #102033;
        }

        .phone,
        .reminder {
            color: #61748c;
            font-size: 14px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: fit-content;
            min-height: 30px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 800;
        }

        .status-new {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-interesse {
            background: #fff7ed;
            color: #c2410c;
        }

        .status-paye {
            background: #dcfce7;
            color: #15803d;
        }

        .status-relance {
            background: #fee2e2;
            color: #b42318;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .delete-form {
            margin: 0;
        }

        .alert-line {
            grid-column: 1 / -1;
            padding: 10px 12px;
            border-radius: 8px;
            background: #fff1f2;
            color: #be123c;
            font-weight: 700;
        }

        .empty {
            padding: 28px;
            text-align: center;
            background: #ffffff;
            border: 1px dashed #9bc2f1;
            border-radius: 8px;
            color: #61748c;
        }

        @media (max-width: 760px) {
            .topbar,
            .client-card {
                grid-template-columns: 1fr;
            }

            .topbar {
                align-items: stretch;
            }

            .actions {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="topbar">
            <div>
                <h1>Clients CRM</h1>
                <p class="subtitle">Gestion des clients, statuts et rappels.</p>
            </div>
            <a class="btn" href="{{ route('clients.create') }}">Ajouter client</a>
        </header>

        <section class="clients">
            @forelse($clients as $client)
                <article class="client-card">
                    <div>
                        <p class="name">{{ $client->name }}</p>
                        <div class="phone">{{ $client->phone }}</div>
                        @if($client->reminder_at)
                            <div class="reminder">Reminder: {{ $client->reminder_at->format('d/m/Y H:i') }}</div>
                        @endif
                    </div>

                    @php
                        $statusLabels = [
                            'new' => 'New',
                            'interesse' => 'Interesse',
                            'paye' => 'Paye',
                            'relance' => 'A relancer',
                        ];
                    @endphp

                    <span class="status status-{{ $client->status }}">
                        {{ $statusLabels[$client->status] ?? $client->status }}
                    </span>

                    <div class="actions">
                        <a class="btn btn-secondary" href="{{ route('clients.edit', $client->id) }}">Edit</a>
                        <form class="delete-form" action="{{ route('clients.destroy', $client->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Supprimer ce client ?')">
                                Delete
                            </button>
                        </form>
                    </div>

                    @if($client->reminder_at && $client->reminder_at <= now())
                        <div class="alert-line">Reminder: contacter ce client maintenant.</div>
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
                </article>
            @empty
                <div class="empty">Aucun client pour le moment.</div>
            @endforelse
        </section>
    </main>

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
