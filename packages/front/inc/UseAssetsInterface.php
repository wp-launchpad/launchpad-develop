<?php

namespace LaunchpadFront;

use LaunchpadBudAssets\Assets;

interface UseAssetsInterface
{
    /**
     * Set Assets.
     *
     * @param Assets $assets
     */
    public function set_assets(Assets $assets);
}
