<?php

class RegisterController
{
    public function index()
    {
        try {
            $loader = new \Twig\Loader\FilesystemLoader('../app/View');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal("error", $_GET["error"]);

            $template = $twig->load("register.html");
            $conteudo = $template->render();

            echo $conteudo;
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }

    public function register()
    {
        try {
            $service = new RegisterService(
                $_POST["name"],
                $_POST["email"],
                $_POST["password"]
            );

            $service->register();

            return header("Location: /");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=register&error=$error");
        }
    }
}
