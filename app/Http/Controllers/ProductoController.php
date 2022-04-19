<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($all)
    {
        $productos = $all == 1 ? Producto::all() : Producto::paginate(10);
        $masStock = DB::table('productos')
            ->orderBy('stock', 'desc')
            ->limit(1)
            ->get();
        $masVendido = DB::table('ventas')
            ->selectRaw('productos.nombre as nombre_producto, COUNT(ventas.producto_id) as total_compras')
            ->join('productos', 'ventas.producto_id', 'productos.id')
            ->orderBy('total_compras', 'desc')
            ->groupBy('ventas.producto_id')
            ->limit(1)
            ->get();
        return response()->json([
            'productos' => $productos,
            'stock' => $masStock,
            'venta' => $masVendido
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->referencia = $request->referencia;
        $producto->precio = $request->precio;
        $producto->peso = $request->peso;
        $producto->categoria = $request->categoria;
        $producto->stock = $request->stock;
        $producto->save();

        return response()->json([
            'producto' => $producto
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return response()->json([
            'producto' => $producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->referencia = $request->referencia;
        $producto->precio = $request->precio;
        $producto->peso = $request->peso;
        $producto->categoria = $request->categoria;
        $producto->stock = $request->stock;
        $producto->save();

        return response()->json([
            'producto' => $producto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->delete();

        return response()->json([
            'producto' => $producto
        ]);
    }
}
