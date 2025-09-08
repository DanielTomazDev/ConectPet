<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\PetMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PetController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar apenas os pets do usuário logado
        $pets = Pet::where('user_id', Auth::id())->with('user')->latest()->paginate(12);
        $totalPets = Pet::where('user_id', Auth::id())->count();
        $totalUsers = User::count();
        $totalMatches = PetMatch::count();
        
        return view('pets.index', compact('pets', 'totalPets', 'totalUsers', 'totalMatches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:0|max:30',
                'breed' => 'nullable|string|max:255',
                'type' => 'required|in:dog,cat,other',
                'gender' => 'required|in:male,female',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string|max:1000',
            ]);

            $data = $request->all();
            $data['user_id'] = Auth::id();

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('pets', $filename, 'public');
                $data['profile_picture'] = $path;
            }

            Pet::create($data);

            return redirect('/pets')->with('success', 'Pet cadastrado com sucesso! 🐾');
        } catch (\Exception $e) {
            \Log::error('PetController store error: ' . $e->getMessage());
            return redirect('/pets')->with('error', 'Erro ao cadastrar pet: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        $pet->load(['user', 'posts']);
        
        // Buscar pets compatíveis (mesmo tipo, idade similar)
        $compatiblePets = Pet::where('id', '!=', $pet->id)
            ->where('user_id', '!=', Auth::id())
            ->where('type', $pet->type)
            ->whereBetween('age', [$pet->age - 2, $pet->age + 2])
            ->with('user')
            ->take(6)
            ->get();

        return view('pets.show', compact('pet', 'compatiblePets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);
        return view('pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:30',
            'breed' => 'nullable|string|max:255',
            'type' => 'required|in:dog,cat,other',
            'gender' => 'required|in:male,female',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:1000',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            // Deletar foto antiga
            if ($pet->profile_picture) {
                Storage::disk('public')->delete($pet->profile_picture);
            }

            $file = $request->file('profile_picture');
            $filename = Str::slug($request->name) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pets', $filename, 'public');
            $data['profile_picture'] = $path;
        }

        $pet->update($data);

        return redirect()->route('pets.show', $pet)->with('success', 'Pet atualizado com sucesso! 🐾');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        // Deletar foto do pet
        if ($pet->profile_picture) {
            Storage::disk('public')->delete($pet->profile_picture);
        }

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet removido com sucesso! 🐾');
    }

    /**
     * Like a pet (criar match)
     */
    public function like(Pet $pet)
    {
        try {
            // Verificar se já existe like
            $existingLike = \App\Models\PetLike::where('user_id', Auth::id())
                ->where('pet_id', $pet->id)
                ->first();

            if (!$existingLike) {
                // Curtir o pet
                \App\Models\PetLike::create([
                    'user_id' => Auth::id(),
                    'pet_id' => $pet->id,
                ]);

                // Verificar se é match mútuo (apenas se o usuário tiver pets)
                $userPet = Auth::user()->pets()->first();
                if ($userPet && $userPet->id != $pet->id) {
                    $mutualLike = \App\Models\PetLike::where('user_id', $pet->user_id)
                        ->where('pet_id', $userPet->id)
                        ->first();

                    if ($mutualLike) {
                        // Verificar se o match já existe antes de criar
                        $existingMatch = \App\Models\PetMatch::where(function($query) use ($userPet, $pet) {
                            $query->where('pet1_id', $userPet->id)->where('pet2_id', $pet->id);
                        })->orWhere(function($query) use ($userPet, $pet) {
                            $query->where('pet1_id', $pet->id)->where('pet2_id', $userPet->id);
                        })->first();

                        if (!$existingMatch) {
                            // Criar match
                            \App\Models\PetMatch::create([
                                'pet1_id' => $userPet->id,
                                'pet2_id' => $pet->id,
                            ]);
                        }
                    }
                }

                return response()->json([
                    'success' => true, 
                    'message' => 'Pet curtido! ❤️',
                    'liked' => true,
                    'like_count' => $pet->likes()->count()
                ]);
            } else {
                // Descurtir o pet
                $existingLike->delete();
                
                return response()->json([
                    'success' => true, 
                    'message' => 'Curtida removida! 💔',
                    'liked' => false,
                    'like_count' => $pet->likes()->count()
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('Erro ao curtir pet: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor. Tente novamente.'
            ], 500);
        }
    }

    /**
     * Add a comment to a pet
     */
    public function comment(Request $request, Pet $pet)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comment = $pet->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user_name' => $comment->user->name,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }
}
