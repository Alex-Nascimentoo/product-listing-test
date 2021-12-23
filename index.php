<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

echo $url;

?>