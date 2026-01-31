<?php include 'header.php'; ?>

    <!-- Danh sách sản phẩm -->
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-0">
                        <i class="fas fa-list"></i> 
                        <?php echo $search ? 'Kết quả tìm kiếm' : 'Danh sách sản phẩm'; ?>
                    </h5>
                </div>
                <div class="col-md-4 text-end">
                    <a href="index.php?page=product-add" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Thêm mới
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Search Box -->
            <div class="search-box">
                <form method="GET" action="index.php" class="input-group">
                    <input type="hidden" name="page" value="product-search">
                    <input type="text" name="q" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm..." 
                           value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Tìm
                    </button>
                    <?php if ($search): ?>
                        <a href="index.php?page=product-list" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Table -->
            <?php if (count($products) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="20%">Tên sản phẩm</th>
                                <th width="12%">Giá</th>
                                <th width="15%">Hình ảnh</th>
                                <th width="30%">Mô tả</th>
                                <th width="18%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-info"><?php echo htmlspecialchars($product['id']); ?></span>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">
                                            <?php echo number_format($product['price'], 0, ',', '.'); ?> ₫
                                        </span>
                                    </td>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                             alt="<?php echo htmlspecialchars($product['name']); ?>"
                                             style="max-width: 80px; max-height: 60px; border-radius: 5px;">
                                    </td>
                                    <td>
                                        <small><?php echo htmlspecialchars(substr($product['description'], 0, 50)); ?>...</small>
                                    </td>
                                    <td>
                                        <a href="index.php?page=product-detail&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-info btn-sm" title="Chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?page=product-edit&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-warning btn-sm" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="index.php?page=product-delete&id=<?php echo $product['id']; ?>" 
                                           class="btn btn-danger btn-sm btn-delete" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <p class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        Tổng số sản phẩm: <strong><?php echo count($products); ?></strong>
                    </p>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h5>Không có sản phẩm nào</h5>
                    <p class="text-muted">
                        <?php echo $search ? 'Không tìm thấy sản phẩm phù hợp' : 'Hãy thêm sản phẩm mới'; ?>
                    </p>
                    <a href="index.php?page=product-add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm sản phẩm đầu tiên
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

