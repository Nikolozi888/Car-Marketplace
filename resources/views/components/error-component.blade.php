@if ($errors->any())
    <div class="{{ $className ? $className  : 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' }}">
        <strong>შეცდომა!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif