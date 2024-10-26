{% if '{{ type }}' !== 'datetime': %}
    /**
     *
     * @var {{ type }}
     */
    public ${{ name }};
{% endif %}
{% if '{{ type }}' === 'datetime': %}
    /**
     *
     * @var int
     */
    public ${{ name }};
{% endif %}

