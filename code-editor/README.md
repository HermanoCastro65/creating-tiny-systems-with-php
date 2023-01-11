## Description

This project is a simple code editor.

## 1. Project Base

- **1.1** Create DOCTYPE html

Create in the source directory an index.php file with a DOCTYPE html. Create a folder with name 'files' and include 2 php files for testing.

```bash
<!DOCTYPE html>
<html>
<head>
    <title>Editor - File List</title>
</head>
<body>
</body>
</html>
```

- **1.2** Create PHP script

With php's scandir() function, you can loop to show which files are in the directory.

```bash
<body>
    <?php
    $files = scandir('files');
    for ($i = 0; $i < count($files); $i++) :
        if (is_dir($files[$i]))
            continue;
    ?>
        <div class="file-list-single">
            <p><a href=""><?php echo $files[$i]; ?></a></p>
        </div>
    <?php
    endfor;
    ?>
</body>
```

- **1.3** Create styles

Style your project in a simple way with the html style tag.

```bash
<head>
    ...
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
    }
    .file-list-single:hover {
        background-color: #6598eb;
    }
</style>
<body>
    ...
</body>
```

## 2. Get Files

- **2.1** Create a route to the desired file and get it for editing.

```bash
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
        <h2><?php echo 'Editing file: ' . $_GET['file']; ?></h2>
        <textarea><?php echo file_get_contents('files/' . $_GET['file']) ?></textarea>
    </div>
<?php endif ?>
```

- **2.2** Update styles

Update styles in code-editor div class.

```bash
<style type="text/css">
    ...
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
    }
</style>
```

## 3. Save Changes

- **3.1** Create one input to the button save and another with type hidden to get the path of actual file. Put textarea and inputs in a form with method post.

```bash
...
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
```

- **3.2** In the top of this code, create another php script to put the content in actual file and save changes.

```bash
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
    ...
</html>
```

- **3.3** Finish and update styles

Update styles to finish the project.

```bash
<style type="text/css">
    ...
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
```

Now you have a simple code editor .
