<?php
class Product extends BaseModel
{
    protected $table = 'products';

    /**
     * Lấy tất cả sản phẩm
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Lấy sản phẩm theo ID
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Tìm kiếm sản phẩm theo tên
     */
    public function search($keyword)
    {
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE ? ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll();
    }

    /**
     * Thêm sản phẩm mới vào database
     * Sử dụng Prepared Statement để chống SQL Injection
     */
    public function insert($data)
    {
        $sql = "INSERT INTO {$this->table} (name, price, description, image) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $data['name'] ?? null,
            $data['price'] ?? null,
            $data['description'] ?? null,
            $data['image'] ?? null,
        ]);
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} 
                SET name = ?, price = ?, description = ?, image = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            $data['name'] ?? null,
            $data['price'] ?? null,
            $data['description'] ?? null,
            $data['image'] ?? null,
            $id
        ]);
    }

    /**
     * Xóa sản phẩm theo ID
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    /**
     * Đếm tổng số sản phẩm
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    /**
     * Lấy sản phẩm với phân trang
     */
    public function paginate($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $perPage, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>