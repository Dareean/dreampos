<?php

$sql = "SELECT id, code, name FROM tbl_categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["code"] . " - " . $row["name"] . "</option>";
    }
}
