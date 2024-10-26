<?php

namespace PSR2Plugin\Engine\Sub\Test\Database\Queries;

use PSR2Plugin\Dependencies\BerlinDB\Database\Query;
use PSR2Plugin\Engine\Sub\Test\Database\Rows\MyTable as Row;
use PSR2Plugin\Engine\Sub\Test\Database\Schemas\MyTable as Schema;

class MyTable extends Query {

    /**
     * Name of the database table to query.
     *
     * @var   string
     */
    protected $table_name = 'my_table';

    /**
     * String used to alias the database table in MySQL statement.
     *
     * Keep this short, but descriptive. I.E. "tr" for term relationships.
     *
     * This is used to avoid collisions with JOINs.
     *
     * @var   string
     */
    protected $table_alias = 'my_table';
    /**
     * Name of class used to setup the database schema.
     *
     * @var string
     */
    protected $table_schema = Schema::class;

    /** Item ******************************************************************/

    /**
     * Name for a single item.
     *
     * Use underscores between words. I.E. "term_relationship"
     *
     * This is used to automatically generate action hooks.
     *
     * @var   string
     */
    protected $item_name = 'my_table';

    /**
     * Plural version for a group of items.
     *
     * Use underscores between words. I.E. "term_relationships"
     *
     * This is used to automatically generate action hooks.
     *
     * @var string
     */
    protected $item_name_plural = 'my_tables';

    /**
     * Name of class used to turn IDs into first-class objects.
     *
     * This is used when looping through return values to guarantee their shape.
     *
     * @var mixed
     */
    protected $item_shape = Row::class;
}
