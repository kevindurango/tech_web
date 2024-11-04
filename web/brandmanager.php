<?php
class brandmanager {
    private $conn;
    private $brand_name;
    private $description;
    private $logo_url;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function setBrandDetails($name, $description) {
        $this->brand_name = $name;
        $this->description = $description;
    }

    public function uploadLogo($file) {
        $target_dir = "uploads/brands/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $this->logo_url = $target_file;
            return true;
        } else {
            return false;
        }
    }

    public function addBrand() {
        if (isset($this->logo_url)) {
            $sql = "INSERT INTO brands (brand_name, logo_url, description) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $this->brand_name, $this->logo_url, $this->description);
            
            if ($stmt->execute()) {
                echo "New brand added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    public function deleteBrand($brand_id) {
        $sql = "DELETE FROM brands WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $brand_id);

        if ($stmt->execute()) {
            echo "Brand deleted successfully";
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    }

    public function updateBrand($brand_id, $name, $description, $file) {
        if (!empty($file['name'])) {
            if ($this->uploadLogo($file)) {
                $sql = "UPDATE brands SET brand_name = ?, logo_url = ?, description = ? WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("sssi", $name, $this->logo_url, $description, $brand_id);
            } else {
                echo "Sorry, there was an error uploading your file.";
                return;
            }
        } else {
            $sql = "UPDATE brands SET brand_name = ?, description = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssi", $name, $description, $brand_id);
        }

        if ($stmt->execute()) {
            echo "Brand updated successfully";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    }

    public function fetchBrandDetails($brand_id) {
        $sql = "SELECT * FROM brands WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $brand_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }
}
?>
