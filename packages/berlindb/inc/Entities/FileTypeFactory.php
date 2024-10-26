<?php

namespace LaunchpadBerlinDB\Entities;

class FileTypeFactory
{
    public function make(string $template): FileType {
        if('database/table.php.tpl' === $template) {
            return new FileType(FileType::TABLE);
        }
        if('database/row.php.tpl' === $template) {
            return new FileType(FileType::ROW);
        }
        return new FileType(FileType::SCHEMA);
    }
}
