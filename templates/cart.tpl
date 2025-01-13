<div class="gameserver-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="game-info">
                    {if $gameserver}
                        <div class="game-header">
                            {if $gameserver->banner_image}
                                <img src="{$gameserver->banner_image}" alt="{$gameserver->game_name}" class="img-fluid mb-3">
                            {/if}
                            <h2>{$gameserver->game_name}</h2>
                        </div>
                        
                        <div class="game-description mb-4">
                            {$gameserver->description}
                        </div>
                        
                        <div class="game-features mb-4">
                            <h3>Features</h3>
                            {$gameserver->features}
                        </div>
                    {/if}
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="cart-summary">
                    <div class="card">
                        <div class="card-header">
                            <h3>Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="cart.php?a=add&pid={$pid}">
                                {if $configurableoptions}
                                    <div class="configurable-options">
                                        <h4>Configuration Options</h4>
                                        {foreach from=$configurableoptions item=configoption}
                                            <div class="form-group">
                                                <label>{$configoption.optionname}</label>
                                                {if $configoption.optiontype eq 1}
                                                    <select name="configoption[{$configoption.id}]" class="form-control">
                                                        {foreach key=num2 item=options from=$configoption.options}
                                                            <option value="{$options.id}">{$options.name}{if $options.pricing} ({$options.pricing}){/if}</option>
                                                        {/foreach}
                                                    </select>
                                                {elseif $configoption.optiontype eq 2}
                                                    {foreach key=num2 item=options from=$configoption.options}
                                                        <label class="radio-inline">
                                                            <input type="radio" name="configoption[{$configoption.id}]" value="{$options.id}"{if $num2 eq 0} checked{/if}> 
                                                            {$options.name}{if $options.pricing} ({$options.pricing}){/if}
                                                        </label>
                                                    {/foreach}
                                                {/if}
                                            </div>
                                        {/foreach}
                                    </div>
                                {/if}
                                
                                <div class="billing-cycle mb-4">
                                    <h4>Billing Cycle</h4>
                                    <select name="billingcycle" class="form-control">
                                        {foreach from=$pricing item=cycle key=cyclename}
                                            <option value="{$cyclename}">{$cycle.name} - {$cycle.price}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                
                                <div class="addons mb-4">
                                    {if $addons}
                                        <h4>Available Addons</h4>
                                        {foreach from=$addons item=addon}
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="addons[]" value="{$addon.id}" id="addon{$addon.id}">
                                                <label class="form-check-label" for="addon{$addon.id}">
                                                    {$addon.name} ({$addon.pricing})
                                                </label>
                                            </div>
                                        {/foreach}
                                    {/if}
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.gameserver-cart {
    padding: 40px 0;
}

.game-header {
    margin-bottom: 30px;
}

.game-header img {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.game-features {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.cart-summary .card {
    position: sticky;
    top: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.configurable-options,
.billing-cycle,
.addons {
    border-bottom: 1px solid #eee;
    padding-bottom: 20px;
}

.form-check {
    margin-bottom: 10px;
}

.btn-block {
    padding: 12px;
    font-size: 1.1em;
}
</style>
