<?php
if (!is_logged_in()) {
    echo '<p>Képfeltöltés csak bejelentkezett felhasználóknak!</p>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = 'uploads/';
    $filename = basename($_FILES['image']['name']);
    $target_file = $upload_dir . $filename;

    $image_type = mime_content_type($_FILES['image']['tmp_name']);
    if (in_array($image_type, ['image/jpeg', 'image/png', 'image/gif'])) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo '<p>Sikeres feltöltés: ' . htmlspecialchars($filename) . '</p>';
        } else {
            echo '<p>Hiba történt a fájl mentésekor.</p>';
        }
    } else {
        echo '<p>Csak képfájlok tölthetők fel (JPG, PNG, GIF)!</p>';
    }
}
?>

<h2>Képfeltöltés</h2>
<form method="post" enctype="multipart/form-data">
    <label>Válasszon képet:
        <input type="file" name="image" accept="image/*" required>
    </label>
    <button type="submit">Feltöltés</button>
</form>

<h3>Feltöltött képek:</h3>
<div style="display: flex; flex-wrap: wrap; gap: 10px;">
<?php
$images = glob('uploads/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
foreach ($images as $img) {
    echo '<img src="' . $img . '" alt="" style="max-width: 300px;">';
}
?>
</div>
