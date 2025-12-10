<!DOCTYPE html>
<html lang="id">
<head>
    <title>Register - Smart Infusion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

<div class="card shadow p-4" style="width: 400px;">
    <h3 class="text-center mb-4">DAFTAR AKUN</h3>

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success w-100">DAFTAR SEKARANG</button>
    </form>
    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Sudah punya akun? Login</a>
    </div>
</div>

</body>
</html>