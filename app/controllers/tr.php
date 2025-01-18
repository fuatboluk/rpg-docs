<?php

class tr extends controller
{

    public function run()
    {
        setcookie("lang", "tr", time() + 3600);
        $this->redirect("/");
    }

}