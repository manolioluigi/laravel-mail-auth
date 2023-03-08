@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Dettaglio tipo {{$type->name}} ({{$type->slug}})</h2>
                    </div>
                    <div>
                        <a href="{{route('admin.types.index')}}" class="btn btn-sm btn-primary">Torna all'elenco</a>
                    </div>
                </div>
            </div>

            <hr>

            <div class="col-12">
                <h2>Progetti appartenenti a questo tipo:</h2>

                <div class="row">
                    @forelse ($type->projects as $project)
                        <div class="col-3 col-md-3 my-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{$project->title}}</h5>
                                    <p>{{$project->content}}</p>
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.posts.show', $project->slug)}}" class="btn btn-sm btn-square btn-primary">Continua a leggere</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h5 class="text-center">Non ci sono post di questo tipo</h5>
                    @endforelse
                </div>
                
            </div>
        </div>
    </div>

@endsection