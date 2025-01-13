<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="game-info">
                {if $gameServer}
                    <div class="game-header">
                        {if $gameServer->banner_image}
                            <img src="{$gameServer->banner_image}" alt="{$gameServer->game_name}" class="img-fluid mb-3">
                        {/if}
                        <h2>{$gameServer->game_name}</h2>
                    </div>
                    
                    <div class="game-description mb-4">
                        {$gameServer->description}
                    </div>
                    
                    <div class="game-features mb-4">
                        <h3>Features</h3>
                        {$gameServer->features}
                    </div>

                    {if $gameServer->youtube_video}
                        <div class="video-container mb-4">
                            <iframe width="100%" height="400" 
                                src="https://www.youtube.com/embed/{if strpos($gameServer->youtube_video, 'watch?v=')}
                                    {$gameServer->youtube_video|regex_replace:'/.*watch\?v=([^&]*).*/':'$1'}
                                {elseif strpos($gameServer->youtube_video, 'youtu.be/')}
                                    {$gameServer->youtube_video|regex_replace:'/.*youtu.be\/([^?]*).*/':'$1'}
                                {else}
                                    {$gameServer->youtube_video}
                                {/if}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    {/if}
                {else}
                    <div class="alert alert-danger">Game server not found.</div>
                {/if}
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="pricing-box">
                <div class="card">
                    <div class="card-header">
                        <h3>Pricing Plans</h3>
                    </div>
                    <div class="card-body">
                        <a href="cart.php?a=add&pid={$gameServer->product_id}" class="btn btn-primary btn-lg btn-block">
                            Order Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.game-header img {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.game-features {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin: 20px 0;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.pricing-box {
    position: sticky;
    top: 20px;
}

.btn-block {
    padding: 15px;
    font-size: 1.1em;
}
</style>
