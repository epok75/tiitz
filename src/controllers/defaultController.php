<?php
/**
 * This class is call by /src/config/routing.yml
 * when no parameters are passed.
 * You can change is behavior, do what you want.
 */
class defaultController extends TzController {

    // first method call when the website is launched
    public function showAction () {

        $postsEntity = tzSQL::getEntity("posts");

        $posts = $postsEntity->findAll();

        var_dump($posts);

        $this->tzRender->run('/templates/default');
    }
}