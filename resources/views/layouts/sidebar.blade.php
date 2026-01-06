<li class="nav-item mb-3">
    <a href="{{ route('penalty.edit') }}" class="flex items-center gap-4 group {{ request()->is('admin/penalty-settings*') ? 'active' : '' }}" style="text-decoration: none;">
        <div class="flex items-center justify-center rounded-xl p-2.5 
            {{ request()->is('admin/penalty-settings*') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }} 
            group-hover:bg-blue-600 group-hover:text-white transition-all duration-300" 
            style="width: 45px; height: 45px;">
            <i class="fas fa-exclamation-circle" style="font-size: 1.2rem;"></i>
        </div>
        
        <p class="mb-0 font-semibold {{ request()->is('admin/penalty-settings*') ? 'text-blue-600' : 'text-gray-700' }} group-hover:text-blue-600 transition-colors">
            Pengaturan Denda
        </p>
    </a>
</li>