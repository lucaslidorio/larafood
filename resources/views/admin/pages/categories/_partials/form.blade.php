@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="Nome:" value="{{$category->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="price">Descrição:</label>
    <textarea name="description" id="" cols="30" rows="5"  class="form-control">{{$category->description ?? old('description')}}</textarea>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>