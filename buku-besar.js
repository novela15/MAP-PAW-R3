let categoriesData = [];
const colorPattern = ['color-1', 'color-2', 'color-3'];

const grid = document.getElementById('categoryGrid');
const searchInput = document.getElementById('categorySearch');

document.addEventListener('DOMContentLoaded', function() {
    if (categoriesData.length === 0) {
        renderPlaceholder();
    } else {
        renderCategories();
    }
    setupSearch();
});

function renderPlaceholder() {
    grid.innerHTML = '';
    for (let i = 0; i < 12; i++) {
        const box = createBox({
            id: i + 1,
            name: 'Nama Kategori',
            colorClass: colorPattern[i % 3]
        }, true);
        grid.appendChild(box);
    }
}

function renderCategories(filterText = '') {
    grid.innerHTML = '';
    const filtered = categoriesData.filter(cat => 
        cat.name.toLowerCase().includes(filterText.toLowerCase())
    );
    
    if (filtered.length === 0 && categoriesData.length === 0) {
        renderPlaceholder();
        return;
    }
    
    filtered.forEach((cat, index) => {
        const box = createBox({
            id: cat.id,
            name: cat.name,
            colorClass: colorPattern[index % 3]
        }, false);
        grid.appendChild(box);
    });
}

function createBox(data, isPlaceholder) {
    const box = document.createElement('a');
    box.className = `category-box ${data.colorClass}`;
    box.href = '#';
    box.dataset.id = data.id;
    box.dataset.name = data.name;
    
    const displayName = isPlaceholder ? 'Nama Kategori' : data.name;
    box.innerHTML = `<span class="category-name">${displayName}</span>`;
    
    box.addEventListener('click', function(e) {
        e.preventDefault();
        console.log(`Navigate to: buku-besar-${data.name.toLowerCase().replace(/\s+/g, '-')}.html`);
        this.style.transform = 'translateY(-2px) scale(0.98)';
        setTimeout(() => this.style.transform = '', 150);
    });
    
    return box;
}

function setupSearch() {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.trim();
        if (categoriesData.length > 0) {
            renderCategories(searchTerm);
        } else {
            const boxes = grid.querySelectorAll('.category-box');
            boxes.forEach(box => {
                if (searchTerm === '' || 'nama kategori'.includes(searchTerm.toLowerCase())) {
                    box.classList.remove('hidden');
                } else {
                    box.classList.add('hidden');
                }
            });
        }
    });
}

// Public API Kategori Anggaran
window.BukuBesarContainer = {
    setData: function(data) {
        categoriesData = data.map((cat, index) => ({
            id: cat.id,
            name: cat.name,
            colorIndex: index % 3
        }));
        renderCategories(searchInput.value.trim());
    },
    
    add: function(category) {
        const newIndex = categoriesData.length;
        categoriesData.push({
            id: category.id,
            name: category.name,
            colorIndex: newIndex % 3
        });
        renderCategories(searchInput.value.trim());
    },
    
    remove: function(id) {
        categoriesData = categoriesData.filter(c => c.id !== id);
        categoriesData.forEach((cat, index) => cat.colorIndex = index % 3);
        renderCategories(searchInput.value.trim());
    },
    
    update: function(id, newName) {
        const cat = categoriesData.find(c => c.id === id);
        if (cat) {
            cat.name = newName;
            renderCategories(searchInput.value.trim());
        }
    },
    
    getData: function() {
        return [...categoriesData];
    }
};