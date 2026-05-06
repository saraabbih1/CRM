<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter client</title>
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
            width: min(760px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0;
        }

        .panel {
            background: #ffffff;
            border: 1px solid #d7e6fb;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(25, 86, 165, 0.08);
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 20px;
            border-bottom: 1px solid #d7e6fb;
        }

        h1 {
            margin: 0;
            color: #0f3d75;
            font-size: 26px;
            line-height: 1.2;
        }

        form {
            display: grid;
            gap: 16px;
            padding: 20px;
        }

        label {
            display: grid;
            gap: 7px;
            color: #38516e;
            font-size: 14px;
            font-weight: 700;
        }

        input,
        select {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #b8d4f5;
            border-radius: 8px;
            background: #fbfdff;
            color: #102033;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #1769d2;
            box-shadow: 0 0 0 3px rgba(23, 105, 210, 0.14);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            padding-top: 4px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 10px 16px;
            border: 0;
            border-radius: 8px;
            background: #1769d2;
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
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
    </style>
</head>
<body>
    <main class="page">
        <section class="panel">
            <header class="panel-header">
                <h1>Ajouter client</h1>
                <a class="btn btn-secondary" href="{{ route('clients.index') }}">Retour</a>
            </header>

            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <label>
                    Nom
                    <input type="text" name="name" placeholder="Nom du client" required>
                </label>

                <label>
                    Telephone
                    <input type="text" name="phone" placeholder="Numero de telephone" required>
                </label>

                <label>
                    Reminder
                    <input type="datetime-local" name="reminder_at">
                </label>

                <label>
                    Status
                    <select name="status" required>
                        <option value="new">New</option>
                        <option value="interesse">Interesse</option>
                        <option value="paye">Paye</option>
                        <option value="relance">A relancer</option>
                    </select>
                </label>

                <div class="actions">
                    <button class="btn" type="submit">Ajouter</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
