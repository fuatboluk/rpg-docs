<?php

class faq extends controller
{

    public function run()
    {
        if ($this->segment(2) != null)
        {
            $this->redirect("/faq");
        }

        switch ($this->data->lang)
        {
            case "tr":
                $this->data->title = "Sıkça Sorulan Sorular";
                break;
            case "en":
                $this->data->title = "Frequently Asked Questions";
                break;
        }

        $this->view($this->data->lang."/parts/header", $this->data);
        $this->view($this->data->lang."/faq", $this->data);
        $this->view($this->data->lang."/parts/footer", $this->data);
    }

}