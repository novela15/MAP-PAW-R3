// js/buku-besar.js - LENGKAP & FIX

document.addEventListener('DOMContentLoaded', function() {
    console.log('=== APP STARTED ===');
    
    // ==========================================
    // ELEMENT SELECTION
    // ==========================================
    const sidebar = document.querySelector('.sidebar');
    const container = document.querySelector('.container');
    const submenuToggle = document.querySelector('.has-submenu');
    const submenu = document.querySelector('.submenu');
    const submenuIcon = document.querySelector('.submenu-icon');
    const allSidebarButtons = document.querySelectorAll('.sidebar-button');
    const menuToggle = document.querySelector('.fa-bars')?.parentElement;
    const addButton = document.querySelector('.fa-plus-circle')?.parentElement;
    const categorySearch = document.querySelector('.category-search');
    const searchButton = document.querySelector('.search-button');
    const categoryCards = document.querySelectorAll('.category-card');
    
    // ==========================================
    // 1. SUBMENU TOGGLE
    // ==========================================
    if (submenuToggle && submenu) {
        // Cek apakah ada submenu aktif
        const hasActiveSubmenu = submenu.querySelector('.selected-sidebar-button');
        if (!hasActiveSubmenu) {
            submenu.style.display = 'none';
            submenuIcon.style.transform = 'rotate(0deg)';
        } else {
            submenuIcon.style.transform = 'rotate(90deg)';
        }
        
        submenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isHidden = submenu.style.display === 'none';
            submenu.style.display = isHidden ? 'block' : 'none';
            submenuIcon.style.transform = isHidden ? 'rotate(90deg)' : 'rotate(0deg)';
            
            console.log('Submenu:', isHidden ? 'opened' : 'closed');
        });
    }
    
    // ==========================================
    // 2. SIDEBAR NAVIGATION
    // ==========================================
    allSidebarButtons.forEach(button => {
        // Skip submenu toggle
        if (button.classList.contains('has-submenu')) return;
        
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const buttonText = this.textContent.trim();
            console.log('Menu clicked:', buttonText);
            
            // Hapus selected dari semua button
            allSidebarButtons.forEach(btn => {
                btn.classList.remove('selected-sidebar-button');
            });
            
            // Tambah selected ke yang diklik
            this.classList.add('selected-sidebar-button');
            
            // Update header
            updateHeaderTitle(buttonText);
            
            // Handle menu spesifik
            handleMenuAction(buttonText);
        });
    });
    
    function updateHeaderTitle(title) {
        // Cari header di horizontal-flex
        const headers = document.querySelectorAll('.subcontainer .container-header');
        headers.forEach(header => {
            // Update yang bukan "Laporan" (title utama)
            if (!header.closest('.horizontal-flex')?.previousElementSibling) {
                header.textContent = title;
            }
        });
    }
    
    function handleMenuAction(menuName) {
        switch(menuName) {
            case 'Keluar':
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    showNotification('Sedang logout...', 'info');
                    setTimeout(() => {
                        window.location.href = '/login.html';
                    }, 1000);
                } else {
                    // Reset selection kalau cancel
                    allSidebarButtons.forEach(btn => btn.classList.remove('selected-sidebar-button'));
                    // Kembalikan ke Buku Besar (default)
                    const defaultBtn = Array.from(allSidebarButtons).find(b => 
                        b.textContent.includes('Buku Besar')
                    );
                    if (defaultBtn) defaultBtn.classList.add('selected-sidebar-button');
                }
                break;
                
            case 'Buku Anggaran':
            case 'Kategori Anggaran':
            case 'Akun Anggaran':
            case 'Catat Belanja':
            case 'Tutup Buku':
                showNotification(`Membuka: ${menuName}`, 'success');
                break;
                
            case 'Jurnal Umum':
            case 'Buku Besar':
            case 'Realisasi Anggaran':
                showNotification(`Membuka laporan: ${menuName}`, 'success');
                break;
                
            default:
                console.log('Menu:', menuName);
        }
    }
    
    // ==========================================
    // 3. SIDEBAR TOGGLE (MOBILE)
    // ==========================================
    if (menuToggle && sidebar && container) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-collapsed');
            container.classList.toggle('container-expanded');
        });
    }
    
    // ==========================================
    // 4. ADD NEW BUTTON
    // ==========================================
    if (addButton) {
        addButton.addEventListener('click', function() {
            showModal('Tambah Data Baru', `
                <form id="add-form">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nama Kategori</label>
                        <input type="text" id="new-category-name" placeholder="Masukkan nama kategori" 
                            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tipe</label>
                        <select style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                            <option value="pemasukan">Pemasukan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="button" class="modal-cancel" style="padding: 0.75rem 1.5rem; border: 1px solid #ddd; background: white; border-radius: 8px; cursor: pointer;">Batal</button>
                        <button type="submit" style="padding: 0.75rem 1.5rem; background: #90C1BE; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">Simpan</button>
                    </div>
                </form>
            `);
        });
    }
    
    // ==========================================
    // 5. CATEGORY SEARCH
    // ==========================================
    function filterCategories(query) {
        const lowerQuery = query.toLowerCase();
        let visibleCount = 0;
        
        categoryCards.forEach(card => {
            const name = card.querySelector('.category-name').textContent.toLowerCase();
            const isMatch = name.includes(lowerQuery);
            
            card.style.display = isMatch ? 'flex' : 'none';
            card.style.opacity = isMatch ? '1' : '0';
            
            if (isMatch) visibleCount++;
        });
        
        return visibleCount;
    }
    
    if (categorySearch) {
        categorySearch.addEventListener('input', function() {
            filterCategories(this.value);
        });
        
        categorySearch.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const count = filterCategories(this.value);
                if (count === 0) {
                    showNotification('Kategori tidak ditemukan', 'error');
                }
            }
        });
    }
    
    if (searchButton && categorySearch) {
        searchButton.addEventListener('click', function() {
            const count = filterCategories(categorySearch.value);
            if (count === 0) {
                showNotification('Kategori tidak ditemukan', 'error');
            }
        });
    }
    
    // ==========================================
    // 6. CATEGORY CARDS
    // ==========================================
    categoryCards.forEach((card, index) => {
        card.addEventListener('click', function(e) {
            const categoryName = this.querySelector('.category-name').textContent;
            console.log('Card clicked:', categoryName);
            
            // Ripple effect
            createRipple(this, e);
            
            // Action
            showNotification(`Membuka kategori: ${categoryName}`, 'success');
        });
    });
    
    function createRipple(element, event) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = event.clientX - rect.left - size / 2;
        const y = event.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }
    
    // ==========================================
    // 7. UTILITY FUNCTIONS
    // ==========================================
    window.showNotification = function(message, type = 'info') {
        const colors = {
            success: '#10B981',
            error: '#EF4444',
            info: '#3B82F6',
            warning: '#F59E0B'
        };
        
        const notif = document.createElement('div');
        notif.className = `notification ${type}`;
        notif.style.background = colors[type] || colors.info;
        notif.textContent = message;
        
        document.body.appendChild(notif);
        
        setTimeout(() => {
            notif.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => notif.remove(), 300);
        }, 3000);
    };
    
    window.showModal = function(title, content) {
        const overlay = document.createElement('div');
        overlay.className = 'modal-overlay';
        
        overlay.innerHTML = `
            <div class="modal-content">
                <button class="modal-close">&times;</button>
                <h2 style="margin-bottom: 1.5rem; color: #1f2937; font-size: 1.25rem;">${title}</h2>
                ${content}
            </div>
        `;
        
        document.body.appendChild(overlay);
        
        // Close handlers
        const closeBtn = overlay.querySelector('.modal-close');
        const cancelBtn = overlay.querySelector('.modal-cancel');
        
        const closeModal = () => overlay.remove();
        
        closeBtn?.addEventListener('click', closeModal);
        cancelBtn?.addEventListener('click', closeModal);
        
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) closeModal();
        });
        
        // Form submit
        const form = overlay.querySelector('form');
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const input = form.querySelector('#new-category-name');
                const name = input?.value || 'Data baru';
                showNotification(`${name} berhasil disimpan!`, 'success');
                closeModal();
            });
        }
    };
    
    // ==========================================
    // 8. KEYBOARD SHORTCUTS
    // ==========================================
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K = focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            categorySearch?.focus();
        }
        
        // Escape = close modal or clear search
        if (e.key === 'Escape') {
            const modal = document.querySelector('.modal-overlay');
            if (modal) {
                modal.remove();
            } else if (categorySearch) {
                categorySearch.value = '';
                filterCategories('');
            }
        }
    });
    
    console.log('=== APP READY ===');
});