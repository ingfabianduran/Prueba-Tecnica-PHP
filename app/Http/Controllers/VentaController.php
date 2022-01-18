<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cantidadProductoSolicitado = $request->cantidad_producto;
        $producto = Producto::find($request->producto_id);

        if ($producto->stock > $cantidadProductoSolicitado) {
            // Registro de la venta:
            $venta = new Venta();
            $venta->producto_id = $request->producto_id;
            $venta->cantidad_producto = $request->cantidad_producto;
            $venta->save();
            // Actualizacion del stock:
            $producto->stock = $producto->stock - $cantidadProductoSolicitado;
            $producto->save();
            return response()->json([
                'status' => true,
                'message' => 'Venta realizada correctamente'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No hay stock del producto selecciondado'
            ]);
        }
    }
}
