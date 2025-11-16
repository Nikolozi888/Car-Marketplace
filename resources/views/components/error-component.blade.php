@if ($errors->any())
    <div class="{{ $className }}">
        <strong>შეცდომა!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
