<?php

namespace LaunchpadBerlinDB\Services;

use LaunchpadBerlinDB\Entities\Field;
use LaunchpadBerlinDB\Entities\FieldStringIterator;
use LaunchpadBerlinDB\Entities\FileType;
use LaunchpadBerlinDB\Entities\InvalidValue;
use LaunchpadBerlinDB\Entities\Name;
use LaunchpadBerlinDB\Entities\Type;
use LaunchpadCLI\Templating\Renderer;

class FieldManager
{
    protected $fields = [];

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function parse(string $fields) {
        $fields = explode(',', $fields);
        foreach ($fields as $field) {
            $iterator = new FieldStringIterator($field);
            if(! $iterator->valid()) {
                continue;
            }
            try {
                $type = new Type($iterator->current());
            } catch (InvalidValue $invalidValue) {
                continue;
            }
            $iterator->next();
            if(! $iterator->valid()) {
                continue;
            }
            try {
                $name = new Name($iterator->current());
            } catch (InvalidValue $invalidValue) {
                continue;
            }
            $this->fields[] = new Field($type, $name);
        }
    }

    public function add(Field $field) {
        $this->fields[] = $field;
    }

    public function render(FileType $type): string {
        $fields = array_map(function (Field $field) use ($type) {
            $field = [
               'type' => $field->get_type(),
               'name' => $field->get_name(),
               'nullable' => $field->is_nullable(),
            ];
            return $this->renderer->apply_template($this->get_right_template($type), $field);
        }, $this->fields);
        return join("\n", $fields);
    }

    protected function get_right_template(FileType $type): string {
        $mapping = [
            FileType::SCHEMA => 'fields/schema.tpl',
            FileType::ROW => 'fields/row.tpl',
            FileType::ROW_PROPERTIES => 'fields/row_properties.tpl',
            FileType::TABLE => 'fields/table.tpl',
        ];

        return $mapping[$type->get_value()];
    }
}
