<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;

// Delete game server if requested
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Capsule::table('mod_gameservers')->where('id', $id)->delete();
    echo '<div class="alert alert-success">Game server deleted successfully!</div>';
}

// Get all game servers
$gameservers = Capsule::table('mod_gameservers')
    ->join('tblproducts', 'tblproducts.id', '=', 'mod_gameservers.product_id')
    ->select('mod_gameservers.*', 'tblproducts.name as product_name')
    ->get();

?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Game Servers</h3>
        <div class="float-right">
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?module=gameservers&action=manage" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Add New Game Server
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Game Name</th>
                    <th>Product</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gameservers as $server): ?>
                    <tr>
                        <td><?php echo $server->id; ?></td>
                        <td><?php echo htmlspecialchars($server->game_name); ?></td>
                        <td><?php echo htmlspecialchars($server->product_name); ?></td>
                        <td>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?module=gameservers&action=manage&id=<?php echo $server->id; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?module=gameservers&delete=<?php echo $server->id; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Are you sure you want to delete this game server?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (count($gameservers) == 0): ?>
                    <tr>
                        <td colspan="4" class="text-center">No game servers found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
