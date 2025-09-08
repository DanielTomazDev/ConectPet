<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    🐾 Meus Pets
                </h2>
            </div>
            <a href="{{ route('pets.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Cadastrar Pet
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Header -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                        <div>
                            <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $totalPets }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Meus Pets</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalUsers }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Usuários</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalMatches }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Matches</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pets Listing -->
            @if($pets->count() > 0)
            <div class="mb-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Meus Pets Cadastrados
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Gerencie seus pets cadastrados na plataforma!
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($pets as $pet)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                        <!-- Pet Photo -->
                        <div class="aspect-w-16 aspect-h-12 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900 dark:to-teal-900">
                            @if($pet->profile_picture)
                                <img src="{{ Storage::url($pet->profile_picture) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Pet Info -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $pet->name }}</h3>
                                <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 text-sm font-semibold rounded-full">
                                    {{ ucfirst($pet->type) }}
                                </span>
                            </div>

                            <div class="space-y-2 mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">Idade:</span> {{ $pet->age }} anos
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">Raça:</span> {{ $pet->breed ?? 'Não informada' }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-semibold">Gênero:</span> {{ ucfirst($pet->gender) }}
                                </p>
                            </div>

                            @if($pet->bio)
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 line-clamp-2">
                                {{ Str::limit($pet->bio, 100) }}
                            </p>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('pets.show', $pet) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded-lg text-sm font-semibold transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Ver
                                </a>
                                
                                @if(auth()->id() == $pet->user_id)
                                <a href="{{ route('pets.edit', $pet) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center py-2 px-4 rounded-lg text-sm font-semibold transition-colors duration-200">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar
                                </a>
                                
                                <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="flex-1" onsubmit="return confirm('Tem certeza que deseja excluir este pet?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 px-4 rounded-lg text-sm font-semibold transition-colors duration-200">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Excluir
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    {{ $pets->links() }}
                </div>
            </div>
            @else
            <div class="text-center">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-12">
                    <div class="w-24 h-24 bg-gradient-to-r from-emerald-100 to-teal-100 dark:from-emerald-900 dark:to-teal-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                        Nenhum pet cadastrado ainda
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Seja o primeiro a cadastrar um pet na nossa comunidade!
                    </p>
                    <a href="{{ route('pets.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Cadastrar Primeiro Pet
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>