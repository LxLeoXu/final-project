<?php if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch random question and answer from the database
$sql = "SELECT * FROM qa ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Question: " . $row["question"]. "<br>";
        echo "Answer: " . $row["answer"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>