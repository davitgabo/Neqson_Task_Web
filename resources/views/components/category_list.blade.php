<ul>
    @foreach($categories as $category)
        <li> {{$category->name}} </li>

        <div class="manipulations">
            <form action="/edit/{{$title}}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$category->id}}">
                <input type="text" name="name">
                <button type="submit">edit</button>
            </form>
            <form action="/delete/{{$title}}/{{$category->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">delete</button>
            </form>
        </div>

    @endforeach
</ul>
