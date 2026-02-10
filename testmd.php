<!DOCTYPE html>
<html>

<head>
    <title>Password Hashing Example</title>
</head>

<body>
    <h1>Password Hashing Example</h1>
    <form method="post" action="">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Hash Password</button>
    </form>

    <?php
    function calculateHash($input)
    {
        return md5($input);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputPassword = $_POST['password'];
        $hashedInputPassword = calculateHash($inputPassword);
        $hashedTestPassword = calculateHash('Test123');

        echo "<h2>Hashing Results</h2>";
        echo "<p><strong>Input Password:</strong> $inputPassword</p>";
        echo "<p><strong>Hashed Password from Input:</strong> $hashedInputPassword</p>";
        echo "<p><strong>Hashed Password from 'Test123':</strong> $hashedTestPassword</p>";
    }
    ?>

</body>

</html>