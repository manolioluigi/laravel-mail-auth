@extends('layouts.admin')
@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Elenco tipi</h2>
                    </div>
                    <div>
                        <a href="{{route('admin.types.create')}}" class="btn btn-sm btn-primary ">Aggiungi tipo</a>
                    </div>
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>Azioni</th>
                    </thead>
                    <tbody>
                        
                        @foreach ($types as $type)
                            
                            <tr>
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                <td>{{$type->slug}}</td>
                                <td>
                                    <a href="{{route('admin.types.show', $type->slug)}}" class="btn btn-sm btn-primary btn-square">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection