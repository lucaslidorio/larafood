@extends('adminlte::page')

@section('title', 'Cargos disponiveis')

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Usuários</a></li>
</ol>
<h1>Cargos disponiveis para o cargo <strong> {{$user->name}} </strong> </h1>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('users.roles.available', $user->id)}}" method="POST" class=" form form-inline">
            @csrf
            <input type="text" name="filter" id="filter" placeholder="Filtro" class="form-control"
                value="{{$filters['filter'] ?? ''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>

        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th width="50px">#</th>
                    <th>Nome</th>

                </tr>
            </thead>
            <tbody>
                <form action="{{route('users.roles.attach', $user->id)}}" method="POST">
                    @csrf
                    @foreach ($roles as $role)
                    <tr>
                        <td>
                            <input type="checkbox" name="roles[]" value="{{$role->id}}" id="role">
                        </td>
                        <td>
                            {{$role->name}}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))

        {!! $roles->appends($filters)->links()!!}


        @else

        {!! $roles->links()!!}

        @endif



    </div>
</div>
@stop