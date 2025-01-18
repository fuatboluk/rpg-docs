<?php

class index extends controller
{

    public function run()
    {
        if ($this->segment(2) != null)
        {
            $this->redirect("/");
        }

        switch ($this->data->lang)
        {
            case "tr":
                $this->data->title = "Anasayfa";
                break;
            case "en":
                $this->data->title = "Home";
                break;
        }

        $this->view($this->data->lang."/parts/header", $this->data);
        $this->view($this->data->lang."/index", $this->data);
        $this->view($this->data->lang."/parts/footer", $this->data);
    }

}