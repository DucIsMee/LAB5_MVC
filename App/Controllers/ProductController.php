<?php
class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $products = $this->product->all();
        $search = false;
        include 'views/product-list.php';
    }

    /**
     * Hiển thị chi tiết sản phẩm
     */
    public function show($id)
    {
        $product = $this->product->findById($id);
        
        if (!$product) {
            $_SESSION['error'] = 'Sản phẩm không tồn tại!';
            header("Location: index.php?page=product-list");
            exit;
        }

        include 'views/product-detail.php';
    }

    /**
     * Hiển thị form thêm sản phẩm mới
     */
    public function create()
    {
        include 'views/product-add.php';
    }

    /**
     * Xử lý lưu sản phẩm mới (nhận từ POST)
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=product-add");
            exit;
        }

        // Lấy dữ liệu từ form
        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');

        // Validate dữ liệu
        $errors = [];

        if (empty($name)) {
            $errors[] = 'Tên sản phẩm không được để trống!';
        }

        if (empty($price) || !is_numeric($price) || $price < 0) {
            $errors[] = 'Giá sản phẩm phải là một số dương!';
        }

        if (empty($description)) {
            $errors[] = 'Mô tả sản phẩm không được để trống!';
        }

        if (empty($image)) {
            $errors[] = 'Hình ảnh sản phẩm không được để trống!';
        }

        // Nếu có lỗi, quay lại form
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: index.php?page=product-add");
            exit;
        }

        // Chuẩn bị dữ liệu để lưu
        $data = [
            'name' => $name,
            'price' => (float)$price,
            'description' => $description,
            'image' => $image,
        ];

        // Lưu vào database
        if ($this->product->insert($data)) {
            $_SESSION['success'] = 'Thêm sản phẩm thành công!';
            header("Location: index.php?page=product-list");
            exit;
        } else {
            $_SESSION['error'] = 'Không thể thêm sản phẩm. Vui lòng thử lại!';
            header("Location: index.php?page=product-add");
            exit;
        }
    }

    /**
     * Hiển thị form cập nhật sản phẩm
     */
    public function edit($id)
    {
        $product = $this->product->findById($id);

        if (!$product) {
            $_SESSION['error'] = 'Sản phẩm không tồn tại!';
            header("Location: index.php?page=product-list");
            exit;
        }

        include 'views/product-edit.php';
    }

    /**
     * Xử lý cập nhật sản phẩm (nhận từ POST)
     */
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?page=product-edit&id=$id");
            exit;
        }

        // Kiểm tra sản phẩm có tồn tại không
        $product = $this->product->findById($id);
        if (!$product) {
            $_SESSION['error'] = 'Sản phẩm không tồn tại!';
            header("Location: index.php?page=product-list");
            exit;
        }

        // Lấy dữ liệu từ form
        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $image = trim($_POST['image'] ?? '');

        // Validate dữ liệu
        $errors = [];

        if (empty($name)) {
            $errors[] = 'Tên sản phẩm không được để trống!';
        }

        if (empty($price) || !is_numeric($price) || $price < 0) {
            $errors[] = 'Giá sản phẩm phải là một số dương!';
        }

        if (empty($description)) {
            $errors[] = 'Mô tả sản phẩm không được để trống!';
        }

        if (empty($image)) {
            $errors[] = 'Hình ảnh sản phẩm không được để trống!';
        }

        // Nếu có lỗi, quay lại form
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: index.php?page=product-edit&id=$id");
            exit;
        }

        // Chuẩn bị dữ liệu để cập nhật
        $data = [
            'name' => $name,
            'price' => (float)$price,
            'description' => $description,
            'image' => $image,
        ];

        // Cập nhật vào database
        if ($this->product->update($id, $data)) {
            $_SESSION['success'] = 'Cập nhật sản phẩm thành công!';
            header("Location: index.php?page=product-detail&id=$id");
            exit;
        } else {
            $_SESSION['error'] = 'Không thể cập nhật sản phẩm. Vui lòng thử lại!';
            header("Location: index.php?page=product-edit&id=$id");
            exit;
        }
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        // Kiểm tra sản phẩm có tồn tại không
        $product = $this->product->findById($id);
        if (!$product) {
            $_SESSION['error'] = 'Sản phẩm không tồn tại!';
            header("Location: index.php?page=product-list");
            exit;
        }

        // Xóa sản phẩm
        if ($this->product->delete($id)) {
            $_SESSION['success'] = 'Xóa sản phẩm thành công!';
        } else {
            $_SESSION['error'] = 'Không thể xóa sản phẩm. Vui lòng thử lại!';
        }

        header("Location: index.php?page=product-list");
        exit;
    }

    /**
     * Tìm kiếm sản phẩm
     */
    public function search()
    {
        $keyword = trim($_GET['q'] ?? '');
        
        if (empty($keyword)) {
            header("Location: index.php?page=product-list");
            exit;
        }

        $products = $this->product->search($keyword);
        $search = true;
        
        include 'views/product-list.php';
    }
}
?>