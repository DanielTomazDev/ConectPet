<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                🐕 Cadastrar Pet
            </h2>
            <a href="{{ route('pets.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-md transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-white">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl rounded-2xl border border-gray-200 dark:border-gray-700">
                <!-- Header do Formulário -->
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-8 text-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Adicione seu Companheiro!</h2>
                    <p class="text-purple-100 text-lg">Preencha os detalhes do seu pet para começar a conectar.</p>
                </div>

                <!-- Formulário -->
                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <!-- Seção de Informações Básicas -->
                    <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner border border-gray-100 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-3 text-pink-500"></i> Informações Básicas
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nome do Pet <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" required value="{{ old('name') }}">
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Idade (anos) <span class="text-red-500">*</span></label>
                                <input type="number" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" required min="0" max="30" value="{{ old('age') }}">
                                @error('age') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo <span class="text-red-500">*</span></label>
                                <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="dog" {{ old('type') == 'dog' ? 'selected' : '' }}>🐕 Cachorro</option>
                                    <option value="cat" {{ old('type') == 'cat' ? 'selected' : '' }}>🐱 Gato</option>
                                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>🐾 Outro</option>
                                </select>
                                @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gênero <span class="text-red-500">*</span></label>
                                <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" required>
                                    <option value="">Selecione o gênero</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>♂️ Macho</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>♀️ Fêmea</option>
                                </select>
                                @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label for="breed" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Raça (Opcional)</label>
                                <input type="text" name="breed" id="breed" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" value="{{ old('breed') }}">
                                @error('breed') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Seção de Foto e Bio -->
                    <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-xl shadow-inner border border-gray-100 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-camera mr-3 text-purple-500"></i> Foto e Biografia
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Foto de Perfil (Opcional)</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100" onchange="previewImage(event)">
                                @error('profile_picture') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                <div class="mt-4">
                                    <img id="image-preview" src="#" alt="Pré-visualização da Imagem" class="hidden w-32 h-32 object-cover rounded-full border-2 border-purple-300 shadow-md">
                                </div>
                            </div>
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biografia (Opcional)</label>
                                <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" placeholder="Conte um pouco sobre seu pet...">{{ old('bio') }}</textarea>
                                @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botão de Envio -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-bold rounded-full shadow-lg text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-plus-circle mr-3"></i> Cadastrar Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('image-preview');
                    output.src = reader.result;
                    output.classList.remove('hidden');
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    @endpush
</x-app-layout>