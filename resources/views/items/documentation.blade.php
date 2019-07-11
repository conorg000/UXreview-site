{{--Documenting the journey. An overview of how the project went, what went well, what was difficult.--}}
@extends('layouts.master')

@section('title')
  Assignment Documentation
@endsection

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>2703ICT Assignment Documentation</h1>
      <img src="https://s5.postimg.cc/mmd3m76uf/uxui.png" style="display: block; margin-left: auto; margin-right: auto;" height=450>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h2>Conor Gould s5007332</h2>
      <h2>Overview</h2>
      <p>The goal of the assignment was to produce a simple "review" web application, making use of Laravel and the DB class.</p>
      <p>My review application is called "UX review" and it's intended to be a platform where people can review and critique the UX/UI of website and apps. Users
      can find a website and then leave a review, along with a rating out of 5. Users can also add new websites for other people to review. There are rankings which
      list items by their average rating and by their number of reviews. All users have the ability to add/edit/delete items. They can also edit reviews.</p>
      <p>Extra functionality: There is also an incentive scheme for reviewers. Users who leave helpful reviews can receive
      good karma (Reddit-esque upvote system) which boosts their "Reviewer Ranking".</p>
      <h2>Database</h2>
      <p><img src="https://s5.postimg.cc/6l2l9m987/xml.jpg"></p>
      <p><code>item(id, name, designer, summary, link)</code></p>
      <p><code>review(username, itemid, rating, description, score)</code></p>
      <p>The database was a simple setup, with just two tables (as seen in the ER diagram above).</p>
      <p>The table called 'item' has data for the items (websites/apps) listed on "UX review". It contains a unique id, name, designer, summary 
      and link. The <code>id</code> is the primary key and must therefore be unique to each item. It autoincrements its value (making the safe creation
      of new items easier). None of these attributes can be <code>NULL</code>.</p>
      <p>The table called 'review' has data for the reviews left on "UX review". It contains a username, item id, rating, description and score (score is discussed later in the documentation). 
      Since a user can only make one review per item, the unique primary key can easily be made from the <code>username</code> and <code>itemid</code> attributes
      as a composite primary key. The <code>itemid</code> attribute is also a foreign key, referencing <code>id</code> from the 'item' table.
      None of these attributes can be <code>NULL</code>.</p>
      <p>The database was set up using SQLite.</p></p>
      <h2>CRUD</h2>
      <p>In regards to "Create, Read, Update, Delete" (CRUD) features, the following tasks were completed.</p>
      <p>✅All items displayed on home page</p>
      <p>✅Review page lists details and shows all reviews for item</p>
      <p>✅Reviews show rating, username and description</p>
      <p>✅User can add a review</p>
      <p>✅User can add an item</p>
      <p>✅User can edit review</p>
      <p>✅User can edit item</p>
      <p>✅User can delete an item</p>
      <p>✅Review page lists the average rating and number of reviews for item</p>
      <p>Most of this was done through standard use of forms, routing and functions setup in the Routes page. In a bid to improve the security of the application, I opted to make the
      'delete' feature a <code>POST</code> action rather than a <code>GET</code>. This involves taking the user to a page where they confirm the item that they want to delete. This also makes it harder for 
      people to delete the item by going straight to a 'delete item' URL.</p>
      <p>To get the average rating and number of reviews, I used functions like <code>AVG()</code> and <code>COUNT()</code> in SQL queries. All of my SQL queries made use of 
      the <code>?</code> placeholder, to ensure SQL sanitisation.</p>
      <p>In order to get the data for a review, I used an SQL query across both tables.</p>
      <p></p><code>select username, rating, description, score FROM item, review WHERE item.id = review.itemid AND item.id=?</code></p>
      <h2>Sorting data</h2>
      <p>For the more complicated 'sorting' features, the following tasks were completed.</p>
      <p>✅All designers listed on a page</p>
      <p>✅Each designer has a page, listing all their items</p>
      <p>✅Items sorted by number of reviews</p>
      <p>✅Items sorted by average rating</p>
      <p>The page listing designers was easy, as I just needed to query all unqiue designers from the 'item' table.</p>
      <p><code>select distinct designer from item</code></p>
      <p>I then hyperlinked each name to their own 'Designer page', where their items were listed.</p>
      <p>Getting the number of reviews for an item was more complicated. I created an associative array of the form <code>array = ("id" => "number of reviews")</code>.
      Looping through the keys of the array, I did <code>count(get_reviews($id))</code> to return the number of reviews for that item.</p>
      <p>To sort the array by its values (descending order), I used <code>arsort()</code>. I made another array with <code>array_keys()</code> and looped
      it, using the item's id to retrieve other information (such as its name) and stored this in a final array. This ensured that the final array was listing
      items' names in the right order. On the page, a table on the left showed the items' names, while the table on the right showed their number of reviews.</p>
      <p>The SQL query to get the average rating for an item was more complicated.</p>
      <p><code>SELECT ifnull(round(avg(rating), 1), '- No reviews -') FROM item, review WHERE item.id = review.itemid AND item.id=?</code></p>
      <p>By using <code>ifnull()</code>, I could set a default value for items without reviews. This helped me display items in the rankings, even if they had no 'average rating'.
      The method for sorting was similar to the one described above for the 'number of reviews' case.</p>
      <h2>Extra functionality: Karma system</h2>
      <p>The assignment also required us to come up with an extra functionality that would be useful for a "review" web app. I implemented a "karma system" where
      users can like/dislike other reviews. Each user has their own "Reviewer rating" or "Total karma", which is a tally of the likes/dislikes garnered by all of their reviews.
      There is a scoreboard called "Top Reviewers" which ranks users by their "Total karma". This is designed to act as an incentive for users to write thoughtful and helpful
      reviews. As part of this added feature, the database had to be adjusted so that the 'review' table contained a new <code>score</code> attribute.</p>
      <p>I added two emoji icons to the table of reviews for an item: one for "good karma" (like) 👍 and one for "bad karma" 👎 (dislike).</p>
      <p>Each icon linked to a webpage, which called a function to add/subtract from the user's <code>score</code> and then redirect the user to the item they were just looking at.</p>
      <p>There is then a page where users are ranked by their total karma rating. The process used was similar to the one used for the other 'sorting' tasks.</p>
      <h2>Templating</h2>
      <p>The assignment made full use of Blade's templating abilities. A 'master' layout was setup, containing Bootstrap's CSS and a Bootstrap Navbar. All the other pages extended 
      on that layout. Using Bootstrap's grid system, appropriate column sizes where selected. For the pages containing tables, I made use of the <code>col-xs-4</code> 
      size because it was important that the tables didn't collapse underneath each other.</p><br><br><br>
    </div>
  </div>
@endsection