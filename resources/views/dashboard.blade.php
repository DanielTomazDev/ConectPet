<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Feed da Comunidade') }}
                </h2>
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('d/m/Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                        <div>
                            <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $petsCount }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Meus Pets</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalPets }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Total de Pets</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalUsers }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Usuários</p>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $totalMatches }}</div>
                            <p class="text-gray-600 dark:text-gray-400 font-semibold">Matches</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instagram-like Feed -->
            <div class="space-y-6">
                @if($allPosts->count() > 0)
                    @foreach($allPosts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Post Header -->
                        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ substr($post->pet->user->name ?? 'U', 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $post->pet->user->name ?? 'Usuário' }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 text-sm font-semibold rounded-full">
                                    {{ ucfirst($post->pet->type) }}
                                </span>
                                @if($post->pet->user_id === auth()->id())
                                <div class="relative">
                                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors duration-200">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Post Image -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 dark:bg-gray-700">
                            <img src="{{ $post->photo_url }}" alt="{{ $post->title ?: 'Foto de ' . $post->pet->name }}" class="w-full h-96 object-cover">
                        </div>

                        <!-- Post Info -->
                        <div class="p-4">
                            <div class="mb-3">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->pet->name }}</h2>
                                
                                @if($post->title)
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ $post->title }}</h3>
                                @endif
                                
                                @if($post->description)
                                    <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $post->description }}</p>
                                @endif
                                
                                <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                    <span><strong>Idade:</strong> {{ $post->pet->age }} anos</span>
                                    <span><strong>Raça:</strong> {{ $post->pet->breed ?? 'Não informada' }}</span>
                                    <span><strong>Gênero:</strong> {{ ucfirst($post->pet->gender) }}</span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-4">
                                    <button onclick="togglePostLike({{ $post->id }})" class="flex items-center space-x-2 hover:opacity-75 transition-opacity duration-200">
                                        <svg id="like-icon-{{ $post->id }}" class="w-6 h-6 text-gray-500 hover:text-red-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        <span id="like-count-{{ $post->id }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $post->likes_count }}</span>
                                    </button>
                                    
                                    <button onclick="focusComment({{ $post->id }})" class="flex items-center space-x-2 hover:opacity-75 transition-opacity duration-200">
                                        <svg class="w-6 h-6 text-gray-500 hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Comentar</span>
                                    </button>
                                </div>
                                
                                <a href="{{ route('pets.show', $post->pet) }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium">
                                    Ver Perfil
                                </a>
                            </div>

                            <!-- Comments Section -->
                            <div id="comments-{{ $post->id }}" class="border-t border-gray-200 dark:border-gray-600 pt-4">
                                <div class="space-y-3 mb-4" id="comments-list-{{ $post->id }}">
                                    <!-- Comentários serão implementados futuramente -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="flex justify-center mt-8">
                        {{ $allPosts->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-12">
                            <div class="w-24 h-24 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                                Nenhum post ainda
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">
                                Que tal postar algumas fotos dos seus pets para compartilhar com a comunidade?
                            </p>
                            <a href="{{ route('pets.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
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
    </div>

    <!-- JavaScript for interactions -->
    <script>
        function toggleLike(petId) {
            fetch(`/pets/${petId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update heart color and count based on server response
                    const heartIcon = document.getElementById('like-icon-' + petId);
                    const likeCount = document.getElementById('like-count-' + petId);
                    
                    if (data.liked) {
                        // Like - make heart red and filled
                        heartIcon.classList.remove('text-gray-500');
                        heartIcon.classList.add('text-red-500', 'fill-current');
                        heartIcon.setAttribute('fill', 'currentColor');
                    } else {
                        // Unlike - make heart gray and outline
                        heartIcon.classList.remove('text-red-500', 'fill-current');
                        heartIcon.classList.add('text-gray-500');
                        heartIcon.setAttribute('fill', 'none');
                    }
                    
                    // Update like count
                    likeCount.textContent = data.like_count;
                    
                    // Show success message briefly
                    console.log(data.message);
                } else {
                    console.error('Error:', data.message);
                    alert('Erro: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro ao curtir o pet');
            });
        }

        function focusComment(petId) {
            document.getElementById('comment-input-' + petId).focus();
        }

        function addComment(petId) {
            const input = document.getElementById('comment-input-' + petId);
            const comment = input.value.trim();
            
            if (comment) {
                fetch(`/pets/${petId}/comment`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ comment: comment })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Add comment to the list
                        const commentsList = document.getElementById('comments-list-' + petId);
                        const commentHtml = `
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            <span class="font-semibold">{{ auth()->user()->name }}:</span> ${data.comment.comment}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">${data.comment.created_at}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        commentsList.insertAdjacentHTML('beforeend', commentHtml);
                        input.value = '';
                    } else {
                        alert('Erro ao adicionar comentário');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Erro ao adicionar comentário');
                });
            }
        }

        // Add Enter key support for comments
        document.addEventListener('DOMContentLoaded', function() {
            const commentInputs = document.querySelectorAll('[id^="comment-input-"]');
            commentInputs.forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        const petId = this.id.split('-')[2];
                        addComment(petId);
                    }
                });
            });
        });
    </script>
</x-app-layout>