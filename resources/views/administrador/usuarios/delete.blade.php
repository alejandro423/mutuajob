<form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
</form>