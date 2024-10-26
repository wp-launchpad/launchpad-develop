
{% if '{{ type }}' == 'datetime' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'timestamp',
            'default'    => '0000-00-00 00:00:00',
            'created'    => true,
            'date_query' => true,
            'sortable'   => true,
        ],
{% endif %}
{% if '{{ type }}' == 'string' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'varchar',
            'length'     => '255',
            'default'    => '',
            'cache_key'  => true,
            'searchable' => true,
            'sortable'   => true,
        ],
{% endif %}
{% if '{{ type }}' == 'text' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'longtext',
            'default'    => null,
            'cache_key'  => false,
            'searchable' => true,
            'sortable'   => true,
        ],
{% endif %}
{% if '{{ type }}' == 'boolean' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'tinyint',
            'length'     => '1',
            'default'    => 0,
            'cache_key'  => true,
            'searchable' => true,
            'sortable'   => true,
        ],
{% endif %}
{% if '{{ type }}' == 'int' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'int',
            'length'     => '10',
            'default'    => 0,
            'cache_key'  => true,
            'searchable' => true,
            'sortable'   => true,
        ],
{% endif %}
{% if '{{ type }}' == 'float' : %}
        // {{ name }} column.
        [
            'name'       => '{{ name }}',
            'type'       => 'float',
            'length'     => '10',
            'default'    => 0,
            'cache_key'  => true,
            'searchable' => true,
            'sortable'   => true,
        ],
{% endif %}
