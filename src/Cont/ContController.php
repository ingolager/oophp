<?php

namespace Inla18\Cont;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));
/**
 * Show all movies.
 */

class ContController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexAction() : object
    {
        $title = "Visa allt innehåll";

        $sql = "SELECT * FROM content;";
        $this->app->db->connect();

        $resultset = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $resultset,
        ];

        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/index", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function adminAction() : object
    {
        $title = "Administrera";

        $sql = "SELECT * FROM content;";
        $this->app->db->connect();

        $resultset = $this->app->db->executeFetchAll($sql);

        $data = [
            "resultset" => $resultset,
        ];

        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/admin", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editAction() : object
    {
        $request = $this->app->request;
        $title = "Redigera";
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");

        $this->app->db->connect();

        if (!is_numeric($contentId)) {
            die("Not valid for content id.");
        }

        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->app->db->executeFetch($sql, [$contentId]);

        $data = [
            "content" => $content,
        ];

        $this->app->page->add("cont/navbar", $data);
        $this->app->page->add("cont/edit", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function editActionPost() : object
    {
        $request = $this->app->request;
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");
        $doDelete = hasKeyPost("doDelete");
        $doSave = hasKeyPost("doSave");
        $this->app->db->connect();

        $sqlSlugs = "SELECT slug FROM content";
        $slugs = $this->app->db->executeFetchAll($sqlSlugs);
        $slugsArray = json_decode(json_encode($slugs), true);
        $check = [];
        foreach ($slugsArray as $key => $value) {
            foreach ($value as $keys => $values) {
                array_push($check, $values);
            }
        }

        $sqlSlug = "SELECT slug FROM content WHERE id=?";
        $slug = $this->app->db->executeFetch($sqlSlug, [$contentId]);
        $current = json_decode(json_encode($slug), true);
        $currString = implode("", $current);

        if ($doDelete) {
            $this->app->response->redirect("cont/delete?id=$contentId");
        } elseif ($doSave) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (in_array($params["contentSlug"], $check)) {
                if ($params["contentSlug"] !== $currString) {
                    $params["contentSlug"] = $params["contentSlug"] . rand();
                }
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

            $this->app->db->execute($sql, array_values($params));
            $this->app->response->redirect("cont/edit?id=$contentId");
        }
    }

    public function createAction() : object
    {
        $title = "Skapa nytt innehåll";

        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/create");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function createActionPost() : object
    {
        $request = $this->app->request;
        $doCreate = hasKeyPost("doCreate");
        $this->app->db->connect();

        if ($doCreate) {
            $title = $request->getPost("contentTitle");

            $sql = "INSERT INTO content (title) VALUES (?);";
            $this->app->db->execute($sql, [$title]);
            $id = $this->app->db->lastInsertId();
            $this->app->response->redirect("cont/edit?id=$id");
        }
    }

    public function deleteAction() : object
    {
        $request = $this->app->request;
        $title = "Radera";
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");

        $this->app->db->connect();

        if (!is_numeric($contentId)) {
            die("Not valid for content id.");
        }

        $sql = "SELECT * FROM content WHERE id = ?;";
        $content = $this->app->db->executeFetch($sql, [$contentId]);

        $data = [
            "content" => $content
        ];

        $this->app->page->add("cont/navbar", $data);
        $this->app->page->add("cont/delete", $data);
        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function deleteActionPost() : object
    {
        $request = $this->app->request;
        $this->app->db->connect();

        if (hasKeyPost("doDelete")) {
            $contentId = $request->getPost("contentId");
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $this->app->db->execute($sql, [$contentId]);
            $this->app->response->redirect("cont/admin");
        }
    }

    public function pagesAction() : object
    {
        $title = "View pages";
        $this->app->db->connect();

        $sql = <<<EOD
    SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "Raderad"
        WHEN (published <= NOW()) THEN "Publicerad"
        ELSE "Ej publicerad"
    END AS status
    FROM content
    WHERE type=?
    ;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);

        $data = [
            "resultset" => $resultset
        ];

        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/pages", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function pageAction($slug) : object
    {
        $this->app->db->connect();

            $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

            $sqlFilter = <<<EOD
SELECT
    filter
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

        $newTextFilter = new NewTextFilter();

        $content = $this->app->db->executeFetch($sql, [$slug, "page"]);

        $filter = $this->app->db->executeFetch($sqlFilter, [$slug, "page"]);
        $filter = json_decode(json_encode($filter), true);
        $filter = implode(",", $filter);
        $filter = explode(",", $filter);

        if (!$content) {
            $this->app->response->redirect("HTTP/1.0 404 Not Found");
            $title = "404";
            $this->app->page->add("cont/navbar");
            $this->app->page->add("cont/404");

            return $this->app->page->render([
                "title" => $title,
            ]);
        }

        $content->data = $newTextFilter->parse($content->data, $filter);

        $data = [
            "content" => $content
        ];

        $title = $content->title;
        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/page", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function bloggAction() : object
    {
        $title = "Min blogg";
        $this->app->db->connect();
        $request = $this->app->request;
        $contentId = $request->getGet("id");

        $sql = <<<EOD
    SELECT
        *,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
    FROM content
    WHERE type=?
    AND (deleted IS NULL OR deleted > NOW())
    ORDER BY published DESC
    ;
EOD;

        $sqlFilter = <<<EOD
    SELECT
        filter
    FROM content
    WHERE type=?
    ORDER BY published DESC
    ;
EOD;

        $newTextFilter = new NewTextFilter();

        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);

        $filterObject = $this->app->db->executeFetchAll($sqlFilter, ["post"]);
        $filter = json_decode(json_encode($filterObject), true);

        foreach ($resultset as $key => $value) {
            $value->filter = explode(",", $value->filter);
            $value->data = $newTextFilter->parse($value->data, $value->filter);
        }

        $data = [
            "resultset" => $resultset
        ];

        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/blogg", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function blogAction($slug) : object
    {
        $this->app->db->connect();

            $sql = <<<EOD
    SELECT
        *,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
    FROM content
    WHERE
        slug = ?
        AND type = ?
        AND (deleted IS NULL OR deleted > NOW())
        AND published <= NOW()
    ORDER BY published DESC
;
EOD;

        $sqlFilter = <<<EOD
SELECT
    filter
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;

        $newTextFilter = new NewTextFilter();

        $content = $this->app->db->executeFetch($sql, [$slug, "post"]);

        $filter = $this->app->db->executeFetch($sqlFilter, [$slug, "post"]);
        $filter = json_decode(json_encode($filter), true);
        $filter = implode(",", $filter);
        $filter = explode(",", $filter);

        if (!$content) {
            $this->app->response->redirect("HTTP/1.0 404 Not Found");
            $title = "404";
            $this->app->page->add("cont/navbar");
            $this->app->page->add("cont/404");

            return $this->app->page->render([
                "title" => $title,
            ]);
        }

        $content->data = $newTextFilter->parse($content->data, $filter);

        $data = [
            "content" => $content
        ];

        $title = $content->title;
        $this->app->page->add("cont/navbar");
        $this->app->page->add("cont/blog", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }
}
