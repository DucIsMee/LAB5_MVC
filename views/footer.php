</div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 LAB 5 MVC - Quản Lý Sản Phẩm | Designed with <i class="fas fa-heart text-danger"></i> by Developer</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xác nhận trước khi xóa
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>