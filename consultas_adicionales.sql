SELECT nombre, stock FROM `productos` ORDER BY stock DESC LIMIT 1;
SELECT nombre, stock FROM productos WHERE stock = (SELECT MAX(stock) FROM productos);
SELECT productos.nombre as nombre_producto, COUNT(ventas.producto_id) as total_compras FROM ventas JOIN productos ON ventas.producto_id = productos.id GROUP BY ventas.producto_id ORDER BY total_compras DESC LIMIT 1;
