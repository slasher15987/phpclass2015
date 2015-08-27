<?php

function createCategory($value) {
    //category_id
    //category 
    //table name : categories
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO categories SET category = :cat");

// bind variables to sql statement
    $binds = array(
        ":cat" => $value,
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        return true;
    }
    return false;
}

function isValidCategory($value) {
    if ( empty($value)) {
        return false;
    }
    
    if ( preg_match("/^[a-zA-Z]+$/", $value ) == false) {
        return false;
    }
    return true;
    
}

function getAllCategories() {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM categories");
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    return $results;
    
}