<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Meu Perfil') }}
                </h2>
            </div>
            <a href="{{ route('profile.edit') }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Editar Perfil
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Card principal do perfil -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-8">
                <!-- Header do perfil -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-12">
                    <div class="flex items-center space-x-6">
                        <!-- Foto de perfil -->
                        <div class="relative group">
                            @if($user->profile_picture)
                                <img src="{{ Storage::url($user->profile_picture) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            @else
                                <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <!-- Indicador online -->
                            <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                            <!-- Overlay para trocar foto -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Informações básicas -->
                        <div class="text-white">
                            <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>
                            <p class="text-indigo-100 text-lg">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Estatísticas -->
                <div class="px-8 py-6 bg-white dark:bg-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Total de Pets -->
                        <div class="text-center p-4 bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900 dark:to-indigo-800 rounded-xl">
                            <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-300 mb-2">{{ $user->pets->count() }}</div>
                            <div class="text-indigo-800 dark:text-indigo-200 font-medium">Pets Cadastrados</div>
                        </div>
                        
                        <!-- Membro desde -->
                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 rounded-xl">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-300 mb-2">{{ $user->created_at->format('M Y') }}</div>
                            <div class="text-purple-800 dark:text-purple-200 font-medium">Membro desde</div>
                        </div>
                        
                        <!-- Última atualização -->
                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-xl">
                            <div class="text-3xl font-bold text-green-600 dark:text-green-300 mb-2">{{ $user->updated_at->diffForHumans() }}</div>
                            <div class="text-green-800 dark:text-green-200 font-medium">Última atualização</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Seção de Biografia -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Sobre Mim
                </h2>
                
                @if($user->bio)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed">{{ $user->bio }}</p>
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 text-center">
                        <p class="text-gray-500 dark:text-gray-400 text-lg mb-4">Você ainda não adicionou uma biografia.</p>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Adicionar Biografia
                        </a>
                    </div>
                @endif
            </div>
            
            <!-- Seção de Pets -->
            @if($user->pets->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Meus Pets
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($user->pets as $pet)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 rounded-xl p-6 hover:shadow-lg transition-all duration-200">
                                @if($pet->profile_picture)
                                    <img src="{{ Storage::url($pet->profile_picture) }}" 
                                         alt="{{ $pet->name }}" 
                                         class="w-full h-32 object-cover rounded-lg mb-4">
                                @else
                                    <div class="w-full h-32 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg mb-4 flex items-center justify-center">
                                        <span class="text-white text-2xl font-bold">
                                            {{ strtoupper(substr($pet->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ $pet->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ ucfirst($pet->type) }} • {{ $pet->age }} anos</p>
                                @if($pet->bio)
                                    <p class="text-gray-700 dark:text-gray-300 text-sm">{{ Str::limit($pet->bio, 80) }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Estado vazio -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-12 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Nenhum pet cadastrado ainda</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Que tal cadastrar seu primeiro pet e começar a conectar com outros animais?</p>
                    <a href="{{ route('pets.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Cadastrar Primeiro Pet
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
