<?php
$cat_1 = DB::table('Category_1')->select('id','name')->get();
$cat_2 = DB::table('Category_2')->select('id','name','parent')->get();
$category =[];
foreach ($cat_1 as $node) {
    if (json_encode($node).hasKey('parent')) {
        echo 'a';
    }
    echo json_encode($node);
    $node->sub = [];
    array_push($category, $node);
}
//array_push($category[0]->sub,$cat_2[0]);
$root = $category;
foreach ($cat_2 as $node) {
    $node->sub = [];
    foreach ($root as $abc) {
        if ($abc->id==$node->id) {
            array_push($abc->sub, $node);
        }
    }
}
//function addChild($root, $node) {
//    $node->sub = [];
//    if ($node->parent==null) {
//        array_push($root, $node);
//    } else {
//        foreach ($root as $abc) {
//            if ($abc->id==$node->parent) {
//                array_push($abc->sub, $node);
//            }
//        }
//    }
//}
//echo json_encode($category);
?>