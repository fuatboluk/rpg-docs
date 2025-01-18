<?php

class docs extends controller
{

    public function run()
    {
        switch ($this->data->lang)
        {
            case "tr":
                switch ($this->segment(2))
                {
                    case "":
                        $this->data->title = "Belgeler";
                        break;
                    case "getting-started":
                        $this->data->title = "Başlarken";
                        break;
                    case "meet-rpg":
                        $this->data->title = "RPG ile Tanışın";
                        break;
                    case "installation":
                        $this->data->title = "Kurulum";
                        break;
                    case "configuration":
                        $this->data->title = "Yapılandırma";
                        break;
                    case "customization":
                        $this->data->title = "Özelleştirme";
                        break;
                }
                break;
            case "en":
                switch ($this->segment(2))
                {
                    case "":
                        $this->data->title = "Documentation";
                        break;
                    case "getting-started":
                        $this->data->title = "Getting Started";
                        break;
                    case "meet-rpg":
                        $this->data->title = "Meet RPG";
                        break;
                    case "installation":
                        $this->data->title = "Installation";
                        break;
                    case "configuration":
                        $this->data->title = "Configuration";
                        break;
                    case "customization":
                        $this->data->title = "Customization";
                        break;
                }
                break;
        }

        $this->view($this->data->lang."/parts/header", $this->data);

        switch ($this->segment(2))
        {
            case "getting-started":
            case "meet-rpg":

                $file = settings::$root."/app/views/".$this->data->lang.
                        "/sections/meet-rpg.html";

                if (is_file($file))
                {
                    $this->view($this->data->lang."/sections/meet-rpg", $this->data);
                }

                break;

            case "installation":
            case "configuration":
            case "customization":

                $file = settings::$root."/app/views/".$this->data->lang.
                        "/sections/".$this->segment(2).".html";

                if (is_file($file))
                {
                    $this->view($this->data->lang."/sections/".$this->segment(2), $this->data);
                }

                break;

            default:
                $this->redirect("/docs/meet-rpg");
        }

        $this->view($this->data->lang."/parts/footer", $this->data);
    }

}