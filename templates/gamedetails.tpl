<div class="container">
    <div class="game-details">
        {if $game}
            <div class="row">
                <div class="col-md-8">
                    <h2>{$game.game_name}</h2>
                    
                    {if $game.youtube_video}
                        <div class="video-container mb-4">
                            <iframe width="100%" height="400" 
                                src="https://www.youtube.com/embed/{$game.youtube_video}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    {/if}
                    
                    <div class="game-description mb-4">
                        {$game.description}
                    </div>
                    
                    <div class="game-features">
                        <h3>Features</h3>
                        {$game.features}
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="pricing-box">
                        <h3>Pricing Plans</h3>
                        {foreach from=$pricing item=plan}
                            <div class="pricing-plan">
                                <h4>{$plan.name}</h4>
                                <div class="price">{$plan.price}</div>
                                <div class="billing-cycle">{$plan.cycle}</div>
                                <a href="cart.php?a=add&pid={$game.product_id}&billingcycle={$plan.cycle_key}" 
                                   class="btn btn-primary btn-block">
                                    Order Now
                                </a>
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        {else}
            <div class="alert alert-danger">Game server not found.</div>
        {/if}
    </div>
</div>

<style>
.game-details {
    padding: 30px 0;
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
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.pricing-plan {
    margin-bottom: 20px;
    padding: 15px;
    background: white;
    border-radius: 6px;
    text-align: center;
}

.pricing-plan .price {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    margin: 10px 0;
}

.pricing-plan .btn {
    margin-top: 15px;
}

.game-features {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}
</style>
