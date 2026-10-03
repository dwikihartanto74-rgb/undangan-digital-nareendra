<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Aqiqah Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Quicksand', sans-serif; }</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-100 via-sky-50 to-blue-200 flex items-center justify-center p-4">

<div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-baby text-white text-3xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-blue-900">Admin Panel</h1>
        <p class="text-blue-500 text-sm mt-1">Aqiqah Digital</p>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-xl font-bold text-gray-700 mb-6">Masuk ke Panel Admin</h2>

        @if($errors->any())
        <div class="mb-4 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            <i class="fas fa-exclamation-circle mr-1"></i>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-envelope text-blue-400 mr-1"></i> Email
                </label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all bg-gray-50"
                    placeholder="admin@admin.com">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-2">
                    <i class="fas fa-lock text-blue-400 mr-1"></i> Password
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all bg-gray-50"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-400">Default: admin@admin.com / password</p>
        </div>
    </div>
</div>

</body>
</html>
