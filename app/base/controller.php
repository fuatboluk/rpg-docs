<?php

class controller extends rpg
{

    protected $data;

    public function __construct()
    {
        $this->data                 = new stdClass;

        $this->data->logo           = "RPG Framework";
        $this->data->host           = settings::$scheme."://".settings::$host;

        $this->data->home_url       = "index";
        $this->data->docs_url       = "docs";
        $this->data->contact_url    = "contact";

        $this->data->github         = "https://github.com/fuatboluk/rpg-framework";
        $this->data->linkedin       = "https://www.linkedin.com/in/rpg-framework";

        if (isset($_COOKIE["lang"]))
        {
            if ($_COOKIE["lang"] == "tr")
            {
                $this->data->home        = "Anasayfa";
                $this->data->docs        = "Belgeler";
                $this->data->contact     = "İletişim";
                $this->data->language    = "Dil";
                $this->data->lang        = "tr";
                $this->data->tr          = "Türkçe";
                $this->data->en          = "İngilizce";
                $this->data->copyright   = "Telif Hakkı © 2025";
                $this->data->last_update = "18 Ocak 2025";
                $this->data->note        = "Not";
                $this->data->tip         = "İpucu";
                $this->data->info        = "Bilgi";
                $this->data->warning     = "Uyarı";
            }

            if ($_COOKIE["lang"] == "en")
            {
                $this->data->home        = "Home";
                $this->data->docs        = "Documentation";
                $this->data->contact     = "Contact";
                $this->data->language    = "Language";
                $this->data->lang        = "en";
                $this->data->tr          = "Turkish";
                $this->data->en          = "English";
                $this->data->copyright   = "Copyright © 2025";
                $this->data->last_update = "18 January 2025";
                $this->data->note        = "Note";
                $this->data->tip         = "Tip";
                $this->data->info        = "Info";
                $this->data->warning     = "Warning";
            }
        }
        else
        {
            $this->redirect("/en");
        }

        if ($this->segment(1) == "" || $this->segment(1) == settings::$index || $this->segment(1) == "search")
        {
            $this->data->drop_color = "text-white";
            $this->data->header_img = "images/banner.jpg";
            $this->data->header_css = "banner overlay bg-cover";
            $this->data->navbar_css = "navbar navbar-expand-md navbar-dark";
            $this->data->search     = file_get_contents(
                                          settings::$root."/app/views/".$this->data->lang.
                                          "/parts/search.html"
                                      );
        }
        else
        {
            $this->data->drop_color = "text-dark";
            $this->data->header_img = "";
            $this->data->header_css = "shadow-bottom sticky-top bg-white";
            $this->data->navbar_css = "navbar navbar-expand-md navbar-light";
            $this->data->search     = "";
        }
    }

}