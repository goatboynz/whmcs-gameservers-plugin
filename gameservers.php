<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;

function gameservers_config() {
    return [
        'name' => 'Game Servers',
        'description' => 'Plugin for managing and displaying game server products',
        'version' => '1.0',
        'author' => 'Goatboy',
        'language' => 'english'
    ];
}

function gameservers_activate() {
    try {
        if (!Capsule::schema()->hasTable('mod_gameservers')) {
            Capsule::schema()->create('mod_gameservers', function ($table) {
                $table->increments('id');
                $table->integer('product_id');
                $table->string('game_name');
                $table->text('description');
                $table->text('features');
                $table->string('youtube_video')->nullable();
                $table->string('banner_image')->nullable();
                $table->timestamps();
            });
        }
        return [
            'status' => 'success',
            'description' => 'Game Servers module has been activated successfully.',
        ];
    } catch (\Exception $e) {
        return [
            'status' => "error",
            'description' => 'Could not create game servers table: ' . $e->getMessage(),
        ];
    }
}

function gameservers_deactivate() {
    try {
        // Don't drop the table on deactivation to preserve data
        return [
            'status' => 'success',
            'description' => 'Game Servers module has been deactivated successfully.',
        ];
    } catch (\Exception $e) {
        return [
            'status' => "error",
            'description' => 'Could not deactivate module: ' . $e->getMessage(),
        ];
    }
}

function gameservers_output($vars) {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    
    if ($action == 'manage') {
        require_once(__DIR__ . '/includes/manage.php');
    } else {
        require_once(__DIR__ . '/includes/overview.php');
    }
}

function gameservers_clientarea($vars) {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    
    if ($action == 'view') {
        $gameId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $gameServer = Capsule::table('mod_gameservers')->where('id', $gameId)->first();
        
        return [
            'pagetitle' => 'Game Server Details',
            'breadcrumb' => [
                'index.php?m=gameservers' => 'Game Servers',
                'index.php?m=gameservers&action=view&id=' . $gameId => 'Server Details',
            ],
            'templatefile' => 'gamedetails',
            'vars' => ['gameServer' => $gameServer],
        ];
    }
    
    // Custom cart page
    if ($action == 'cart' && isset($_GET['pid'])) {
        $pid = (int)$_GET['pid'];
        $gameServer = Capsule::table('mod_gameservers')
            ->where('product_id', $pid)
            ->first();
            
        if (!$gameServer) {
            return [
                'pagetitle' => 'Error',
                'breadcrumb' => [
                    'index.php?m=gameservers' => 'Game Servers',
                ],
                'templatefile' => 'error',
                'vars' => ['error' => 'Game server not found'],
            ];
        }
        
        // Get product pricing
        $product = Capsule::table('tblproducts')
            ->where('id', $pid)
            ->first();
            
        $pricing = [];
        if ($product->paytype == 'recurring') {
            if ($product->msetupfee > 0 || $product->monthly > 0) 
                $pricing['monthly'] = ['name' => 'Monthly', 'price' => formatCurrency($product->monthly)];
            if ($product->qsetupfee > 0 || $product->quarterly > 0) 
                $pricing['quarterly'] = ['name' => 'Quarterly', 'price' => formatCurrency($product->quarterly)];
            if ($product->ssetupfee > 0 || $product->semiannually > 0) 
                $pricing['semiannually'] = ['name' => 'Semi-Annually', 'price' => formatCurrency($product->semiannually)];
            if ($product->asetupfee > 0 || $product->annually > 0) 
                $pricing['annually'] = ['name' => 'Annually', 'price' => formatCurrency($product->annually)];
            if ($product->bsetupfee > 0 || $product->biennially > 0) 
                $pricing['biennially'] = ['name' => 'Biennially', 'price' => formatCurrency($product->biennially)];
            if ($product->tsetupfee > 0 || $product->triennially > 0) 
                $pricing['triennially'] = ['name' => 'Triennially', 'price' => formatCurrency($product->triennially)];
        } else {
            $pricing['onetime'] = ['name' => 'One Time', 'price' => formatCurrency($product->monthly)];
        }
        
        // Get configurable options
        $configurableoptions = [];
        $result = select_query('tblproductconfiggroups', '', ['gid' => $product->configgroupid]);
        while ($data = mysql_fetch_array($result)) {
            $groupname = $data['name'];
            $result2 = select_query('tblproductconfigoptions', '', ['gid' => $data['id']]);
            while ($data2 = mysql_fetch_array($result2)) {
                $optionid = $data2['id'];
                $optionname = $data2['optionname'];
                $optiontype = $data2['optiontype'];
                $options = [];
                $result3 = select_query('tblproductconfigoptionssub', '', ['configid' => $optionid]);
                while ($data3 = mysql_fetch_array($result3)) {
                    $options[] = [
                        'id' => $data3['id'],
                        'name' => $data3['optionname'],
                        'pricing' => formatCurrency($data3['price'])
                    ];
                }
                $configurableoptions[] = [
                    'id' => $optionid,
                    'name' => $optionname,
                    'type' => $optiontype,
                    'options' => $options
                ];
            }
        }
        
        // Get addons
        $addons = [];
        $result = select_query('tbladdons', '', ['packages' => $pid]);
        while ($data = mysql_fetch_array($result)) {
            $addons[] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'description' => $data['description'],
                'pricing' => formatCurrency($data['monthly'])
            ];
        }
        
        return [
            'pagetitle' => $gameServer->game_name,
            'breadcrumb' => [
                'index.php?m=gameservers' => 'Game Servers',
                'index.php?m=gameservers&action=cart&pid=' . $pid => $gameServer->game_name,
            ],
            'templatefile' => 'cart',
            'vars' => [
                'gameserver' => $gameServer,
                'pid' => $pid,
                'pricing' => $pricing,
                'configurableoptions' => $configurableoptions,
                'addons' => $addons,
            ],
        ];
    }
    
    // Default game servers list
    $gameservers = Capsule::table('mod_gameservers')->get();
    
    return [
        'pagetitle' => 'Game Servers',
        'breadcrumb' => [
            'index.php?m=gameservers' => 'Game Servers',
        ],
        'templatefile' => 'gameservers',
        'vars' => ['gameservers' => $gameservers],
    ];
}

function gameservers_add_menu_item($vars) {
    $primaryNavbar = Menu::primaryNavbar();
    
    $primaryNavbar->addChild(
        'Game Servers',
        [
            'uri' => 'index.php?m=gameservers',
            'order' => 15,
        ]
    );
}
