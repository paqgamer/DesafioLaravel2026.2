<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   

    public function index(Request $request)
    {
        $produtos = Product::with('category')
            ->when(! $request->user()->is_admin, function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->latest()
            ->paginate(10);

        $categorias = Category::all();

        return view('admin.products.admproducts', compact('produtos', 'categorias'));
    }

    
    
    public function create()
    {

    return redirect()->route('admin.products.index');
    }

 
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        $validated['image_url'] = $request->file('image')->store('products', 'public');
        unset($validated['image']);

        $validated['user_id'] = $request->user()->id;

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    
    public function show(string $id)
    {
        //
    }

   
    
    public function edit(string $id)
    {
        //
    }

   
    
    public function update(Request $request, string $id)
    {
        $produto = Product::findOrFail($id);

        abort_if(
            ! $request->user()->is_admin && $produto->user_id !== $request->user()->id,
            403,
            'Você não tem permissão para editar este produto.'
        );

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'nullable|string',
        ]);


        if ($request->hasFile('image')) {
            if ($produto->image_url) {
                $this->deleteImageIfUnused($produto->image_url, $produto->id);
            }
            $validated['image_url'] = $request->file('image')->store('products', 'public');
        }

        unset($validated['image']);
        $produto->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }


    private function deleteImageIfUnused(string $imagePath, ?int $exceptId = null): void
    {
        $aindaUsada = Product::where('image_url', $imagePath)
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->exists();
 
        if (! $aindaUsada && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

        public function destroy(Request $request, string $id)
    {
        $produto = Product::findOrFail($id);
        $imageUrl = $produto->image_url;

        abort_if(
            ! $request->user()->is_admin && $produto->user_id !== $request->user()->id,
            403,
            'Você não tem permissão para excluir este produto.'
        );
 
        try {
            $produto->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Não é possível excluir este produto: ele já foi vendido e faz parte do histórico de pedidos.');
        }
 
        if ($imageUrl) {
            $this->deleteImageIfUnused($imageUrl);
        }
 
        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produto excluído com sucesso!');
    }

}