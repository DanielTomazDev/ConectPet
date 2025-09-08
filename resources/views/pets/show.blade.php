<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-pink-500 rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $pet->name }}
                </h2>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('pets.index') }}" class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-lg transition-colors duration-200">
                    Voltar
                </a>
                @if($pet->user_id === Auth::id())
                    <a href="{{ route('pets.edit', $pet) }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        Editar
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Pet Profile Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="md:flex">
                    <!-- Pet Image -->
                    <div class="md:w-1/2">
                        <div class="h-64 md:h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center">
                            @if($pet->profile_picture)
                                <img src="{{ asset('storage/' . $pet->profile_picture) }}" alt="{{ $pet->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Pet Info -->
                    <div class="md:w-1/2 p-8">
                        <div class="flex items-center space-x-3 mb-4">
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $pet->name }}</h1>
                            <div class="flex space-x-2">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if($pet->type === 'dog') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @elseif($pet->type === 'cat') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200
                                    @endif">
                                    @if($pet->type === 'dog') 🐕 Cachorro
                                    @elseif($pet->type === 'cat') 🐱 Gato
                                    @else 🐾 Outro
                                    @endif
                                </span>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    @if($pet->gender === 'male') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                    @else bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200
                                    @endif">
                                    @if($pet->gender === 'male') ♂ Macho
                                    @else ♀ Fêmea
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-600 dark:text-gray-300">{{ $pet->age }} anos</span>
                                </div>
                                @if($pet->breed)
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-300">{{ $pet->breed }}</span>
                                    </div>
                                @endif
                            </div>

                            @if($pet->bio)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Sobre {{ $pet->name }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $pet->bio }}</p>
                                </div>
                            @endif

                            <!-- Owner Info -->
                            <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Dono(a)</p>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $pet->user ? $pet->user->name : 'Usuário não encontrado' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            @if($pet->user_id !== Auth::id())
                                <div class="flex space-x-3">
                                    <button onclick="likePet({{ $pet->id }})" class="flex-1 bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span>Curtir</span>
                                    </button>
                                    <button class="bg-gray-100 dark:bg-gray-600 hover:bg-gray-200 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center space-x-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span>Mensagem</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compatible Pets -->
            @if($compatiblePets->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>Pets Compatíveis</span>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($compatiblePets as $compatiblePet)
                                <a href="{{ route('pets.show', $compatiblePet) }}" class="block bg-gray-50 dark:bg-gray-700 rounded-lg p-4 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                    <div class="flex items-center space-x-3">
                                        @if($compatiblePet->profile_picture)
                                            <img src="{{ asset('storage/' . $compatiblePet->profile_picture) }}" alt="{{ $compatiblePet->name }}" class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $compatiblePet->name }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($compatiblePet->type) }} • {{ $compatiblePet->age }} anos</p>
                                        </div>
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Seção de Posts do Pet -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                        <svg class="w-5 h-5 text-pink-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Fotos de {{ $pet->name }}
                    </h3>
                    @if($pet->user_id === Auth::id())
                        <a href="{{ route('pet-posts.create', $pet) }}" 
                           class="inline-flex items-center px-4 py-2 bg-pink-500 hover:bg-pink-600 text-white text-sm font-medium rounded-lg transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nova Foto
                        </a>
                    @endif
                </div>
            </div>

            @if($pet->posts->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pet->posts as $post)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-200">
                                <div class="relative">
                                    <img src="{{ $post->photo_url }}" 
                                         alt="{{ $post->title ?: 'Foto de ' . $pet->name }}" 
                                         class="w-full h-48 object-cover">
                                    
                                    @if($pet->user_id === Auth::id())
                                        <div class="absolute top-2 right-2 flex space-x-1">
                                            <a href="{{ route('pet-posts.edit', [$pet, $post]) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition-colors duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('pet-posts.destroy', [$pet, $post]) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir esta foto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-4">
                                    @if($post->title)
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h4>
                                    @endif
                                    
                                    @if($post->description)
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">{{ Str::limit($post->description, 100) }}</p>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                        <span>{{ $post->likes_count }} curtidas</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Nenhuma foto postada ainda</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Que tal compartilhar algumas fotos fofas de {{ $pet->name }}?</p>
                    @if($pet->user_id === Auth::id())
                        <a href="{{ route('pet-posts.create', $pet) }}" 
                           class="inline-flex items-center px-6 py-3 bg-pink-500 hover:bg-pink-600 text-white font-medium rounded-lg transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Postar Primeira Foto
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function likePet(petId) {
            fetch(`/pets/${petId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    showNotification(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erro ao curtir pet', 'error');
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
    @endpush
</x-app-layout>
