<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-pink-500 rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Editar Foto de {{ $pet->name }}
                </h2>
            </div>
            <a href="{{ route('pets.show', $pet) }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        Editar foto de {{ $pet->name }}
                    </h3>
                </div>

                <form action="{{ route('pet-posts.update', [$pet, $post]) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Foto Atual -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Foto Atual
                        </label>
                        <div class="mt-2">
                            <img src="{{ $post->photo_url }}" 
                                 alt="{{ $post->title ?: 'Foto de ' . $pet->name }}" 
                                 class="w-full h-64 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>
                    </div>

                    <!-- Upload de Nova Foto -->
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nova Foto (Opcional)
                        </label>
                        <div class="mt-2">
                            <input type="file" 
                                   id="photo" 
                                   name="photo" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 dark:file:bg-pink-900 dark:file:text-pink-300">
                            <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF, WEBP até 2MB. Deixe em branco para manter a foto atual.</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Título do Post -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Título
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $post->title) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-pink-500 dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 rounded-md shadow-sm"
                               placeholder="Ex: Brincando no parque">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descrição do Post -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Descrição
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4" 
                                  class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-pink-500 dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 rounded-md shadow-sm"
                                  placeholder="Conte o que está acontecendo na foto...">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-between pt-4">
                        <form action="{{ route('pet-posts.destroy', [$pet, $post]) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Tem certeza que deseja excluir esta foto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Excluir Foto
                            </button>
                        </form>

                        <div class="flex space-x-4">
                            <a href="{{ route('pets.show', $pet) }}" 
                               class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-lg transition-colors duration-200">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                                Salvar Alterações
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
