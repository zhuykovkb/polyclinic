<?php
/*Enable if it is needed*/
function errorUserAlreadyExists(){
    return '<p>Sorry, this user already exists</p>';
}
function errorUserNotFound(){
    return '<p>User not found</p>';
}
function errorEmptyInputDetected(){
    return '<p>Empty input detected.<br/>Fill it.</p>';
}
function errorWrongMimeType(){
    return '<p>U can upload only images</p>';
}
function succeedDeletion(){
    return '<p>Patient`s record has been successfully deleted</p>';
}
function succeedCreation(){
    return '<p>Done!<br/>New patient has been added.</p>';
}
function succeedUpdating(){
    return '<p>Done!<br/>Patient`s record has been successfully updated</p>';
}