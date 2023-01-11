<?php
if (isset($_POST['action'])) :
    $text = $_POST['text'];
    $file = $_POST['file'];
    file_put_contents($file, $text);
    echo '<script>alert("Saved successfully")</script>';
endif
?>
<!DOCTYPE html>
<html>

<head>
    <title>Editor - File List</title>
</head>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .file-list-single {
        background-color: #2d7af7;
        padding: 10px;
        border-bottom: 3px solid #bcceeb;
        color: white;
        cursor: pointer;
        text-decoration: none;
    }

    .file-list-single a {
        color: white;
        cursor: pointer;
        text-decoration: none;
    }

    .file-list-single:hover {
        background-color: #6598eb;
    }

    .code-editor {
        padding: 10px;
    }

    .code-editor h2 {
        color: #2d7af7;
        text-decoration: none;
        font-size: 25px;
        margin: 10px 0;
    }

    .code-editor textarea {
        width: 500px;
        height: 500px;
        margin: 10px 0;
    }

    .code-editor input {
        font-weight: 700;
        background-color: #2d7af7;
        border-radius: 5px;
        border-color: #6598eb;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    .code-editor input:hover {
        background-color: #6598eb;
    }
</style>

<body>
    <?php
    $files = scandir('files');
    for ($i = 0; $i < count($files); $i++) :
        if (is_dir($files[$i]))
            continue;
    ?>
        <div class="file-list-single">
            <p><a href="?file=<?php echo $files[$i]; ?>"><?php echo $files[$i]; ?></a></p>
        </div>
    <?php
    endfor;
    if (isset($_GET['file']) && file_exists('files/' . $_GET['file'])) :
    ?>
        <div class="code-editor">
            <form method="post">
                <h2><?php echo 'Editing file: ' . $_GET['file']; ?></h2>
                <textarea name="text"><?php echo file_get_contents('files/' . $_GET['file']) ?></textarea>
                <br />
                <input type="hidden" name="file" value="<?php echo 'files/' . $_GET['file'] ?>">
                <input type="submit" name="action" value="SAVE" />
            </form>
        </div>
    <?php endif ?>
</body>

</html>