<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-pink-500 rounded-lg shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar ') . $pet->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-8">
                    <form method="POST" action="{{ route('pets.update', $pet) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Pet Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nome do Pet')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $pet->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Pet Type and Gender -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="type" :value="__('Tipo')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-pink-500 dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 rounded-md shadow-sm" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="dog" {{ old('type', $pet->type) == 'dog' ? 'selected' : '' }}>🐕 Cachorro</option>
                                    <option value="cat" {{ old('type', $pet->type) == 'cat' ? 'selected' : '' }}>🐱 Gato</option>
                                    <option value="other" {{ old('type', $pet->type) == 'other' ? 'selected' : '' }}>🐾 Outro</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="gender" :value="__('Gênero')" />
                                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-pink-500 dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 rounded-md shadow-sm" required>
                                    <option value="">Selecione o gênero</option>
                                    <option value="male" {{ old('gender', $pet->gender) == 'male' ? 'selected' : '' }}>♂ Macho</option>
                                    <option value="female" {{ old('gender', $pet->gender) == 'female' ? 'selected' : '' }}>♀ Fêmea</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Age and Breed -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="age" :value="__('Idade (anos)')" />
                                <x-text-input id="age" name="age" type="number" min="0" max="30" class="mt-1 block w-full" :value="old('age', $pet->age)" required />
                                <x-input-error :messages="$errors->get('age')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="breed" :value="__('Raça (opcional)')" />
                                <x-text-input id="breed" name="breed" type="text" class="mt-1 block w-full" :value="old('breed', $pet->breed)" />
                                <x-input-error :messages="$errors->get('breed')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Current Profile Picture -->
                        @if($pet->profile_picture)
                            <div>
                                <x-input-label :value="__('Foto Atual')" />
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $pet->profile_picture) }}" alt="{{ $pet->name }}" class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                                </div>
                            </div>
                        @endif

                        <!-- Profile Picture -->
                        <div>
                            <x-input-label for="profile_picture" :value="__('Nova Foto do Pet')" />
                            <input id="profile_picture" name="profile_picture" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 dark:file:bg-pink-900 dark:file:text-pink-200 dark:hover:file:bg-pink-800" />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Deixe em branco para manter a foto atual. Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB</p>
                        </div>

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" :value="__('Sobre o Pet (opcional)')" />
                            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-pink-500 dark:focus:border-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600 rounded-md shadow-sm" placeholder="Conte um pouco sobre a personalidade, gostos e características do seu pet...">{{ old('bio', $pet->bio) }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Máximo 1000 caracteres</p>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-between">
                            <form method="POST" action="{{ route('pets.destroy', $pet) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este pet? Esta ação não pode ser desfeita.')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    Excluir Pet
                                </button>
                            </form>

                            <div class="flex space-x-4">
                                <a href="{{ route('pets.show', $pet) }}" class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                    Cancelar
                                </a>
                                <x-primary-button class="bg-pink-500 hover:bg-pink-600 focus:bg-pink-600 active:bg-pink-700">
                                    {{ __('Salvar Alterações') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
