<?php

namespace Inla18\Movie;


use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));
/**
 * Show all movies.
 */

class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function indexActionGet() : object {
        $title = "Movie database | oophp";

        $sql = "SELECT * FROM movie;";
        $this->app->db->connect();

        $resultset = $this->app->db->executeFetchAll($sql);

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchYearActionGet() : object {
        $title = "SELECT * WHERE year";
        $year1 = getGet("year1");
        $year2 = getGet("year2");

        $this->app->db->connect();

        if ($year1 && $year2) {
            $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        } elseif ($year1) {
            $sql = "SELECT * FROM movie WHERE year >= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year1]);
        } elseif ($year2) {
            $sql = "SELECT * FROM movie WHERE year <= ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$year2]);
        } else {
            $resultset = null;
        }

        $data = [
            "year1" => $year1,
            "year2" => $year2
        ];

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-year", $data);
        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function searchTitleActionGet() : object {
        $title = "SELECT * WHERE title";

        $searchTitle = getGet("searchTitle");

        $this->app->db->connect();

        if ($searchTitle) {
            $sql = "SELECT * FROM movie WHERE title LIKE ?;";
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        } else {
            $resultset = null;
        }

        $data = [
            "searchTitle" => $searchTitle
        ];

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/search-title", $data);
        $this->app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function selectAction() : object {
        $title = "SELECT * WHERE id";

        $this->app->db->connect();

        $sql = "SELECT id, title FROM movie;";
        $movies = $this->app->db->executeFetchAll($sql);

        $data = [
            "movies" => $movies
        ];

        $this->app->page->add("movie/navbar");
        $this->app->page->add("movie/select", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function selectActionPost() : object {

        $request = $this->app->request;
        $movieId = $request->getPost("movieId");
        $doDelete = $request->getPost('doDelete', null);
        $doAdd = $request->getPost('doAdd', null);
        $doEdit = $request->getPost('doEdit', null);

        $this->app->db->connect();

        if ($doDelete) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $this->app->db->execute($sql, [$movieId]);
            return $this->app->response->redirect("movie/movie-edit?movieId=$movieId", $data);
        } elseif ($doAdd) {
            $sql = "INSERT INTO movie (title, year, director, image) VALUES (?, ?, ?, ?);";
            $this->app->db->execute($sql, ["A title", 2017, "A director", "img/noimage.png"]);
            $movieId = $this->app->db->lastInsertId();
            return $this->app->response->redirect("movie/movie-edit?movieId=$movieId", $data);
        } elseif ($doEdit && is_numeric($movieId)) {
            return $this->app->response->redirect("movie/movie-edit?movieId=$movieId", $data);
        }

        // $data = [
        //     "movieId" => $movieId,
        //     "doDelete" => $doDelete,
        //     "doAdd" => $doAdd,
        //     "doEdit" => $doEdit
        // ];
        //
        // $this->app->page->add("movie/navbar");
        // $this->app->page->add("movie/movie-edit", $data);
        //
        // return $this->app->page->render();
    }

    public function editMovieAction() : object {
        $request = $this->app->request;
        $movieId    = $request->getGet("movieId");
        $movieTitle = $request->getPost("movieTitle");
        $movieYear  = $request->getPost("movieYear");
        $movieDirector = $request->getPost("movieDirector");
        $movieImage = $request->getPost("movieImage");
        $doSave = $request->getPost("doSave");

        $this->app->db->connect();

        $sql = "SELECT * FROM movie WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
        $movie = $movie[0];

        if ($doSave) {
            $sql = "UPDATE movie SET title = ?, year = ?, director = ?, image = ? WHERE id = ?;";
            $this->app->db->execute($sql, [$movieTitle, $movieYear, $movieDirector, $movieImage, $movieId]);
            $this->app->response->redirect("movie/movie-edit?movieId=$movieId");
        }

        $data = [
            "movie" => $movie
        ];

        $this->app->page->add("movie/movie-edit", $data);
    }
}
