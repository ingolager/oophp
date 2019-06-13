<?php

namespace Inla18\MyTextFilter;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Michelf\MarkdownExtra;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));
/**
 * Show all movies.
 */

 /**
  * This is the index method action, it handles:
  * ANY METHOD mountpoint
  * ANY METHOD mountpoint/
  * ANY METHOD mountpoint/index
  *
  * @return string
  */

class TextFilterController implements AppInjectableInterface
{
     use AppInjectableTrait;


    public function bbcodeAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/bbcode.txt");
        $html = $mytextfilter->bbcode2html($text);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/bbcode", $data);

        return $this->app->page->render();
    }

    public function clickableAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/clickable.txt");
        $html = $mytextfilter->makeClickable($text);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/clickable", $data);

        return $this->app->page->render();
    }

    public function markdownAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/sample.md");
        $html = $mytextfilter->markdown($text);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/markdown", $data);

        return $this->app->page->render();
    }

    public function parsebbcAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/bbcode.txt");

        $html = $mytextfilter->parse($text, ["bbcode"]);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/parsebbc", $data);

        return $this->app->page->render();
    }

    public function parseclickAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/clickable.txt");

        $html = $mytextfilter->parse($text, ["link"]);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/parseclick", $data);

        return $this->app->page->render();
    }

    public function parsemarkAction() : object
    {
        $mytextfilter = new MyTextFilter();
        $text = file_get_contents(__DIR__ . "/../../content/sample.md");

        $html = $mytextfilter->parse($text, ["markdown"]);

        $data = [
            "text" => $text,
            "html" => $html
        ];

        $this->app->page->add("mytextfilter/parsemark", $data);

        return $this->app->page->render();
    }
}
