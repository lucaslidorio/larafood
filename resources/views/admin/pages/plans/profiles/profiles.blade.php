@extends('adminlte::page')

@section('title', 'Perfis  do Plano')

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item "><a href="{{route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{route('plans.profiles',$plan->id)}}" class="active">Perfis</a></li>
</ol>
<h1>Perfis  do Plano  <strong> {{$plan->name}} </strong>  </h1>
    <a href="{{route('plans.profiles.available', $plan->id)}}" class="btn btn-dark"> ADD NOVO PERFIL</a>
@stop

@section('content')
<div class="card"> 
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                   
                    <th width="50">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                <tr>
                    <td>
                        {{$profile->name}}
                    </td>
                    
                    <td style="width: 10px;">
                        {{--<a href="{{route('details.plan.index', $plan->url)}}" class=" btn btn-primary"> Detalhes</a>--}}
                     
                        <a href="{{route('plans.profiles.detach', [$plan->id, $profile->id])}}" class=" btn btn-danger"> DESVINCULAR</a>
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