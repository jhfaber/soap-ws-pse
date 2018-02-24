@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Parece que hay algunos problemas con tus datos<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif