/*  Create 'item' table, deleting it if it already exsists.
    No attributes can be NULL.
    PK (id) will autoincrement.
*/
drop table if exists item;
create table item (    
    id integer not null primary key autoincrement,    
    name varchar(80) not null,
    designer varchar(80) not null,
    summary varchar(80) not null,
    link varchar(80) not null
);

/* Insert test data */
insert into item values (1, "Google",  "S. Brin", "Google's home page, renowned for its minimalist design.", "https://www.google.com");
insert into item values (2, "Amazon",  "J. Bezos", "Amazon - the everything store", "http://www.amazon.com.au");
insert into item values (3, "The Atlantic",  "The Atlantic", "A powerhouse in investigative journalism.", "http://www.theatlantic.com");
insert into item values (4, "Coursera",  "A. Ng", "A modern site with countless online courses.", "http://www.coursera.org");
insert into item values (5, "Duck Duck Go",  "G. Weinberg", "A private and secure search engine.", "http://www.duckduckgo.com");
insert into item values (6, "Facebook",  "Facebook Inc.", "The user entry point for the world's most popular social media platform.", "http://www.facebook.com");
insert into item values (7, "Griffith University",  "Griffith University", "The homepage for a young and dynamic Australian university.", "http://www.griffith.edu.au");
insert into item values (8, "The Guardian",  "Guardian Media Group", "An indepth feature article by an independent news company.", "http://www.theguardian.com/au");
insert into item values (9, "Mongol Rally",  "The Adventurists", "A surprisingly elegant site for a chaotic endurance event.", "http://www.theadventurists.com/mongol-rally");
insert into item values (10, "Orgsync",  "Orgsync Software", "A central platform for university clubs and socities.", "http://www.orgsync.com");
insert into item values (11, "Udacity",  "S. Thrun", "An engaging portal for endless learning.", "http://www.udacity.com");
insert into item values (12, "Wikipedia",  "Wales and Sanger", "The home of the internet.", "https://en.wikipedia.org/wiki/Main_Page");
insert into item values (13, "Wikimedia",  "Wales and Sanger", "Opensource educational resources, contributed to by thousands of users.", "https://en.wikimedia.org");
insert into item values (14, "Landing.AI",  "A. Ng", "The 'landing page' for one of AI's newest and most exciting startups.", "http://www.landing.ai");

/*  Create 'review' table, deleting it if it already exsists.
    Most attributes can't be NULL, score is set to 0 by default.
    PK is 'composite', using 'username' and 'itemid' (Foreign Key)
*/
drop table if exists review;
create table review (    
    username varchar(20) not null,
    itemid integer not null,
    rating integer not null,
    description text not null,
    score integer default 0,
    foreign key(itemid) references item(id),
    primary key(username, itemid)
); 

/* Insert test data */
insert into review values ("Jim123", 1, 4, "Easy to navigate - I like it!", 0);
insert into review values ("Jim123", 3, 3, "Not bad at all", 0);
insert into review values ("Jim123", 5, 5, "I like the security and privacy", 0);
insert into review values ("Jim123", 7, 2, "Not that great...", -3);
insert into review values ("Jim123", 9, 3, "Interestin - videos are a cool touch!", 3);
insert into review values ("Jim123", 12, 4, "Makes me want to study again haha", -1);
insert into review values ("uxconnoiseur", 2, 4, "Pretty cool UX!", 0);
insert into review values ("uxconnoiseur", 4, 4, "I'm liking this UI. Good mix of colours.", 0);
insert into review values ("uxconnoiseur", 12, 1, "Difficult to navigate at times. Could do with a revamp.", 0);
insert into review values ("uxconnoiseur", 8, 4, "I like it!", 0);
insert into review values ("Heracles354", 12, 4, "Almost perfect. Sometimes it took a while to execute actions. Nice design overall though.", 0);
insert into review values ("Heracles354", 10, 4, "Very easy to get around", 0);
insert into review values ("Heracles354", 9, 4, "Not too sure what could be improved!", 0);
insert into review values ("Heracles354", 11, 4, "Perfect really, except the link to home page is broken", 0);
insert into review values ("Finance79", 1, 4, "Simple, yet almost dramatic.", 0);
insert into review values ("Finance79", 3, 3, "Felt like everything was competing for my attention...", 0);
insert into review values ("Finance79", 6, 4, "Use it all the time, great UX!", 0);
insert into review values ("Finance79", 8, 4, "Nicer layout than the Atlantic :)", 0);
insert into review values ("betty99", 2, 4, "Pretty good UX, a bit hectic sometimes", 0);
insert into review values ("betty99", 4, 4, "Easy to navigate - I like it!", 0);
insert into review values ("betty99", 7, 4, "My uni! Great home page", 0);
insert into review values ("betty99", 9, 4, "Random concept, but great UX! Videos are a bit slow tho tbh", 0);
insert into review values ("betty99", 12, 5, "Increduble UX UI experience", 0);
insert into review values ("des1gner", 12, 5, "always been a fan of wales, he's done it again", 0);
insert into review values ("zezima666", 5, 4, "Better than google, security is #1", 0);
insert into review values ("a32fssr", 3, 4, "My go to news site - perfect mix of stylish look and 'to-the-point' stories", 0);