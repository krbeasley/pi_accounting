<?php

namespace App\DashActions;

class DashActions {
    protected array $contents;
    protected string $file_path; 

    public function __construct(array $contents = []) {
        $this->contents = $contents;
        $this->file_path = dirname(dirname(__DIR__)) . "/storage/dash_actions.json"; 
    }

    public static function load(): DashActions {
        $dash_actions = new DashActions();
        $file_contents = file_get_contents($dash_actions->file_path);

        if (empty($file_contents)) {
            $dash_actions->setup();     // Setup the file if it doesnt exist.
            $file_contents = file_get_contents($dash_actions->file_path);
        }

        $dash_actions->contents = json_decode($file_contents, true);

        return $dash_actions;
    }

    private function setup() {
        $myfile = fopen($this->file_path, "w") or die("Unable to open file!");

        $data = json_encode([]);
        fwrite($myfile, $data);

        fclose($myfile);
    }

    public function save() : void {
        file_put_contents($this->file_path, json_encode($this->contents));
    } 

    public function items() : array {
        return $this->contents;
    }

    public function json() : string {
        return json_encode($this->contents);
    }

    public function addAction(array $action_details) : void {
        $this->contents[] = $action_details;
    }

    public function genTestData() : self {
        $this->addAction([
            "type" => "GET",
            "name" => "Bullhorn Report 1",
            "domain" => "www.bullhorn.com",
            "uri" => "/api/reports/1",
            "thumbnail" => "./src/img/logos/bullhorn/Bullhorn_logo_linear.png"
        ]);

        $this->addAction([
            "type" => "GET",
            "name" => "Bullhorn Report 2",
            "domain" => "www.bullhorn.com",
            "uri" => "/api/reports/2",
            "thumbnail" => "./src/img/logos/bullhorn/Bullhorn_logo_linear.png"
        ]);

        $this->addAction([
            "type" => "EXE",
            "name" => "Format WC Pay Report",
            "path" => "format-wc-pay-report",
            "thumbnail" => "./src/img/logos/bullhorn/Bullhorn_logo_linear.png"
        ]);

        $this->addAction([
            "type" => "EXE",
            "name" => "Merge Avionte and iSolved WC",
            "path" => "merge-avionte-isolved-wc",
            "thumbnail" => "./src/img/logos/isolved/isolved_logo_color_pos_RGB.png"
        ]);

        return $this;
    }
}
