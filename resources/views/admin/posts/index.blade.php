@extends('layouts.admin')
@section('title', 'Posts')
@section('content')
<div class="container ">
<main class="py-4">
        <a class="btn btn-primary" href="{{ route('admin.home') }}">Home</a>
        <a class="btn btn-secondary" href="{{route('admin.posts.index')}}">Tutti i post</a>
        <a class="btn btn-secondary" href="{{route('admin.posts.myindex')}}">I miei post</a>

    </main>
    <div class="row ">
        <div class="col-2 mt-5 pt-5">
            {{-- @dd($tags) --}}
            <form action="" method="get">
                <div class="mt-2"
                    <label for="search-string" class="form-label"></label>
                    <input type="text" class="form-control" id="search-string" name="search" value="">
                </div>
                <select class="mt-2 form-select"  name="category" id="category">
                    <option value="" selected>Seleziona una categoria</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $request->category) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select class="mt-2 form-select"  name="user" id="user">
                    <option value="" selected>Seleziona un utente</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if($user->id == $request->user) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>

                <button class="btn mt-3 btn-primary">Applica filtri</button>
            </form>
        </div>
        <div class="col-10 mt-5 pt-5">
            <table class="table col-lg-5">
                <thead>
                  <tr>
                    <th class="text-center"  scope="col">Title</th>
                    <th class="text-center"  scope="col">Created</th>
                    <th class="text-center"  scope="col">Author</th>
                    <th class="text-center"  scope="col">Category</th>
                    <th class="text-center"  scope="col">Tags</th>
                    <th class="text-center"  scope="col" colspan="2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                  <tr data-title="{{$post->title}}" data-id="{{ $post->slug }}">
                    <th scope="row">{{$post->title}}</th>
                    <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>
                    <td class="text-center" >{{ $post->tags->pluck('name')->join(', ') }}</td>
                    </td>
                    <td  class="text-center">
                        <a href="{{route('admin.posts.show', $post->slug)}}" class="me-1 btn btn-primary">Apri</a>
                    </td>
                    <td>
                        @if ($post->user_id === Auth::user()->id)
                        <a href="{{route('admin.posts.edit', $post->slug)}}" class="btn btn-primary">Modifica</a>
                        @endif
                        @if ($post->user_id === Auth::user()->id)
                        <button class="btn-delete btn btn-danger" type="submit">Elimina</button>
                        @else
                        <div class="text-center text-secondary text-opacity-50" >Nessuna azione disponibile su questo post</div>
                        @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row justify-content-center">
        <a href="{{route('admin.posts.create')}}" class="col-lg-2 btn btn-primary my-5">Aggiungi post</a>
        <div class="pages">
            {{$posts->links()}}
        </div>
    </div>
</div>
<div class="d-none" id="popup">
    <div class="message">
        <div class="row justify-content-center ">
            <div class="mt-3 text-center">Sei sicuro di voler eliminare questo post?</div>
            <div id="title" class="mb-4 text-center fs-4"></div>
            <button id="btn-si" class="btn-danger btn col-2 mx-2 mb-3">Si</button>
            <a href="" class="btn btn-primary col-2 mx-2 mb-3">No</a>
            <form class="" id="form-delete" data-base="{{ route('admin.posts.destroy', '*****') }}" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection

