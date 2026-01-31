<?php include 'header.php'; ?>

    <!-- Form Thêm mới sản phẩm -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-0">
                                <i class="fas fa-plus-circle"></i> Thêm sản phẩm mới
                            </h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="index.php?page=product-list" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="index.php?page=product-store" class="needs-validation">
                        <!-- Tên sản phẩm -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="Nhập tên sản phẩm" required
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            <small class="text-muted">Tên sản phẩm phải duy nhất và rõ ràng</small>
                        </div>

                        <!-- Giá sản phẩm -->
                        <div class="mb-3">
                            <label for="price" class="form-label">
                                Giá bán (đ) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" id="price" name="price" 
                                   placeholder="Nhập giá sản phẩm" required step="0.01" min="0"
                                   value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
                            <small class="text-muted">Giá phải là một số dương</small>
                        </div>

                        <!-- Mô tả sản phẩm -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Mô tả sản phẩm <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="5" placeholder="Nhập mô tả chi tiết về sản phẩm" required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                            <small class="text-muted">Mô tả giúp khách hàng hiểu rõ hơn về sản phẩm</small>
                        </div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                URL Hình ảnh <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="image" name="image" 
                                   placeholder="https://example.com/image.jpg" required
                                   value="<?php echo isset($_POST['image']) ? htmlspecialchars($_POST['image']) : ''; ?>">
                            <small class="text-muted">Đường dẫn đầy đủ của hình ảnh (URL)</small>
                        </div>

                        <!-- Preview Hình ảnh -->
                        <div class="mb-4">
                            <label class="form-label">Xem trước hình ảnh</label>
                            <div id="imagePreview" style="border: 2px dashed #ccc; border-radius: 10px; padding: 20px; text-align: center;">
                                <p class="text-muted">Hình ảnh sẽ xuất hiện ở đây</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between gap-2">
                            <a href="index.php?page=product-list" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Thêm sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview hình ảnh
        document.getElementById('image').addEventListener('change', function() {
            updateImagePreview();
        });

        document.getElementById('image').addEventListener('input', function() {
            updateImagePreview();
        });

        function updateImagePreview() {
            const imageUrl = document.getElementById('image').value;
            const preview = document.getElementById('imagePreview');

            if (imageUrl.trim()) {
                preview.innerHTML = '<img src="' + imageUrl + '" style="max-width: 100%; max-height: 200px; border-radius: 5px;" onerror="this.src=\'https://via.placeholder.com/300?text=Lỗi+tải+ảnh\'">';
            } else {
                preview.innerHTML = '<p class="text-muted">Hình ảnh sẽ xuất hiện ở đây</p>';
            }
        }

        // Trigger preview on page load
        updateImagePreview();
    </script>

