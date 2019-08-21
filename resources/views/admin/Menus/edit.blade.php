<h3>Edit menu: {{ $menuItems->name }}</h3>
<form action="admin/Menu/menus/update/{{$menuItems->id}}" method="POST" class="form-group">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
    <label for="name">Name of items</label>
    <input type="text" name="name" id="nameItems" class="form-control" value="{{$menuItems->name}}">
    <label for="name">Slug this items</label>
    <input type="text" name="slug" id="slugItems" class="form-control" value="{{$menuItems->slug}}">
    <label for="name">Parent menu items</label>
    <select name="parent_id" class="form-control" id="parent_id">
        <option value="0">-----------------------------------------------------------------</option>
        @foreach($menu as $key=>$value)
        <option @if($menuItems->parent_id == $value->id) selected @endif value="{{ $value->id }}">{{$value->name}}</option>
        @endforeach
    </select>
    <label for="name">Level of menu(1.Header; 2.footer; 3.Sidebar)</label>
    <select name="level" class="form-control" id="">
        <option @if($menuItems->level == 1) selected @endif value="1">Headers</option>
        <option @if($menuItems->level == 2) selected @endif  value="2">Footers</option>
        <option @if($menuItems->level == 3) selected @endif  value="3">Sidebar</option>
    </select>
    <label for="name">Status</label>
    <select name="status" class="form-control" id="">
        <option @if($menuItems->status == 1) selected @endif  value="1">Active</option>
        <option @if($menuItems->status == 0) selected @endif  value="0">De Active</option>
    </select>
    <label for="name">Sort number</label>
    <input type="number" name="sort" class="form-control" value="{{ $menuItems->sort }}">
    <label for="name">Info items</label>
    <textarea name="info" id="info" class="form-control" cols="30" rows="10">{{$menuItems->info}}</textarea>
    <input type="submit" name="submit" value="Edit items" class="btn btn-success">
</form>
