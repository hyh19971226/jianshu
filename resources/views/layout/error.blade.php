        @if(count($errors) > 0)
        <div class="alert alert-danger" rolo="alert">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif