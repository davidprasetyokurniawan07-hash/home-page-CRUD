function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('open');
    overlay.classList.toggle('show');
}

function showToast(message, type = 'info', duration = 3500) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    const icons = { success: '✅', error: '❌', info: 'ℹ️', warning: '⚠️' };
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<span>${icons[type] || icons.info}</span> <span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(20px)';
        toast.style.transition = '0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

function openModal(id) {
    const el = document.getElementById(id);
    if (el) el.classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    const el = document.getElementById(id);
    if (el) el.classList.remove('show');
    document.body.style.overflow = '';
}

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('show');
        document.body.style.overflow = '';
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.show').forEach(m => {
            m.classList.remove('show');
        });
        document.body.style.overflow = '';
    }
});


function confirmDelete(url, name) {
    if (confirm(`Hapus "${name}"?\n\nData ini tidak dapat dipulihkan.`)) {
        window.location.href = url;
    }
}


function tableSearch(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    if (!input || !table) return;
    input.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
}

function globalSearchFn(value) {
    if (value.length > 2) {}
}

function formatRupiah(num) {
    return 'Rp ' + Number(num).toLocaleString('id-ID');
}

document.addEventListener('DOMContentLoaded', function() {
    const flash = document.querySelector('.alert');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transition = '0.5s ease';
            setTimeout(() => flash.remove(), 500);
        }, 4000);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const path = window.location.pathname;
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') && path.endsWith(link.getAttribute('href').replace(/.*\//, ''))) {
            link.classList.add('active');
        }
    });
});