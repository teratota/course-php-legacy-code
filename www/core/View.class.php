<?php
declare(strict_types=1);
namespace Core;
class View
{
    private $v;
    private $t;
    private $data = [];

    public function __construct(string $v, string $t="back")
    {
        $this->setView($v);
        $this->setTemplate($t);
    }

    public function setView(string $v)
    {
        $viewPath = "views/".$v.".view.php";
        if (file_exists($viewPath)) {
            $this->v=$viewPath;
        } else {
            die("Attention le fichier view n'existe pas ".$viewPath);
        }
    }

    public function setTemplate(string $t)
    {
        $templatePath = "views/templates/".$t.".tpl.php";
        if (file_exists($templatePath)) {
            $this->t=$templatePath;
        } else {
            die("Attention le fichier template n'existe pas ".$templatePath);
        }
    }

    public function addModal(string $modal, string $config)
    {
        $modalPath = "views/modals/".$modal.".mod.php";
        if (file_exists($modalPath)) {
            include $modalPath;
        } else {
            die("Attention le fichier modal n'existe pas ".$modalPath);
        }
    }

    public function assign(string $key, string $value)
    {
        $this->data[$key]=$value;
    }


    public function __destruct()
    {
        extract($this->data);
        include $this->t;
    }
}
