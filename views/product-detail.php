<?php include 'header.php'; ?>

    <!-- Chi tiết sản phẩm -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-0">
                                <i class="fas fa-box"></i> Chi tiết sản phẩm
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
                    <!-- Product Information -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['name']); ?>"
                                 style="max-width: 100%; max-height: 300px; border-radius: 10px;">
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <p class="form-control-plaintext">
                                    <span class="badge badge-info"><?php echo htmlspecialchars($product['id']); ?></span>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tên sản phẩm</label>
                                <p class="form-control-plaintext">
                                    <strong style="font-size: 1.3rem;">
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </strong>
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Giá bán</label>
                                <p class="form-control-plaintext">
                                    <span class="badge bg-success" style="font-size: 1.1rem;">
                                        <?php echo number_format($product['price'], 0, ',', '.'); ?> ₫
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Mô tả sản phẩm</label>
                        <div class="card" style="background-color: #f8f9fa;">
                            <div class="card-body">
                                <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between gap-2">
                        <div>
                            <a href="index.php?page=product-list" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                        <div>
                            <a href="index.php?page=product-edit&id=<?php echo $product['id']; ?>" 
                               class="btn btn-warning">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="index.php?page=product-delete&id=<?php echo $product['id']; ?>" 
                               class="btn btn-danger btn-delete">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

