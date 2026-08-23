<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->paginate(10);

        return view('admin.users.admusers', compact('usuarios'));
    }

    
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($usuario->id)],
            'cpf' => ['required', 'string', 'max:255', Rule::unique('users', 'cpf')->ignore($usuario->id)],
            'phone' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'saldo' => 'required|numeric|min:0',
            'cep' => 'nullable|string|max:9',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:20',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:2',
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

        $usuario->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);

        abort_if(
            $usuario->id === $request->user()->id,
            403,
            'Você não pode excluir sua própria conta por aqui.'
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
            ->with('success', 'Usuário excluído com sucesso!');
    }
}