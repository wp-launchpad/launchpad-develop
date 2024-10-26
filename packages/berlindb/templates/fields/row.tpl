{% if in_array('{{ type }}', ['string', 'int', 'float', 'boolean']) : %}
        $this->{{ name }} = ({{ type }}) $this->{{ name }};
{% endif %}
{% if '{{ type }}' === 'text' : %}
        $this->{{ name }} =  (string) $this->{{ name }};
{% endif %}
{% if '{{ type }}' === 'datetime' : %}
        $this->{{ name }} = empty( $this->{{ name }} ) ? 0 : strtotime( $this->{{ name }} );
{% endif %}
