<!doctype html>
<html>
<body>
    <h2>Richiesta Revisore</h2>
    <p>L’utente <strong>{{ $user->name }}</strong> ({{ $user->email }}) ha richiesto il ruolo di revisore.</p>
    <p>
        <a href="{{ $approveUrl }}">✅ Approva</a> |
        <a href="{{ $rejectUrl  }}">❌ Rifiuta</a>
    </p>
</body>
</html>