<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->paginate(10);

        return view('admin.users.admusers', compact('usuarios'));
    }

    public function create()
    {

    return redirect()->route('admin.users.index');
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'cpf' => 'required|string|max:255|unique:users,cpf',
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'saldo' => 'required|numeric|min:0',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'complement' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('avatars', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = false;
        $validated['email_verified_at'] = now(); 

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário criado com sucesso!');
    }


    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'cpf' => ['required', 'string', 'max:255', Rule::unique('users', 'cpf')->ignore($usuario->id)],
            'phone' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'saldo' => 'required|numeric|min:0',
            'cep' => 'required|string|max:9',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'complement' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($usuario->photo && Storage::disk('public')->exists($usuario->photo)) {
                Storage::disk('public')->delete($usuario->photo);
            }
            $validated['photo'] = $request->file('photo')->store('avatars', 'public');
        } else {
            unset($validated['photo']);
        }

        $isAdmin = $request->boolean('is_admin');

       
        abort_if(
            $usuario->id === $request->user()->id && ! $isAdmin,
            403,
            'Você não pode remover seu próprio privilégio de administrador, E por favor não insista.'
        );

        $validated['is_admin'] = $isAdmin;

        $usuario->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'UAU!, o usuário foi atualizado com sucesso! Quem diria??');
    } 
    //será que alguém ta realmente lendo isso  aqui????

    public function destroy(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        abort_if(
            $usuario->id === $request->user()->id,
            403,
            'Você não pode excluir sua própria conta por aqui.'
            // se quiser pode sim
        );

        try {
            $usuario->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Não é possível excluir este usuário: ele possui produtos já vendidos vinculados ao histórico de pedidos.');
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário desintegrado com sucesso!');
    }
}