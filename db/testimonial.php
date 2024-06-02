<?php
// classes/Testimonial.php
class Testimonial {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($question, $answer, $imagePath) {
        $stmt = $this->db->prepare("INSERT INTO testimonials (question, answer, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $question, $answer, $imagePath);
        return $stmt->execute();
    }

    public function read() {
        $result = $this->db->query("SELECT * FROM testimonials");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $question, $answer, $imagePath = null) {
        if ($imagePath) {
            $stmt = $this->db->prepare("UPDATE testimonials SET question = ?, answer = ?, image_path = ? WHERE id = ?");
            $stmt->bind_param("sssi", $question, $answer, $imagePath, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE testimonials SET question = ?, answer = ? WHERE id = ?");
            $stmt->bind_param("ssi", $question, $answer, $id);
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM testimonials WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>