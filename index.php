<?php
session_start();

// Autoload files
require_once 'app/Models/BaseModel.php';
require_once 'app/Models/Product.php';
require_once 'app/Controllers/ProductController.php';

// Xử lý routing
$page = isset($_GET['page']) ? $_GET['page'] : 'product-list';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($page) {
    // Danh sách sản phẩm
    case 'product-list':
        $controller = new ProductController();
        $controller->index();
        break;

    // Xem chi tiết sản phẩm
    case 'product-detail':
        if ($id) {
            $controller = new ProductController();
            $controller->show($id);
        } else {
            header("Location: index.php?page=product-list");
        }
        break;

    // Hiển thị form thêm mới
    case 'product-add':
        $controller = new ProductController();
        $controller->create();
        break;

    // Xử lý lưu sản phẩm mới
    case 'product-store':
        $controller = new ProductController();
        $controller->store();
        break;

    // Hiển thị form cập nhật
    case 'product-edit':
        if ($id) {
            $controller = new ProductController();
            $controller->edit($id);
        } else {
            header("Location: index.php?page=product-list");
        }
        break;

    // Xử lý cập nhật sản phẩm
    case 'product-update':
        if ($id) {
            $controller = new ProductController();
            $controller->update($id);
        } else {
            header("Location: index.php?page=product-list");
        }
        break;

    // Xóa sản phẩm
    case 'product-delete':
        if ($id) {
            $controller = new ProductController();
            $controller->destroy($id);
        } else {
            header("Location: index.php?page=product-list");
        }
        break;

    // Tìm kiếm sản phẩm
    case 'product-search':
        $controller = new ProductController();
        $controller->search();
        break;

    default:
        header("Location: index.php?page=product-list");
        break;
}
?>