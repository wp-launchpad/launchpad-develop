<?php

namespace PSR2Plugin\Engine\Sub\Test\Database;

use PSR2Plugin\Dependencies\LaunchpadCore\Container\AbstractServiceProvider;

/**
 * Service provider.
 */
class ServiceProvider extends AbstractServiceProvider
{

    /**
     * Registers items with the container
     *
     * @return void
     */
    public function define()
    {
        $this->register_service(\PSR2Plugin\Engine\Sub\Test\Database\Queries\MyTable::class);
        $this->register_service(\PSR2Plugin\Engine\Sub\Test\Database\Tables\MyTable::class, function () {
            $this->getContainer()->get(\PSR2Plugin\Engine\Sub\Test\Database\Tables\MyTable::class);
        });
        $this->register_service(\PSR2Plugin\Engine\Sub\Test\Database\Rows\MyTable::class);
        $this->register_service(\PSR2Plugin\Engine\Sub\Test\Database\Schemas\MyTable::class);
    }
}
