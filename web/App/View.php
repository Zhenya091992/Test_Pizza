<?php

namespace App;

class View
{
    protected $config;
    protected $data = [];

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function render(string $template)
    {
        ob_start();
        foreach ($this->data as $prop => $value) {
            $$prop = $value;
        }
        include $this->config->configData['pathToTemplates'] . $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function addData(array $array)
    {
        $this->data = $array;
    }
}