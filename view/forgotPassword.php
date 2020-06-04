<?php

    echo 'Page ok';

    try {
        $controller = (new PasswordController())->run();
        $controller->run();
    }
    catch (LisaeException $e) {
        die ($e->render());
    }
    finally {
        exit();
    }

?>