<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;

require_once(__DIR__ . '/upload.php');

if (isset($_POST['save'])) {
    $productId = (int)$_POST['product_id'];
    $gameName = $_POST['game_name'];
    $description = $_POST['description'];
    $features = $_POST['features'];
    $youtubeVideo = $_POST['youtube_video'];
    $bannerImage = $_POST['banner_image'];
    
    // Handle banner image upload
    if (isset($_FILES['banner_image_upload']) && $_FILES['banner_image_upload']['error'] == 0) {
        $uploadResult = handleImageUpload($_FILES['banner_image_upload'], 'banner');
        if ($uploadResult['success']) {
            $bannerImage = $uploadResult['path'];
        } else {
            echo '<div class="alert alert-danger">' . $uploadResult['message'] . '</div>';
        }
    }
    
    // Save or update game server details
    $gameServer = Capsule::table('mod_gameservers')
        ->where('product_id', $productId)
        ->first();
        
    if ($gameServer) {
        Capsule::table('mod_gameservers')
            ->where('product_id', $productId)
            ->update([
                'game_name' => $gameName,
                'description' => $description,
                'features' => $features,
                'youtube_video' => $youtubeVideo,
                'banner_image' => $bannerImage,
            ]);
    } else {
        Capsule::table('mod_gameservers')->insert([
            'product_id' => $productId,
            'game_name' => $gameName,
            'description' => $description,
            'features' => $features,
            'youtube_video' => $youtubeVideo,
            'banner_image' => $bannerImage,
        ]);
    }
    
    echo '<div class="alert alert-success">Game server details saved successfully!</div>';
}

// Get all products
$products = Capsule::table('tblproducts')
    ->select('id', 'name')
    ->get();

// Get existing game server if editing
$gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$gameServer = null;
if ($gameId) {
    $gameServer = Capsule::table('mod_gameservers')
        ->where('id', $gameId)
        ->first();
}

?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $gameId ? 'Edit' : 'Add'; ?> Game Server</h3>
    </div>
    <div class="card-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?module=gameservers&action=manage" enctype="multipart/form-data">
            <div class="form-group">
                <label>Product</label>
                <select name="product_id" class="form-control" required>
                    <option value="">Select Product</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?php echo $product->id; ?>"
                            <?php echo ($gameServer && $gameServer->product_id == $product->id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($product->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Game Name</label>
                <input type="text" name="game_name" class="form-control" required
                    value="<?php echo $gameServer ? htmlspecialchars($gameServer->game_name) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="5" required><?php 
                    echo $gameServer ? htmlspecialchars($gameServer->description) : ''; 
                ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Features (HTML supported)</label>
                <textarea name="features" class="form-control" rows="5" required><?php 
                    echo $gameServer ? htmlspecialchars($gameServer->features) : ''; 
                ?></textarea>
            </div>
            
            <div class="form-group">
                <label>YouTube Video URL</label>
                <input type="text" name="youtube_video" class="form-control"
                    value="<?php echo $gameServer ? htmlspecialchars($gameServer->youtube_video) : ''; ?>">
                <small class="form-text text-muted">Enter the full YouTube video URL (e.g., https://www.youtube.com/watch?v=dQw4w9WgXcQ)</small>
            </div>
            
            <div class="form-group">
                <label>Banner Image</label>
                <div class="input-group">
                    <input type="text" name="banner_image" class="form-control" id="banner_image"
                        value="<?php echo $gameServer ? htmlspecialchars($gameServer->banner_image) : ''; ?>">
                    <div class="input-group-append">
                        <span class="input-group-text">or</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="banner_image_upload" id="banner_image_upload" accept="image/*">
                        <label class="custom-file-label" for="banner_image_upload">Choose file</label>
                    </div>
                </div>
                <?php if ($gameServer && $gameServer->banner_image): ?>
                    <div class="mt-2">
                        <img src="<?php echo $gameServer->banner_image; ?>" alt="Current banner" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
            </div>
            
            <button type="submit" name="save" class="btn btn-primary">Save Game Server</button>
        </form>
    </div>
</div>
