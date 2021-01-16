@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Indentifação da mesa:</label>
    <input type="text" name="identify" id="identify" class="form-control" placeholder="Identificação da mesa:" value="{{$table->identify ?? old('identify')}}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" id="" cols="30" rows="5"  class="form-control">{{$table->description ?? old('description')}}</textarea>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>