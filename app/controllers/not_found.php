<?php

class not_found extends controller
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
                $this->data->title = "Sayfa bulunamadı!";
                break;
            case "en":
                $this->data->title = "Page not found!";
                break;
        }

        $this->view($this->data->lang."/parts/header", $this->data);

        echo "<div style=height:240px;text-align:center;margin-top:240px;font-size:64px;>404</div>";

        $this->view($this->data->lang."/parts/footer", $this->data);
    }

}