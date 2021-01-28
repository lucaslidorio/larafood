@include('admin.includes.alerts')

<div class="form-group">
    <label for="title">* Nome:</label>
    <input type="text" name="name" id="title" class="form-control" placeholder="Título:" value="{{$tenant->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="title">Logo:</label>
    <input type="file" name="logo" id="logo" class="form-control" >
    </div>
<div class="form-group">
    <label for="title">* E-mail:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail:" value="{{$tenant->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="title">* CNPJ:</label>
    <input type="number" name="cnpj" id="number" class="form-control" placeholder="CNPJ:" value="{{$tenant->cnpj ?? old('cnpj')}}">
</div>

<div class="form-group">
    <label for="">* Ativo?</label>
    <select name="active" id="" class="form-control">
        <option value="Y" @if(isset($tenant) && $tenant->active =='Y') selected @endif>SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active =='N') selected @endif>Não</option>
    </select>
</div>
<div class="form-group">
    <label for="">Expira (final):</label>
    <input type="expires_at" name="expires_at" class="form-control" placeholder="Expira" value="{{$tenant->expires_at}}">
</div>
<div class="form-group">
    <label for="">Identificador:</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador" value="{{$tenant->uuid}}">
</div>

<div class="form-group">
    <label for="">* Assinatura Ativa?</label>
    <select name="subscription_active" id="" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_active) selected @endif >SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_active) selected @endif >NÃO</option>
    </select>
</div>
<div class="form-group">
    <label for="">* Assinatura Cancelada?</label>
    <select name="subscription_suspended" id="" class="form-control">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif>SIM</option>
        <option value="0" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif>Não</option>
    </select>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>