<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda TIC81 | Daniel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { border: none; border-radius: 15px; transition: 0.3s; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .navbar { background: #111; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark shadow-sm mb-5">
        <div class="container">
            <span class="navbar-brand fw-bold">DVC STORE</span>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light btn-sm">Panel Admin</a>
        </div>
    </nav>

    <div class="container">
        <header class="text-center mb-5">
            <h1 class="display-4 fw-bold">Catálogo de Productos</h1>
            <p class="text-muted">Proyecto Daniel - Relaciones Muchos a Muchos</p>
        </header>

        <div class="row">
            @forelse($products as $product)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            @foreach($product->categories as $cat)
                                <span class="badge bg-primary me-1">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                        <h5 class="card-title fw-bold text-uppercase">{{ $product->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 50) }}</p>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0 fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
                            <button class="btn btn-dark btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-dark p-5">Aún no hay productos. Ve al panel administrativo.</div>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>