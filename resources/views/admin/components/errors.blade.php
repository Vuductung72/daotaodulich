@if ($errors->any())
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="padding: 5px 0px">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif