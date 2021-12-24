<?php

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

print_r($url);
echo substr($url['path'], 1);

?>