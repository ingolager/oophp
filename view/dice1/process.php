<?php

namespace Anax\View;

$_SESSION["roll"] = $_POST["roll"] ?? null;

$_SESSION["savePoints"] = $_POST["savePoints"] ?? null;

$_SESSION["doInit"] = $_POST["doInit"] ?? null;

var_dump($_SESSION["roll"]);

$url = "/play";
header("Location: $url");
