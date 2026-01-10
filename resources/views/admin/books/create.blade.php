<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Soft Pastel Gradient Background */
        .premium-bg {
            background: linear-gradient(135deg, #fef3f3 0%, #fef7f3 25%, #fef9f3 50%, #f3fef6 75%, #f3f9fe 100%);
            min-height: 100vh;
            position: relative;
        }

        .premium-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 30%, rgba(251, 207, 232, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(196, 229, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Enhanced Glassmorphism Card */
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid rgba(255, 255, 255, 0.8);
            box-shadow:
                0 8px 32px rgba(31, 38, 135, 0.08),
                0 2px 8px rgba(31, 38, 135, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            position: relative;
        }

        /* Floating Input with Soft Colors */
        .saas-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, #fce7f3, #dbeafe) border-box;
        }

        .saas-input:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -8px rgba(219, 234, 254, 0.5);
        }

        .saas-input:focus {
            background: white !important;
            border-color: transparent !important;
            box-shadow:
                0 0 0 4px rgba(251, 207, 232, 0.15),
                0 12px 24px -8px rgba(219, 234, 254, 0.4) !important;
            transform: translateY(-2px);
        }

        /* Soft Gradient Pill Buttons */
        .category-checkbox:checked+.pill-btn {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fb923c 100%);
            color: white;
            border-color: transparent;
            box-shadow:
                0 4px 12px -2px rgba(251, 191, 36, 0.4),
                0 2px 6px -2px rgba(245, 158, 11, 0.3);
            transform: translateY(-2px);
        }

        .pill-btn {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #f1f5f9;
            background: white;
            box-shadow: 0 2px 8px -2px rgba(100, 116, 139, 0.08);
        }

        .pill-btn:hover:not(.category-checkbox:checked + .pill-btn) {
            background: linear-gradient(135deg, #fef3f3, #fef9f3);
            border-color: #fde68a;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgba(251, 191, 36, 0.2);
        }

        /* Smooth Upload Zone with Soft Colors */
        .dropzone-area {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            border: 3px dashed #e0e7ff;
            border-radius: 2rem;
            position: relative;
            overflow: hidden;
        }

        .dropzone-area::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(252, 231, 243, 0.3), rgba(219, 234, 254, 0.3));
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .dropzone-area:hover {
            border-color: #fbbf24;
            transform: translateY(-4px);
            box-shadow: 0 12px 32px -8px rgba(251, 191, 36, 0.25);
        }

        .dropzone-area:hover::before {
            opacity: 1;
        }

        /* Submit Button with Soft Gradient */
        .submit-btn {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #fb923c 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #fb923c 0%, #f59e0b 50%, #fbbf24 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .submit-btn:hover::before {
            opacity: 1;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px -8px rgba(251, 191, 36, 0.5);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        /* Icon Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .upload-icon {
            animation: float 3s ease-in-out infinite;
        }

        /* Header Decoration */
        .header-decoration {
            position: relative;
            display: inline-block;
        }

        .header-decoration::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 4px;
            background: linear-gradient(90deg, transparent, #fbbf24, transparent);
            border-radius: 2px;
        }

        /* Preview Overlay Enhancement */
        #preview-overlay {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .preview-container {
            position: relative;
            transition: all 0.3s ease;
        }

        .preview-container:hover {
            transform: scale(1.02);
        }

        .preview-overlay-hover {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.9), rgba(245, 158, 11, 0.9));
        }
    </style>

    <div class="py-12 premium-bg">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" style="position: relative; z-index: 1;">

            <div class="mb-10 text-center">
                <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-3 header-decoration">
                    Tambah Buku Baru
                </h2>
                <p class="text-slate-500 font-medium text-lg">Kelola koleksi digital kamu dengan elegan</p>
            </div>

            <div class="glass-panel rounded-[3rem] p-10 md:p-14">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf

                    <div class="space-y-3">
                        <label for="title" class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600 ml-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                            </svg>
                            Judul Koleksi
                        </label>
                        <input id="title" name="title" type="text"
                            class="saas-input block w-full rounded-2xl bg-white py-5 px-8 text-lg font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Contoh: The Art of Minimalist Design" required />
                    </div>

                    <div class="space-y-3">
                        <label for="author"
                            class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600 ml-1">
                            Author
                        </label>

                        <input
                            id="author"
                            name="author"
                            type="text"
                            required
                            class="saas-input block w-full rounded-2xl bg-white py-5 px-8 text-lg font-semibold text-slate-700"
                            placeholder="Masukkan nama penulis"
                            value="{{ old('author') }}" />
                    </div>


                    <div class="space-y-4">
                        <label class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600 ml-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                            </svg>
                            Kategori Buku
                        </label>
                        <div class="flex flex-wrap gap-3">
                            @foreach($categories as $category)
                            <label class="relative cursor-pointer group">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" class="hidden category-checkbox">
                                <span class="pill-btn inline-flex items-center px-7 py-3 rounded-full text-sm font-bold text-slate-600 transition-all">
                                    {{ $category->name }}
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label for="stock" class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600 ml-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                            </svg>
                            Stock Buku
                        </label>

                        <input
                            id="stock"
                            name="stock"
                            type="number"
                            min="0"
                            value="0"
                            required
                            class="saas-input block w-full rounded-2xl bg-white py-5 px-8 text-lg font-semibold text-slate-700 placeholder-slate-400"
                            placeholder="Masukkan jumlah stok buku" />
                    </div>


                    <div class="space-y-4">
                        <label class="text-xs font-bold uppercase tracking-[0.2em] text-amber-600 ml-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                            Cover Visual
                        </label>
                        <div class="dropzone-area relative flex flex-col items-center justify-center w-full h-64 cursor-pointer">
                            <label class="flex flex-col items-center justify-center w-full h-full relative z-10">
                                <div class="bg-gradient-to-br from-amber-50 to-orange-50 p-5 rounded-2xl shadow-sm mb-4 upload-icon">
                                    <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                <span class="text-slate-700 font-bold text-lg mb-1">Pilih Sampul Buku</span>
                                <span class="text-slate-400 text-sm font-medium">Format: PNG, JPG (Maks. 2MB)</span>
                                <input id="cover_image" name="cover_image" type="file" accept="image/*" class="hidden" onchange="previewImage(this)" />
                            </label>

                            <div id="preview-overlay" class="absolute inset-0 bg-gradient-to-br from-white/95 to-slate-50/95 hidden items-center justify-center p-6">
                                <div class="relative group preview-container">
                                    <img id="img-preview" class="h-56 w-auto rounded-2xl shadow-2xl object-cover border-4 border-white">
                                    <div class="absolute inset-0 preview-overlay-hover rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                        <div class="text-center text-white">
                                            <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-bold text-sm uppercase tracking-widest">Ganti Gambar</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-6 pt-4">
                        <button type="submit" class="submit-btn relative w-full text-white font-black py-5 px-10 rounded-2xl shadow-xl transition-all tracking-widest text-sm uppercase overflow-hidden">
                            <span class="relative z-10 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Simpan Koleksi
                            </span>
                        </button>
                        <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-rose-400 font-bold text-sm transition tracking-widest uppercase flex items-center gap-2 group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.querySelector('#img-preview');
            const overlay = document.querySelector('#preview-overlay');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>