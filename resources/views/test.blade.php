こんにちは！<br><br>

@foreach($users as $user)
    <p>
        {{ $user->name }}
    </p>
@endforeach
