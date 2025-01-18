<?php

class contact extends controller
{

    public function run()
    {
        if ($this->input() == null)
        {
            $this->data->contact_result = "";
        }
        else
        {
            $name = $this->xss_protect($this->input("name"));
            $mail = $this->xss_protect($this->input("mail"));
            $subject = $this->xss_protect($this->input("subject"));
            $message = $this->xss_protect($this->input("message"));
        }

        if ($this->segment(2) != null)
        {
            $this->redirect("/contact");
        }

        switch ($this->data->lang)
        {
            case "tr":
                $this->data->title = "İletişim";

                if (empty($name) || empty($mail) || empty($subject) || empty($message))
                {
                    $this->data->contact_result = "Alanlar boş olamaz!";
                }
                else
                {
                    $this->write_objects($name, $mail, $subject, $message);
                    $this->data->contact_result = "Mesajınız alındı!";
                }
                break;
            case "en":
                $this->data->title = "Contact";

                if (empty($name) || empty($mail) || empty($subject) || empty($message))
                {
                    $this->data->contact_result = "Fields cannot be empty!";
                }
                else
                {
                    $this->write_objects($name, $mail, $subject, $message);
                    $this->data->contact_result = "Your message has been received!";
                }
                break;
        }

        if ($this->input() == null)
        {
            $this->data->contact_result = "";
        }

        $this->view($this->data->lang."/parts/header", $this->data);
        $this->view($this->data->lang."/contact", $this->data);
        $this->view($this->data->lang."/parts/footer", $this->data);
    }

    public function xss_protect($data)
    {
         return str_replace
         (
             ["<", ">", "&", "'", '"', "/", ":", "#", "?"], "", $data
         );
    }

    public function write_objects($name, $mail, $subject, $message)
    {
        return file_put_contents
        (
            settings::$root."/messages/all.json",
            '{"name":"'.$name.'","mail":"'.$mail.'","subject":"'.$subject.'","message":"'.$message.'"},',
            FILE_APPEND | LOCK_EX
        );
    }

}