<?php

class en extends controller
{

    public function run()
    {
        setcookie("lang", "en", time() + 3600);
        $this->redirect("/");
    }

}