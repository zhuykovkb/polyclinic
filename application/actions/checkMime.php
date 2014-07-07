<?php
function checkMime($file) {
    return strpos($file,'image') === 0 ? true : false;
}