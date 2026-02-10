<?php
$sql = "SELECT id, name FROM tbl_brands";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["id"] . " - " . $row["name"] . "</option>";
    }
}
