<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to leave a comment.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO comments (recipe_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $recipe_id, $user_id, $comment);

    if ($stmt->execute()) {
        echo "Comment submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Comment on Recipe</title>
</head>
<body>
    <header>
        <h1>Recipe Sharing Platform</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_recipe.php">Add Recipe</a>
        <a href="view_recipes.php">View Recipes</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h2>Leave a Comment</h2>
        <form method="POST" action="comment_recipe.php">
            <input type="hidden" name="recipe_id" value="<?php echo $_GET['recipe_id']; ?>">
            <textarea name="comment" placeholder="Leave a comment" required></textarea>
            <button type="submit">Submit Comment</button>
        </form>
    </div>
</body>
</html>
