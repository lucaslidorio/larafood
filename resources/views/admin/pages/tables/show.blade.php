@extends('adminlte::page')

@section('title', 'Detalhes da Mesa')

@section('content_header')
<h1>Detalhes da Mesa <b> {{$table->identify}} </b> </h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <strong>Idenficador da Mesa:</strong> {{$table->identify}}
            </li>
            
            <li>
                <strong>Descrição:</strong> {{$table->description}}
            </li>
           
        </ul>
        @include('admin.includes.alerts')
        <form action="{{route('tables.destroy', $table->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Excluir Mesa {{$table->identify}} </button>
        </form>
    </div>

    @endsection