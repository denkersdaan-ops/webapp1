<?php

include_once "loadDb.php";

$action = '';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
}

if ($action == 'add-category') {
    addCategory($pdo);
}

if ($action == 'add-product') {
    addProduct($pdo);
}

if ($action == 'remove-category') {
    removeCategory($pdo);
}

if ($action == 'remove-product') {
    removeProduct($pdo);
}

if ($action == 'get-category') {
    getCategory($pdo);
}

if ($action == 'get-product') {
    getProduct($pdo);
}

if ($action == 'change-category') {
    changeCategory($pdo);
}

if ($action == 'change-product') {
    changeProduct($pdo);
}

function addCategory($pdo)
{
    $data = json_decode($_POST['data'], true);

    $sql = "INSERT INTO category (name, image) VALUES (:name, :image)";

    $name = '';
    if (isset($data['name'])) {
        $name = $data['name'];
    }
    $image = '';
    if (isset($data['image'])) {
        $image = $data['image'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Category added successfully.' , 'data' => ['id' => $pdo->lastInsertId(), 'name' => $name, 'image' => $image]]);
    exit;
}

function addProduct($pdo)
{
    $data = json_decode($_POST['data'], true);

    $sql = "INSERT INTO product (name, info, price, category_id) VALUES (:name, :info, :price, :category_id)";
    $name = '';
    if (isset($data['name'])) {
        $name = $data['name'];
    }
    $info = '';
    if (isset($data['info'])) {
        $info = $data['info'];
    }
    $price = '';
    if (isset($data['price'])) {
        $price = $data['price'];
    }

    // Get category_id from category name
    $categorie_name = '';
    if (isset($data['category_id'])) {
        $categorie_name = $data['category_id'];
    }
    $stmt2 = $pdo->prepare("SELECT id FROM category WHERE name = :name");
    $stmt2->execute([':name' => $categorie_name]);
    $categorie_id = $stmt2->fetchColumn();

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':info', $info, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $categorie_id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Product added successfully.']);
    exit;
}

function removeCategory($pdo)
{
    $sql = "DELETE FROM category WHERE id = :id";

    $id = '';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Category removed successfully.']);
    exit;
}

function removeProduct($pdo)
{
    $sql = "DELETE FROM product WHERE id = :id";

    $id = '';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Product removed successfully.']);
    exit;
}

function getCategory($pdo)
{
    $id = '';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $stmt = $pdo->prepare("SELECT * FROM category WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        echo json_encode(['success' => true, 'data' => $category]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Category not found.']);
    }
    exit;
}

function getProduct($pdo)
{
    $id = '';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode(['success' => true, 'data' => $product]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
    }
    exit;
}

function changeCategory($pdo)
{
    $data = json_decode($_POST['data'], true);

    $sql = "UPDATE category SET name = :name, image = :image WHERE id = :id";

    $id = '';
    if (isset($data['id'])) {
        $id = $data['id'];
    }
    $name = '';
    if (isset($data['name'])) {
        $name = $data['name'];
    }
    $image = '';
    if (isset($data['image'])) {
        $image = $data['image'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':image', $image, PDO::PARAM_STR);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Category updated successfully.']);
    exit;
}

function changeProduct($pdo)
{
    $data = json_decode($_POST['data'], true);

    $sql = "UPDATE product SET name = :name, info = :info, price = :price, category_id = :category_id WHERE id = :id";

    $id = '';
    if (isset($data['id'])) {
        $id = $data['id'];
    }
    $name = '';
    if (isset($data['name'])) {
        $name = $data['name'];
    }
    $info = '';
    if (isset($data['info'])) {
        $info = $data['info'];
    }
    $price = '';
    if (isset($data['price'])) {
        $price = $data['price'];
    }
    $category_id = '';
    if (isset($data['category_id'])) {
        $category_id = $data['category_id'];
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':info', $info, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Product updated successfully.']);
    exit;
}