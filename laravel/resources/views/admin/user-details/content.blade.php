<h1 class="text-left">Detalles de {{ $user->name }}</h1>

<div class="user-details">
    <h2>User Details</h2>
    <ul>
        <li><strong>ID:</strong> {{$user->id}}</li>
        <li><strong>Name:</strong> {{$user->name}}</li>
        <li><strong>Surname:</strong> {{$user->surname}}</li>
        <li><strong>Username:</strong> {{$user->username}}</li>
        <li><strong>Phone Number:</strong> {{$user->phone_number}}</li>
        <li><strong>Gender:</strong> {{$user->gender}}</li>
        <li><strong>Birthdate:</strong> {{$user->birthdate}}</li>
        <li><strong>Email:</strong> {{$user->email}}</li>
        <li><strong>Role:</strong> {{$user->rol}}</li>
        <li><strong>Created At:</strong> {{$user->created_at}}</li>
    </ul>
</div>