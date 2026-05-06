<?php
// Simple file-based storage
$file = 'notes.json';

if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$notes = json_decode(file_get_contents($file), true);

// Add note
if (isset($_POST['add_note'])) {
    $text = trim($_POST['note']);
    if ($text !== '') {
        array_unshift($notes, $text);
        file_put_contents($file, json_encode($notes));
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Delete note
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    if (isset($notes[$index])) {
        array_splice($notes, $index, 1);
        file_put_contents($file, json_encode($notes));
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Notes App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f4f6f8;
    }

    header {
      background: #4a90e2;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 1.5rem;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 10px;
    }

    textarea {
      width: 100%;
      height: 120px;
      padding: 10px;
      font-size: 1rem;
      border-radius: 10px;
      border: 1px solid #ccc;
      resize: none;
      outline: none;
    }

    button {
      margin-top: 10px;
      padding: 10px 15px;
      border: none;
      border-radius: 8px;
      background: #4a90e2;
      color: white;
      cursor: pointer;
      font-size: 1rem;
    }

    button:hover {
      background: #357abd;
    }

    .notes {
      margin-top: 20px;
      display: grid;
      gap: 15px;
    }

    .note {
      background: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: relative;
    }

    .delete {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #ff5c5c;
      border: none;
      color: white;
      padding: 5px 8px;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }

    .delete:hover {
      background: #e04848;
    }
  </style>
</head>
<body>

<header>PHP Notes App</header>

<div class="container">
  <form method="POST">
    <textarea name="note" placeholder="Write your note..."></textarea>
    <button type="submit" name="add_note">Add Note</button>
  </form>

  <div class="notes">
    <?php foreach ($notes as $index => $note): ?>
      <div class="note">
        <a class="delete" href="?delete=<?php echo $index; ?>">X</a>
        <p><?php echo htmlspecialchars($note); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</body>
</html>
