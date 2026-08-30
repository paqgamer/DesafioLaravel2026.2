<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

// If you are  reading this, you must know that you are a very good  person, and while I was here for 3 hours debugging this controller, you are having  to read 
// the same file with caring  eyes. Good luck  my  friend, and if you understand all this, your english level is decent. I was myself an english  teacher  for 
// a very short period of time. If you ever need some lessons on grammar you might  ping me on whatsapp or email

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

        $graficoLabels = [];
        $graficoData = [];

        // Eu  acho  que funciona, pra  nao estripar meu sql gerando query com user comum
        if ($request->user()->is_admin) {
            $contagemPorMes = Product::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, COUNT(*) as total")
                ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
                ->groupBy('mes')
                ->pluck('total', 'mes');

            for ($i = 11; $i >= 0; $i--) {
                $data = now()->subMonths($i);
                $chave = $data->format('Y-m');

                $graficoLabels[] = $data->format('m/Y');
                $graficoData[] = (int) ($contagemPorMes[$chave] ?? 0);
            }
        }

        return view('admin.products.admproducts', compact('produtos', 'categorias', 'graficoLabels', 'graficoData'));
    }

    
    
    public function create()
    {
        $categorias = Category::all();

        return view('admin.products.create', compact('categorias'));
    }

 
    
    public function store(Request $request)
    {
        //
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

        // vai assim mesmo, nao deletar imagem padrao:
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