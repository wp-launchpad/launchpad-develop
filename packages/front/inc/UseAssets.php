<?php

namespace LaunchpadFront;

use LaunchpadBudAssets\Assets;

trait UseAssets
{
    /**
     * Assets.
     *
     * @var Assets
     */
    protected $assets;

    /**
     * Set Assets.
     *
     * @param Assets $assets
     */
    public function set_assets(Assets $assets)
    {
        $this->assets = $assets;
    }

}
