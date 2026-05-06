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
        @if($client->reminder_at && $client->reminder_at <= now())
    <div style="color:red;">
        🔔 Reminder: contacter ce client !
    </div>
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

        <a href="{{ route('clients.edit', $client->id) }}">Edit</a>

    </div>
    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')

    <button onclick="return confirm('Supprimer ce client ?')">
        Delete
    </button>
    
</form>
@endforeach

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
