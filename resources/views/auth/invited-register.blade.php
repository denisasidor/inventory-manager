<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setează Parola</title>
</head>
<body>
<h2>Finalizare Înregistrare</h2>

<form method="POST" action="{{ route('register.invited.submit', ['token' => $token]) }}">


    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">


    <label for="name">Nume complet:</label><br>
    <input type="text" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" name="email" value="{{ $email }}" readonly><br><br>

    <label for="password">Parolă:</label><br>
    <input type="password" name="password" required><br><br>

    <label for="password_confirmation">Confirmă Parola:</label><br>
    <input type="password" name="password_confirmation" required><br><br>

    <button type="submit">Creează contul</button>
</form>

</body>
</html>
