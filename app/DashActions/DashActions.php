<?php

namespace App\DashActions;

class DashActions {
    protected array $contents;
    protected string $file_path = dirname(dirname(__DIR__)) + "storage/dash_actions.json";

    public function __construct(array $contents) {
        $this->contents = $contents;
    }

    public static function load(): DashActions {
        $dash_actions = new DashActions([]);

        echo $dash_actions->file_path;
        return $dash_actions;
    }
}
