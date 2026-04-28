<?php
require_once "../../includes/function-articles.php";
session_start();
$categories = categoriesCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <link rel="stylesheet" href="../../assets/styles/sidebare.css">
    <link rel="stylesheet" href="../../assets/styles/create_articles.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../../includes/sidebareAdmin.php" ?>
    <div class="all">

        <form action="../../actions/create_articles_action.php" method="POST" enctype="multipart/form-data">
            <div class="create-post-container">
                <header class="post-header">
                    <div class="header-text">
                        <h1>Create New Post</h1>
                        <p>Write, format, and publish your content.</p>
                    </div>
                    <div class="header-actions">
                        <button type="submit" name="submit_post" class="btn-publish"><i class="fa-solid fa-upload"></i>
                            Publish Post</button>
                    </div>
                </header>

                <main class="post-content-wrapper">
                    <section class="editor-section">
                        <input type="text" class="title-input" required name="title" placeholder="Article Title...">
                        <div class="excerpt-group" style="margin-bottom: 20px;">
                            <label
                                style="display:block; font-size: 12px; font-weight: 700; color: #64748b; margin-bottom: 8px;">EXCERPT
                                (Short Summary)</label>
                            <textarea required name="excerpt" placeholder="Write a short summary of this article..."
                                style="width: 100%; height: 80px; padding: 15px; border: 1px solid #e2e8f0; border-radius: 12px; resize: none; font-family: inherit; outline: none; background: #f8fafc;"></textarea>
                        </div>
                        <div class="rich-editor">
                            <textarea required class="content-area" name="content"
                                placeholder="Write your amazing content here..."></textarea>
                        </div>
                    </section>

                    <aside class="settings-sidebar">
                        <div class="settings-card">
                            <div class="card-header"><i class="fa-solid fa-image"></i> <span>Cover Image</span></div>
                            <input type="file" required name="cover_image" id="cover-input" accept="image/*" hidden>
                            <div class="upload-box" id="upload-trigger">
                                <div id="preview-container">
                                    <i class="fa-regular fa-image"></i>
                                    <p>Click to upload image</p>
                                    <span>PNG, JPG, WEBP</span>
                                </div>
                                <img id="image-preview" src="#" alt="Preview"
                                    style="display: none; width: 100%; border-radius: 8px;">
                            </div>
                        </div>

                        <div class="settings-card">
                            <div class="card-header">
                                <i class="fa-solid fa-tag"></i> <span>Categorization</span>
                            </div>
                            <div class="input-group">
                                <label>CATEGORY</label>
                                <select name="category_id">
                                    <?php foreach ($categories as $cat): ?>
                                        <div class="categorie">
                                            <option value="<?php echo htmlspecialchars($cat['id']); ?>">
                                                <?php echo htmlspecialchars($cat['name']); ?>
                                            </option>
                                        </div>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <label>TAGS</label>
                                <input type="text" name="tags" placeholder="e.g. react, tutorial (comma separated)">
                            </div>
                        </div>
                    </aside>
                </main>
            </div>
    </div>
    </form>
    <script>
        const uploadTrigger = document.getElementById('upload-trigger');
        const coverInput = document.getElementById('cover-input');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');

        uploadTrigger.addEventListener('click', () => coverInput.click());

        coverInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.style.display = 'none';
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>