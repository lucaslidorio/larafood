
@extends('adminlte::page')

@section('title', ' Perfis da Permissão')

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('permissions.index')}}">Perfis</a></li>
</ol>
<h1>Perfis da Permissão  <strong> {{$permission->name}} </strong>  </h1>
@stop

@section('content')
<div class="card"> 
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                   
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                <tr>
                    <td>
                        {{$profile->name}}
                    </td>
                    
                    <td style="width: 10px;">
                        {{--<a href="{{route('details.permission.index', $permission->url)}}" class=" btn btn-primary"> Detalhes</a>--}}
                     
                        <a href="{{route('profiles.permissions.detach', [$profile->id, $permission->id])}}" class=" btn btn-danger"> DESVINCULAR</a>
                     </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $profiles->appends($filters)->links()!!}
        @else
        {!! $profiles->links()!!}
        @endif
    </div>
</div>
@stop