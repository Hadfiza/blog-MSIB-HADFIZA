<form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this data?');">
        Delete
    </button>
</form>
