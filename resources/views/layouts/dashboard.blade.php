@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img 
                    src="{{ 
                    $user->imagen ? asset('perfiles') . '/' . $user->imagen : 
                    asset('img/usuario.svg') }}" 
                    alt="imagen usuario" />
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{route('perfil.index')}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                  </svg>                    
                            </a>
                        @endif
                    @endauth                  
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">Followers</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Following</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count()}}
                    <span class="font-normal">Posts</span>
                </p>
                @auth
                    @if($user->id !== auth()->user()->id )
                        <form action="{{ route('users.follow', $user) }}" method="post">
                            @csrf
                            <input type="submit" class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Follow"/>
                        </form>
                        <form action="" method="POST">
                            @csrf
                            <input type="submit" class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Unfollow"/>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">
            Posts
        </h2>
        @if ($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['user' => $user, 'post' => $post])}}">
                        <img src="{{ asset('uploads'). '/' . $post->imagen }}" alt="imagen del post {{ $post->titulo }}"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{$posts->links()}}
        </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">There's no Posts yet</p>

        @endif
    </section>


@endsection