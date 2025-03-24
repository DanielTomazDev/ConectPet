@extends('layouts.app')
@section('title', 'Listagem de Usuários')
@section('body')

<div class="container mx-auto p-6 dark:bg-cyan-100">
        <h1 class="text-2xl font-bold mb-6">Painel de Controle - Usuários</h1>
        <div class="bg-white p-4 rounded shadow-md">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Nome</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Pets</th>
                        <th class="border p-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border hover:bg-gray-50">
                            <td class="border p-2 text-center">{{ $user->id }}</td>
                            <td class="border p-2">{{ $user->name }}</td>
                            <td class="border p-2">{{ $user->email }}</td>
                            <td class="border p-2">{{ $user->pet_id }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Editar</a>
                                |
                                <form action="{{ route('profile.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection