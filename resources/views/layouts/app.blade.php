<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Devstagram - @yield('title')</title>

    <!-- Fonts -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

	<header class="p-5 border-b bg-white">
		<div class="container mx-auto flex justify-between items-center">
			<h1 class="text-3xl font-black">DevStagram</h1>

			{{-- Comprobar que un usuario esta logeado --}}
			{{-- @if (auth()->user())
				<p>Autenticado</p>
			@else
				<p>No autenticado</p>
			@endif --}}

			@auth
				<nav class="flex ">
					<a class="font-bold text-gray-600 text-sm" href="/">Hi: {{ auth()->user()->username }}</a>
					{{-- <a class="font-bold uppercase text-gray-600 text-sm" href="/logout">Log out</a> --}}
					<form method="post" action="{{ route('logout') }}">
						@csrf
						<button type="submit" class="font-bold uppercase text-gray-600 text-sm">
							Log out
						</button>
					</form>
				</nav>
			@endauth

			{{-- Directiva para verificar si no se esta autenticado --}}
			@guest
				<nav>
					<a class="font-bold uppercase text-gray-600 text-sm" href="/">Login</a>
					<a class="font-bold uppercase text-gray-600 text-sm" href="/register">Crear cuenta</a>
				</nav>
			@endguest

		</div>
	</header>

	<main class="container mx-auto mt-10">
		<h2 class="font-black text-center text-3xl mb-10">
			@yield('title')
		</h2>
		@yield('content')
	</main>

	<footer class="text-center p-5 text-gray-500 font-bold uppercase">
		Devstagram - Todos los derechos reservados {{ now()->year }}
	</footer>

</body>
</html>

