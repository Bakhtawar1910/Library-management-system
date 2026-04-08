    </main> <!-- closes .container from header -->

    <footer class="site-footer mt-auto">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            <div>
                <div class="footer-brand">Archive Library</div>
                <div class="footer-meta">Library Management System</div>
            </div>
            <div class="text-muted">Crafted for clean, consistent cataloging.</div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme) {
                document.documentElement.setAttribute('data-theme', storedTheme);
            }
            const toggle = document.getElementById('themeToggle');
            if (toggle) {
                const updateIcon = () => {
                    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                    const icon = toggle.querySelector('i');
                    if (icon) {
                        icon.className = isDark ? 'bi bi-sun' : 'bi bi-moon-stars';
                    }
                };
                updateIcon();
                toggle.addEventListener('click', () => {
                    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
                    const nextTheme = isDark ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', nextTheme);
                    localStorage.setItem('theme', nextTheme);
                    updateIcon();
                });
            }
        })();

        // Global confirm delete with SweetAlert
        function confirmDelete(id) {
            Swal.fire({
                title: 'Permanently remove?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--primary)',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                background: 'var(--surface)',
                color: 'var(--text-dark)',
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-outline-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete.php?id=' + id;
                }
            });
        }

        // Optional: auto-hide URL message params after SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const msg = urlParams.get('msg');
            if (msg) {
                let title, text, icon;
                switch(msg) {
                    case 'added': title = 'Added!'; text = 'Book cataloged successfully.'; icon = 'success'; break;
                    case 'updated': title = 'Updated!'; text = 'Changes saved.'; icon = 'success'; break;
                    case 'deleted': title = 'Deleted!'; text = 'Book removed.'; icon = 'success'; break;
                    case 'error': title = 'Error'; text = 'Something went wrong.'; icon = 'error'; break;
                }
                Swal.fire({ title, text, icon, confirmButtonColor: 'var(--primary)' }).then(() => {
                    const url = new URL(window.location);
                    url.searchParams.delete('msg');
                    window.history.replaceState({}, document.title, url);
                });
            }
        });
    </script>
</body>
</html>