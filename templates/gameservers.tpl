<div class="container">
    <h2>Game Servers</h2>
    
    <div class="row game-servers-grid">
        {foreach $gameservers as $server}
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    {if $server->banner_image}
                        <img src="{$server->banner_image}" class="card-img-top" alt="{$server->game_name}">
                    {/if}
                    <div class="card-body">
                        <h5 class="card-title">{$server->game_name}</h5>
                        <p class="card-text">{$server->description|truncate:150}</p>
                        <a href="index.php?m=gameservers&action=view&id={$server->id}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        {foreachelse}
            <div class="col-12">
                <div class="alert alert-info">No game servers available at this time.</div>
            </div>
        {/foreach}
    </div>
</div>

<style>
.game-servers-grid .card {
    transition: transform 0.2s;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.game-servers-grid .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.game-servers-grid .card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
