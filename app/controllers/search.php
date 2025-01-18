<?php

class search extends controller
{

    public function run()
    {
        $search = str_replace
        (
            ["<", ">", "&", "'", '"', "/", ":", "#", "?"], "", 
            $this->input("search")
        );

        if ($this->segment(2) != null)
        {
            $this->redirect("/");
        }

        switch ($this->data->lang)
        {
            case "tr":
                $this->data->title = "Ara";
                $this->data->search_nodata = "Bulunamadı!";
                $this->data->search_nocontent = " için sonuç bulunamadı!";
                break;
            case "en":
                $this->data->title = "Search";
                $this->data->search_nodata = "Not Found!";
                $this->data->search_nocontent = "No results found for ";
                break;
        }

        $this->view($this->data->lang."/parts/header", $this->data);

        $dir = settings::$root."/app/views/".$this->data->lang."/sections/";
        $array = glob($dir."*.html");

        if ($search != null)
        {
            $count = 0;
            $urls = array();

            foreach ($array as $file)
            {
                $data = file_get_contents($file);
                $result = stripos($data, $search);
    
                if ($result == true)
                {
                    $parse = explode(".", $file);
                    $doc = explode("/", $parse[0]);

                    array_push($urls, settings::$scheme."://".settings::$host."/docs/".end($doc));

                    $count++;
                }
            }

            $this->view($this->data->lang."/response/header");
            
            if ($count == 0)
            {
                $this->data->response_name = $this->data->search_nodata;
                $this->data->response_id = strtolower
                (
                    str_replace
                    (
                        ["ü","ğ","ı","ş","ç","ö", " ", "Ü","Ğ","İ","Ş","Ç","Ö", "!"], 
                        ["u","g","i","s","c","o", "_", "u","g","i","s","c","o", ""], 
                        $this->data->response_name
                    )
                );

                if ($this->data->search_nocontent[-1] == "!")
                {
                    $this->data->search_query = $search.$this->data->search_nocontent;
                }
                else
                {
                    $this->data->search_query = $this->data->search_nocontent.$search."!";
                }

                $this->view($this->data->lang."/response/no-content", $this->data);
            }
            else
            {
                foreach ($urls as $url)
                {
                    $this->data->response_name = $this->title(end(explode("/", $url)));
                    $this->data->response_url = $url;
                    $this->data->search_query = $search;
                    $this->data->response_id = strtolower
                    (
                        str_replace
                        (
                            ["ü","ğ","ı","ş","ç","ö", " ", "Ü","Ğ","İ","Ş","Ç","Ö"], 
                            ["u","g","i","s","c","o", "_", "u","g","i","s","c","o"], 
                            $this->data->response_name
                        )
                    );

                    $this->view($this->data->lang."/response/content", $this->data);
                }
            }

            $this->view($this->data->lang."/response/footer");
        }

        $this->view($this->data->lang."/parts/footer", $this->data);
    }

    public function title($url)
    {
        switch ($url)
        {
            case "meet-rpg":
                switch ($this->data->lang)
                {
                    case "tr":
                        return "RPG ile Tanışın";
                        break;
                    case "en":
                        return "Meet RPG";
                        break;
                }
                break;
            case "installation":
                switch ($this->data->lang)
                {
                    case "tr":
                        return "Kurulum";
                        break;
                    case "en":
                        return "Installation";
                        break;
                }
                break;
            case "configuration":
                switch ($this->data->lang)
                {
                    case "tr":
                        return "Yapılandırma";
                        break;
                    case "en":
                        return "Configuration";
                        break;
                }
                break;
            case "customization":
                switch ($this->data->lang)
                {
                    case "tr":
                        return "Özelleştirme";
                        break;
                    case "en":
                        return "Customization";
                        break;
                }
                break;
        }
    }

}