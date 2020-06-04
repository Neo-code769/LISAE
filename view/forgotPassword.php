<?php

    try {
        $controller = new MainController())->run(2);
        $controller->run();
    }
    catch (LisaeException $e) {
        die ($e->render());
    }
    finally {
        exit();
    }

?>