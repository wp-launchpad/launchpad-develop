{% if '{{ type }}' == 'datetime' : %}
			{{ name }}    timestamp           NOT NULL default '0000-00-00 00:00:00',
{% endif %}
			{% if '{{ type }}' == 'string' : %}
{{ name }}           varchar(255)        NOT NULL default '',
{% endif %}
{% if '{{ type }}' == 'text' : %}
			{{ name }}              longtext                     default NULL,
{% endif %}
{% if '{{ type }}' == 'boolean' : %}
			{{ name }}        tinyint(1)          NOT NULL default 0,
{% endif %}
{% if '{{ type }}' == 'int' : %}
			{{ name }}        int(10)          NOT NULL default 0,
{% endif %}
{% if '{{ type }}' == 'float' : %}
			{{ name }}        float(10)          NOT NULL default 0,
{% endif %}
