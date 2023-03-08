@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Elenco tecnologie</h2>
                    </div>
                    <div>
                        <a href="{{route('admin.technologies.create')}}" class="btn btn-sm btn-primary ">Aggiungi tecnologia</a>
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
                        
                        @foreach ($technologies as $technology)
                            
                            <tr>
                                <td>{{$technology->id}}</td>
                                <td>{{$technology->name}}</td>
                                <td>{{$technology->slug}}</td>
                                <td>
                                    <a href="{{route('admin.technologies.show', $technology->slug)}}" class="btn btn-sm btn-primary btn-square">
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