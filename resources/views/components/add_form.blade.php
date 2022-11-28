<form method="post" action="/add/{{$slot}}">
    @csrf
    <label for="category_input"> {{ucfirst($slot)}} name</label>
    <input type="text" name="name" id="category_input">
    <button type="submit">add</button>
</form>
