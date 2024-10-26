<?php

namespace PSR2Plugin\Engine\Sub\Test\Database\Rows;

use PSR2Plugin\Dependencies\BerlinDB\Database\Row;

class MyTable extends Row {
    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var int
     */
    public $birthday;

    /**
     * MyTable constructor.
     *
     * @param object $item Current row details.
     */
    public function __construct( $item ) {
        parent::__construct( $item );
        $this->id            = (int) $this->id;
        $this->name = (string) $this->name;
        $this->birthday = empty( $this->birthday ) ? 0 : strtotime( $this->birthday );
        $this->modified      = false === $this->modified ? 0 : strtotime( $this->modified );
        $this->last_accessed = false === $this->last_accessed ? 0 : strtotime( $this->last_accessed );
    }
}
