<?php

/*
    All routes and functions are here.
    "UX Review" web app, by Conor Gould s5007332 September 2018
*/

/* Route for home page, returns an array for items, an array
    for average ratings, and an array for number of reviews */
Route::get('/', function(){
    $sql = "select * from item";
    /* Store all data from item table in $items */
    $items = DB::select($sql);
    /* Build array of average ratings */
    $averages = array();
    $revcount = array();
    /* For each item, get the average
        and store it as the value where
        the key is the item id */
    foreach($items as $item){
        $avg = get_avg($item->id);
        $averages[$item->id] = $avg;
    }
    /* For each item, get the number of reviews
        and store in as the value where
        the key is the item id */
    foreach($items as $item){
        $num = count(get_reviews($item->id));
        $revcount[$item->id] = $num;
    }
    /* Go to home page, sending important arrays of data */
    return view('items.uxr_home', ['items' => $items])->with('averages', $averages)->with('revcount', $revcount);
});

/* Route for items sorted by average rating */
Route::get('ux_byrating', function(){
    $sql = "select * from item";
    /* Get all item data */
    $items = DB::select($sql);
    $averages = array();
    /* For each item, get the average rating
        and store in associative array*/
    foreach($items as $item){
        $avg = get_avg($item->id);
        $averages[$item->id] = $avg;
    }
    /* Sort the array by the value of average rating */
    arsort($averages);
    /* Get the item ids, in order of highest average rating */
    /* array_keys() get keys from $averages and stores in $ids */
    $ids = array_keys($averages);
    $byrating = array();
    /* Loop through sorted ids, calling information and
        storing it in a new associative array */
    foreach($ids as $id){
        $info = get_ux($id);
        $byrating[$id] = $info;
    }
    return view('items.ux_byrating', ['items' => $items])->with('averages', $averages)->with('byrating', $byrating);
});

/* Route for items sorted by number of reviews */
Route::get('ux_byviews', function(){
    $sql = "select * from item";
    $items = DB::select($sql);
    $revcount = array();
    /* For each item, get the number of reviews */
    foreach($items as $item){
        /* Call get_reviews() to get all reviews for
            an item, then get length of the array with
            count(). Store results in an array. */
        $num = count(get_reviews($item->id));
        $revcount[$item->id] = $num;
    }
    /* Sort the array from high to low (by value) */
    arsort($revcount);
    /* Get the item ids, in order of highest no. of views */
    /* array_keys() gets keys from $revcount and stores in $ids */
    $ids = array_keys($revcount);
    $byviews = array();
    /* Loop through sorted ids, calling information and
        storing it in a new associative array */
    foreach($ids as $id){
        $info = get_ux($id);
        $byviews[$id] = $info;
    }
    return view('items.ux_byviews', ['items' => $items])->with('revcount', $revcount)->with('byviews', $byviews);
});

/* Route for review page for item.
    id number on end of URL determines which
    page to display. $id is passed to route. */
Route::get('ux_reviews/{id}', function($id){
    /* Get all info for item */
    $item = get_ux($id);
    /* Get all reviews for item */
    $reviews = get_reviews($item->id);
    /* Get number of reviews  */
    $revcount = count($reviews);
    /* Get average rating */
    $average = get_avg($item->id);
    return view('items.ux_reviews')->with('item', $item)->with('reviews', $reviews)->with('revcount', $revcount)->with('average', $average);
});

/* Route for form to add item */
Route::get('add_item', function(){
    return view('items.add_item');
});

Route::get('failure', function(){
    return view('items.failure');
});

/* Route for form to add review.
    $id determines which item is getting the
    review */
Route::get('add_review/{id}', function($id){
    /* Get info on item */
    $item = get_ux($id);
    return view('items.add_review')->with('item', $item);
});

/* Route for software documentation */
Route::get('documentation', function(){
   return view('items.documentation'); 
});


/* Route for form to update/edit item.
    $id determines which item is edited. */
Route::get('update_item/{id}', function($id){
    /* Get info on item */
    $item = get_ux($id);
    return view('items.update_item')->with('item', $item);
});

/* Route for list of designers */
Route::get('designers', function(){
    /* Request unique designer names */
    $sql = "select distinct designer from item";
    $designers = DB::select($sql);
    return view('items.designers')->with('designers', $designers);
});

/* Route for designer's page */
Route::get('designer/{designer}', function($designer){
    /* Get array of items done by designer */
    $portfolio = get_work($designer);
    return view('items.designer')->with('portfolio', $portfolio);
});

/* Route for form to update review */
Route::get('update_review/{id}/{username}', function($id, $username){
    /* Get information from review */
    $review = get_single_review($username, $id);
    $item = get_ux($id);
    return view('items.update_review')->with('item', $item)->with('review', $review);
});

/* Route for adding karma */
Route::get('good_karma/{id}/{username}', function($id, $username){
    /* Get the review's data */
    $review = get_single_review($username, $id);
    /* Add 1 to the review's score */
    $newscore = ($review->score) + 1;
    /* Call function to update the review table */
    $itemid = update_karma($newscore, $username, $id);
    /* Send user back to where they came from */
    return redirect("/ux_reviews/$id");
});

/* Route for losing karma, same process as described above */
Route::get('bad_karma/{id}/{username}', function($id, $username){
    $review = get_single_review($username, $id);
    $newscore = ($review->score) - 1;
    $itemid = update_karma($newscore, $username, $id);
    return redirect("/ux_reviews/$id");
});

/* Route for form for deleting an item */
Route::get('remove_item/{id}', function($id){
    /* Get info on item */
    $item = get_ux($id);
    return view('items.remove_item')->with('item', $item);
});

/* Route for deleting item */
Route::get('item_deleted', function(){
    return view('items.item_deleted');
});

/* Route for list of users by karma total */
Route::get('user_bykarma', function(){
    /* Get list of unique usernames */
    $sql = "select distinct username from review";
    $users = DB::select($sql);
    /* For each user, use get_karma() to find
        their total karma rating, then add this
        to the array*/
    $ranked = array();
    foreach($users as $user){
        foreach($user as $elem){
            $karma = get_karma($elem);
            $ranked[$elem] = $karma;
        }
    }
    /* Sort the array from high to low */
    arsort($ranked);
    return view('items.user_bykarma')->with('ranked', $ranked);
});

/* Route for adding item action, activated by form submission */
Route::post('add_item_action', function(){
    /* Get fields from form */
    $name = request('name');
    $designer = request('designer');
    $summary = request('summary');
    $link = request('link');
    /* Check that all fields are filled */
    if (empty($name) || empty($designer) || empty($summary) || empty($link)){
        $error = "ERROR: All fields must be completed.";
        return view('items.failure')->with('error', $error);
    }
    /* Get info on designer, check that item doesn't exist already */
    $sql = "select name from item where designer = ?";
    $items = DB::select($sql, array($designer));
    foreach ($items as $item){
        foreach($item as $unique){
            if ($unique == $name){
                $error = "ERROR: Item's name must be unique for its designer.";
                return view('items.failure')->with('error', $error);
            }
        }
    }
    /* Call function to add item */
    $id = add_item($name, $designer, $summary, $link);
    /* Check if success or not */
    if ($id){
        return redirect("/ux_reviews/$id");
    }
    else{
        die("Error adding item");
    }
});

/* Route for adding review, redirects to item's page if successful */
Route::post('add_review_action', function(){
    /* Get fields from form */
    $name = request('name');
    $designer = request('designer');
    $username = request('username');
    $rating = request('rating');
    $description = request('description');
    $id = request('id');
    /* Get all usernames */ 
    $sql = "select distinct username from review";
    $users = DB::select($sql);
    /* Validate input, ensure username hasn't reviewed already */
    foreach($users as $user){
        foreach($user as $elem){
            if ($elem == $username){
                /* If user exists already, go to error page */
                $error = "User can only leave one review per item.";
                return view('items.failure')->with('error', $error);
            }
        }
    }
    /* Check that all fields are filled */
    if (empty($description) || empty($username)){
        $error = "ERROR: All fields must be completed.";
        return view('items.failure')->with('error', $error);
    }
    /* Call function to add review */
    $productid = add_review($username, $id, $rating, $description);
    /* Check if successful at database level */
    if ($productid){
        return redirect("/ux_reviews/$productid");
    }
    else{
        die("Error adding item.");
    }
});

/* Route for updating review, redirects to item's page if successful */
Route::post('update_review_action', function(){
    /* Get fields from form */
    $username = request('username');
    $rating = request('rating');
    $description = request('description');
    $itemid = request('id');
    /* Check that all fields are filled */
    if (empty($description)){
        $error = "ERROR: All fields must be completed.";
        return view('items.failure')->with('error', $error);
    }
    /* Call function to udpate review */
    $id = update_review($username, $itemid, $rating, $description);
    /* Check if successful */
    if ($id){
        return redirect("/ux_reviews/$id");
    }
    else{
        die("Error adding item");
    }
});

/* Route for updating item, redirects to item's page if successful */
Route::post('update_item_action', function(){
    /* Get fields from form */
    $id = request('id');
    $name = request('name');
    $designer = request('designer');
    $summary = request('summary');
    $link = request('link');
    /* Check that all fields are filled */
    if (empty($name) || empty($designer) || empty($summary) || empty($link)){
        $error = "ERROR: All fields must be completed.";
        return view('items.failure')->with('error', $error);
    }
    /* Get info on designer, check that item doesn't exist already */
    $sql = "select name from item where designer = ?";
    $items = DB::select($sql, array($designer));
    foreach ($items as $item){
        foreach($item as $unique){
            if ($unique == $name){
                $error = "ERROR: Item's name must be unique for its designer.";
                return view('items.failure')->with('error', $error);
            }
        }
    }
    /* Call function to udpate item */
    $itemid = update_item($name, $designer, $summary, $link, $id);
    /* Check if successful */
    if ($itemid){
        return redirect("/ux_reviews/$itemid");
    }
    else{
        die("Error updating item");
    }
});

/* Route for deleting an item, activated by delete item form submission */
Route::post('remove_item_action', function(){
    /* Get fields from form */
    $name = request('name');
    $designer = request('designer');
    $id = request('id');
    delete_item($id);
    return redirect("/item_deleted");
});

/*
/     Functions used by routes
*/

/* Gets all data for an item's id */
function get_ux($id){
    $sql = "select * from item where id=?";
    $items = DB::select($sql, array($id));
    /* Check if successful */
    if (count($items) != 1){
        die("Something went wrong, invalid query or result: $sql");
    }
    $item = $items[0];
    return $item;
}

/* Get the items owned by a designer */
function get_work($designer){
    $sql = "select * from item where designer=?";
    $portfolio = DB::select($sql, array($designer));
    return $portfolio;
}

/* Get the reviews for an item's id */
function get_reviews($id){
    $sql = "select username, rating, description, score FROM item, review WHERE item.id = review.itemid AND item.id=?";
    $reviews = DB::select($sql, array($id));
    return $reviews;
}

/* Get the review pointed to by a username and an item's id */
function get_single_review($username, $itemid){
    $sql = "select * from review where username=? and itemid=?";
    $review = DB::select($sql, array($username, $itemid));
    return $review[0];
}

/* Get the average rating for an item */
function get_avg($id){
    /* If there are no reviews, set value to 'No reviews' */
    $sql = "SELECT ifnull(round(avg(rating), 1), '- No reviews -') FROM item, review WHERE item.id = review.itemid AND item.id=?";
    $average = DB::select($sql, array($id));
    return $average[0];
}

/* Get the item info when given the name and the designer */
function get_id($name, $designer){
    $sql = "select * from item where name=? and designer=?";
    $items = DB::select($sql, array($name, $designer));
    /* Check if successful */
    if (count($items) != 1){
        die("Something went wrong, invalid query or result: $sql");
    }
    $item = $items[0];
    return $item;
}

/* Add a new item */
function add_item($name, $designer, $summary, $link){
    $sql = "insert into item (name, designer, summary, link) values (?,?,?,?)";
    DB::insert($sql, array($name, $designer, $summary, $link));
    /* Get the id of new item */
    $id = DB::getPdO()->lastInsertId();
    return $id;
}

/* Add a review */
function add_review($username, $itemid, $rating, $description){
    $sql = "insert into review (username, itemid, rating, description) values (?,?,?,?)";
    try{
        DB::insert($sql, array($username, $itemid, $rating, $description));
    } catch (PDOException $e){
        return $itemid = False;
    }
    return $itemid;
}

/* Update an item */
function update_item($name, $designer, $summary, $link, $id){
    $sql = "update item set name = ?, designer = ?, summary = ?, link = ? where id = ?";
    DB::update($sql, array($name, $designer, $summary, $link, $id));
    return $id;
}

/* Update review */
function update_review($username, $itemid, $rating, $description){
    $sql = "update review set username = ?, rating = ?, description = ? where itemid = ? and username = ?";
    DB::update($sql, array($username, $rating, $description, $itemid, $username));
    return $itemid;
}

/* Update karma score */
function update_karma($newscore, $username, $id){
    $sql = "update review set score = ? where itemid = ? and username = ?";
    DB::update($sql, array($newscore, $id, $username));
    return $id;
}

/* Get the karma total for a user */
function get_karma($username){
    $sql = "select sum(score) from review where username = ?";
    $karma = DB::select($sql, array($username));
    return $karma[0];
}

/* Delete an item given it's id */
function delete_item($id){
    $sql = "delete from item where id = ?";
    DB::delete($sql, array($id));
    $sequel = "delete from review where itemid = ?";
    DB::delete($sequel, array($id));
}

/* Error checker, input validation */
function delete_err($name, $designer) {
  if (empty($name) || empty($designer)) {
    $error = "Error: Please fill both fields\n";
  } 
  else {
    $error = "";
  }
  return $error;
}