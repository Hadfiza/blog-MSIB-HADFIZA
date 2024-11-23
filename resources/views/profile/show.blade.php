<h1>Profil Pengguna</h1>
<p>Nama: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" width="150" />
<a href="{{ route('profile.edit') }}">Edit Profil</a>
