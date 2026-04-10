from django.shortcuts import render, redirect, get_object_or_404
from .models import Producto

def index(request):
    if request.method == 'POST':
        # Caso A: Crear Producto Nuevo
        if 'crear_producto' in request.POST:
            Producto.objects.create(
                codigo=request.POST.get('codigo'),
                descripcion=request.POST.get('descripcion'),
                costo=request.POST.get('costo'),
                entradas=request.POST.get('inicial', 0)
            )
        
        # Caso B: Registrar Movimiento
        elif 'actualizar_stock' in request.POST:
            producto = get_object_or_404(Producto, codigo=request.POST.get('codigo_mov'))
            cantidad = int(request.POST.get('cantidad'))
            tipo = request.POST.get('tipo')
            
            if tipo == 'entrada':
                producto.entradas += cantidad
            else:
                producto.salidas += cantidad
            producto.save()
            
        return redirect('reporte')
        
    return render(request, 'inventario/index.html')

def reporte(request):
    productos = Producto.objects.all()
    total = sum(p.valor_inventario for p in productos)
    return render(request, 'inventario/reporte.html', {'productos': productos, 'total': total})

