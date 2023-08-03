SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
                         `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
                         `pass` varchar(40) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `admin` (`name`, `pass`) VALUES
    ('admin', 'f865b53623b121fd34ee5426c792e5c33af8c227');


CREATE TABLE `books` (
                         `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
                         `book_title` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
                         `book_author` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
                         `book_image` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
                         `book_descr` text COLLATE latin1_general_ci DEFAULT NULL,
                         `book_price` decimal(6,2) NOT NULL,
                         `genre_id` int(10) UNSIGNED NOT NULL,
                         `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- Inserting books for each genre into the `books` table

-- Fiction
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780061120084', 'To Kill a Mockingbird', 'Harper Lee', 'to_kill_a_mockingbird.jpg', 'One of the most cherished stories of all time, To Kill a Mockingbird has been translated into more than forty languages, sold more than forty million copies worldwide, served as the basis for an enormously popular motion picture, and was voted one of the best novels of the twentieth century by librarians across the country. A gripping, heart-wrenching, and wholly remarkable tale of coming-of-age in a South poisoned by virulent prejudice, it views a world of great beauty and savage inequities through the eyes of a young girl, as her father—a crusading local lawyer—risks everything to defend a black man unjustly accused of a terrible crime.', '15.99', 1, '2023-07-26 10:00:00'),
    ('9780451524935', '1984', 'George Orwell', '1984.jpg', 'Written more than 70 years ago, 1984 was George Orwell''s chilling prophecy about the future. And while 1984 has come and gone, his dystopian vision of a government that will do anything to control the narrative is timelier than ever... - Nominated as one of America''s best-loved novels by PBS''s The Great American Read - " The Party told you to reject the evidence of your eyes and ears. It was their final, most essential command. " Winston Smith toes the Party line, rewriting history to satisfy the demands of the Ministry of Truth. With each lie he writes, Winston grows to hate the Party that seeks power for its own sake and persecutes those who dare to commit thoughtcrimes. But as he starts to think for himself, Winston can''t escape the fact that Big Brother is always watching... A startling and haunting novel, 1984 creates an imaginary world that is completely convincing from start to finish. No one can deny the novel''s hold on the imaginations of whole generations, or the power of its admonitions--a power that seems to grow, not lessen, with the passage of time.', '12.99', 1, '2023-07-26 10:00:00'),
    ('9780743273565', 'The Great Gatsby', 'F. Scott Fitzgerald', 'great_gatsby.jpg', 'The mysterious Jay Gatsby embodies the American notion that it is possible to redefine oneself and persuade the world to accept that definition. Gatsby''s youthful neighbor, Nick Carraway, fascinated with the display of enormous wealth in which Gatsby revels, finds himself swept up in the lavish lifestyle of Long Island society during the Jazz Age. Considered Fitzgerald''s best work, The Great Gatsby is a mystical, timeless story of integrity and cruelty, vision and despair. The timeless story of Jay Gatsby and his love for Daisy Buchanan is widely acknowledged to be the closest thing to the Great American Novel ever written.', '10.99', 1, '2023-07-26 10:00:00');

-- Non-Fiction
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780062316097', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'sapiens.jpg', 'Most books about the history of humanity pursue either a historical or a biological approach, but Dr. Yuval Noah Harari breaks the mold with this highly original book that begins about 70,000 years ago with the appearance of modern cognition. From examining the role evolving humans have played in the global ecosystem to charting the rise of empires, Sapiens integrates history and science to reconsider accepted narratives, connect past developments with contemporary concerns, and examine specific events within the context of larger ideas.
Dr. Harari also compels us to look ahead, because over the last few decades humans have begun to bend laws of natural selection that have governed life for the past four billion years. We are acquiring the ability to design not only the world around us, but also ourselves. Where is this leading us, and what do we want to become?
Featuring 27 photographs, 6 maps, and 25 illustrations/diagrams, this provocative and insightful work is sure to spark debate and is essential reading for aficionados of Jared Diamond, James Gleick, Matt Ridley, Robert Wright, and Sharon Moalem.', '18.99', 2, '2023-07-26 10:00:00'),
    ('9781524763138', 'Becoming', 'Michelle Obama', 'becoming.jpg', 'In a life filled with meaning and accomplishment, Michelle Obama has emerged as one of the most iconic and compelling women of our era. As First Lady of the United States of America—the first African-American to serve in that role—she helped create the most welcoming and inclusive White House in history, while also establishing herself as a powerful advocate for women and girls in the U.S. and around the world, dramatically changing the ways that families pursue healthier and more active lives, and standing with her husband as he led America through some of its most harrowing moments. Along the way, she showed us a few dance moves, crushed Carpool Karaoke, and raised two down-to-earth daughters under an unforgiving media glare.
In her memoir, a work of deep reflection and mesmerizing storytelling, Michelle Obama invites readers into her world, chronicling the experiences that have shaped her—from her childhood on the South Side of Chicago to her years as an executive balancing the demands of motherhood and work, to her time spent at the world’s most famous address. With unerring honesty and lively wit, she describes her triumphs and her disappointments, both public and private, telling her full story as she has lived it—in her own words and on her own terms.
Warm, wise, and revelatory, Becoming is the deeply personal reckoning of a woman of soul and substance who has steadily defied expectations—and whose story inspires us to do the same.', '16.99', 2, '2023-07-26 10:00:00');

-- Mystery
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780307474278', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'dragon_tattoo.jpg', 'Harriet Vanger, a scion of one of Sweden''s wealthiest families disappeared over forty years ago. All these years later, her aged uncle continues to seek the truth. He hires Mikael Blomkvist, a crusading journalist recently trapped by a libel conviction, to investigate. He is aided by the pierced and tattooed punk prodigy Lisbeth Salander. Together they tap into a vein of unfathomable iniquity and astonishing corruption.', '14.99', 3, '2023-07-26 10:00:00'),
    ('9780307588364','Gone Girl', 'Gillian Flynn', 'gone_girl.jpg', 'On a warm summer morning in North Carthage, Missouri, it is Nick and Amy Dunne’s fifth wedding anniversary. Presents are being wrapped and reservations are being made when Nick’s clever and beautiful wife disappears. Husband-of-the-Year Nick isn’t doing himself any favors with cringe-worthy daydreams about the slope and shape of his wife’s head, but passages from Amy''s diary reveal the alpha-girl perfectionist could have put anyone dangerously on edge. Under mounting pressure from the police and the media—as well as Amy’s fiercely doting parents—the town golden boy parades an endless series of lies, deceits, and inappropriate behavior. Nick is oddly evasive, and he’s definitely bitter—but is he really a killer? ', '13.99', 3, '2023-07-26 10:00:00'),
    ('9780307474278', 'The Da Vinci Code', 'Dan Brown', 'da_vinci_code.jpg', 'While in Paris on business, Harvard symbologist Robert Langdon receives an urgent late-night phone call: the elderly curator of the Louvre has been murdered inside the museum. Near the body, police have found a baffling cipher. While working to solve the enigmatic riddle, Langdon is stunned to discover it leads to a trail of clues hidden in the works of Da Vinci -- clues visible for all to see -- yet ingeniously disguised by the painter.
Langdon joins forces with a gifted French cryptologist, Sophie Neveu, and learns the late curator was involved in the Priory of Sion -- an actual secret society whose members included Sir Isaac Newton, Botticelli, Victor Hugo, and Da Vinci, among others.
In a breathless race through Paris, London, and beyond, Langdon and Neveu match wits with a faceless powerbroker who seems to anticipate their every move. Unless Langdon and Neveu can deipher the labyrinthine puzzle in time, the Priory''s ancient secret -- and an explosive historical truth -- will be lost forever.', '11.99', 3, '2023-07-26 10:00:00');

-- Romance
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780141439518','Pride and Prejudice', 'Jane Austen', 'pride_prejudice.jpg', 'One of the most universally loved and admired English novels, Pride and Prejudice was penned as a popular entertainment. But the consummate artistry of Jane Austen (1775-1817) transformed this effervescent tale of rural romance into a witty, shrewdly observed satire of English country life that is now regarded as one of the principal treasures of English language.In a remote Hertfordshire village, far off the good coach roads of George III''s England, a country squire of no great means must marry off his five vivacious daughters. At the heart of this all-consuming enterprise are his headstrong second daughter Elizabeth Bennet and her aristocratic suitor Fitzwilliam Darcy - two lovers whose pride must be humbled and prejudices dissolved before the novel can come to its splendid conclusion.Pride and Prejudice is a novel by Jane Austen, first published in 1813. The story follows the main character, Elizabeth Bennet, as she deals with issues of manners, upbringing, morality, education, and marriage in the society of the landed gentry of the British Regency. Elizabeth is the second of five daughters of a country gentleman, Mr Bennet, living in Longbourn.Set in England in the late 18th century, Pride and Prejudice tells the story of Mr and Mrs Bennet''s five unmarried daughters after two gentlemen have moved into their neighbourhood: the rich and eligible Mr Bingley, and his status-conscious friend, the even richer and more eligible Mr Darcy. While Bingley takes an immediate liking to the eldest Bennet daughter, Jane, Darcy is disdainful of local society and repeatedly clashes with the Bennets'' lively second daughter, Elizabeth.Pride and Prejudice retains a fascination for modern readers, continuing near the top of lists of "most loved books". It has become one of the most popular novels in English literature, selling over 20 million copies, and receives considerable attention from literary scholars. Likewise, it has paved the way for archetypes that abound in many contemporary literature of our time. Modern interest in the book has resulted in a number of dramatic adaptations and an abundance of novels and stories imitating Austin''s memorable characters or themes.', '9.99', 4, '2023-07-26 10:00:00'),
    ('9781455582875','The Notebook', 'Nicholas Sparks', 'the_notebook.jpg', 'Every so often a love story so captures our hearts that it becomes more than a story — it becomes an experience to remember forever. The Notebook is such a book. It is a celebration of how passion can be ageless and timeless, a tale that moves us to laughter and tears and makes us believe in true love all over again . . .At thirty-one, Noah Calhoun, back in coastal North Carolina after World War II, is haunted by images of the girl he lost more than a decade earlier. At twenty-nine, socialite Allie Nelson is about to marry a wealthy lawyer, but she cannot stop thinking about the boy who long ago stole her heart. Thus begins the story of a love so enduring and deep it can turn tragedy into triumph, and may even have the power to create a miracle . . .', '8.99', 4, '2023-07-26 10:00:00'),
    ('9780142001745','Me Before You', 'Jojo Moyes', 'me_before_you.jpg', 'Lou Clark knows lots of things. She knows how many footsteps there are between the bus stop and home. She knows she likes working in The Buttered Bun tea shop and she knows she might not love her boyfriend Patrick.What Lou doesn’t know is she’s about to lose her job or that knowing what’s coming is what keeps her sane.Will Traynor knows his motorcycle accident took away his desire to live. He knows everything feels very small and rather joyless now and he knows exactly how he’s going to put a stop to that.What Will doesn’t know is that Lou is about to burst into his world in a riot of colour. And neither of them knows they’re going to change the other for all time.', '10.99', 4, '2023-07-26 10:00:00');

-- Science Fiction
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780441013593','Dune', 'Frank Herbert', 'dune.jpg', 'Dune, Frank Herbert’s epic science-fiction masterpiece set in the far future amidst a sprawling feudal interstellar society, tells the story of Paul Atreides as he and his family accept control of the desert planet Arrakis. A stunning blend of adventure and mysticism, environmentalism, and politics, Dune is a powerful, fantastical tale that takes an unprecedented look into our universe, and is transformed by the graphic novel format. In the first volume of a three-book trilogy encompassing the original novel, Brian Herbert and Kevin J. Anderson’s adaptation retains the story''s integrity, and Raúl Allén and Patricia Martín’s magnificent illustrations, along with cover art by Bill Sienkiewicz, bring the book to life for a new generation of readers.', '14.99', 5, '2023-07-26 10:00:00'),
    ('9780812550702','Ender\'s Game', 'Orson Scott Card', 'enders_game.jpg', 'Once again, the Earth is under attack. Alien "buggers" are poised for a final assault. The survival of the human species depends on a military genius who can defeat the buggers. But who? Ender Wiggin. Brilliant. Ruthless. Cunning. A tactical and strategic master. And a child. Recruited for military training by the world government, Ender''s childhood ends the moment he enters his new home: Battleschool. Among the elite recruits Ender proves himself to be a genius among geniuses. In simulated war games he excels. But is the pressure and loneliness taking its toll on Ender? Simulations are one thing. How will Ender perform in real combat conditions? After all, Battleschool is just a game. Right?', '12.99', 5, '2023-07-26 10:00:00'),
    ('9780441569595', 'Neuromancer', 'William Gibson', 'neuromancer.jpg', 'Case was the sharpest data-thief in the matrix—until he crossed the wrong people and they crippled his nervous system, banishing him from cyberspace. Now a mysterious new employer has recruited him for a last-chance run at an unthinkably powerful artificial intelligence. With a dead man riding shotgun and Molly, a mirror-eyed street-samurai, to watch his back, Case is ready for the adventure that upped the ante on an entire genre of fiction.Neuromancer was the first fully-realized glimpse of humankind’s digital future—a shocking vision that has challenged our assumptions about technology and ourselves, reinvented the way we speak and think, and forever altered the landscape of our imaginations.', '11.99', 5, '2023-07-26 10:00:00');

-- Biography
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780743264747', 'Steve Jobs', 'Walter Isaacson', 'steve_jobs.jpg', 'Based on more than forty interviews with Steve Jobs conducted over two years—as well as interviews with more than 100 family members, friends, adversaries, competitors, and colleagues—Walter Isaacson has written a riveting story of the roller-coaster life and searingly intense personality of a creative entrepreneur whose passion for perfection and ferocious drive revolutionized six industries: personal computers, animated movies, music, phones, tablet computing, and digital publishing.At a time when America is seeking ways to sustain its innovative edge, Jobs stands as the ultimate icon of inventiveness and applied imagination. He knew that the best way to create value in 21st century was to connect creativity with technology. He built a company where leaps of the imagination were combined with remarkable feats of engineering.Although Jobs cooperated with the author, he asked for no control over what was written. He put nothing off-limits. He encouraged the people he knew to speak honestly. And Jobs speaks candidly, sometimes brutally so, about the people he worked with and competed against. His friends, foes, and colleagues provide an unvarnished view of the passions, perfectionism, obsessions, artistry, devilry, and compulsion for control that shaped his approach to business and the innovative products that resulted.Driven by demons, Jobs could drive those around him to fury and despair. But his personality and products were interrelated, just as Apple’s hardware and software tended to be, as if part of an integrated system. His tale is instructive and cautionary, filled with lessons about innovation, character, leadership, and values.
', '16.99', 6, '2023-07-26 10:00:00'),
    ('9780812974492','Unbroken', 'Laura Hillenbrand', 'unbroken.jpg', 'On a May afternoon in 1943, an American military plane crashed into the Pacific Ocean and disappeared, leaving only a spray of debris and a slick of oil, gasoline, and blood. Then, on the ocean surface, a face appeared. It was that of a young lieutenant, the plane’s bombardier, who was struggling to a life raft and pulling himself aboard. So began one of the most extraordinary sagas of the Second World War.

The lieutenant’s name was Louis Zamperini. As a boy, he had been a clever delinquent, breaking into houses, brawling, and stealing. As a teenager, he had channeled his defiance into running, discovering a supreme talent that carried him to the Berlin Olympics. But when war came, the athlete became an airman, embarking on a journey that led to his doomed flight, a tiny raft, and a drift into the unknown.

Ahead of Zamperini lay thousands of miles of open ocean, leaping sharks, a sinking raft, thirst and starvation, enemy aircraft, and, beyond, a trial even greater. Driven to the limits of endurance, Zamperini would respond to desperation with ingenuity, suffering with hope and humor, brutality with rebellion. His fate, whether triumph or tragedy, would hang on the fraying wire of his will.

Featuring more than one hundred photographs plus an exclusive interview with Zamperini, this breathtaking odyssey—also captured on film by director Angelina Jolie—is a testament to the strength of the human spirit and the ability to endure against the unlikeliest of odds.', '15.99', 6, '2023-07-26 10:00:00');

-- History
INSERT INTO `books` (`book_isbn`,`book_title`, `book_author`, `book_image`, `book_descr`, `book_price`, `genre_id`, `created_at`)
VALUES
    ('9780345386236','The Guns of August', 'Barbara W. Tuchman', 'guns_of_august.jpg', 'In this landmark account, renowned historian Barbara W. Tuchman re-creates the first month of World War I: thirty days in the summer of 1914 that determined the course of the conflict, the century, and ultimately our present world. Beginning with the funeral of Edward VII, Tuchman traces each step that led to the inevitable clash. And inevitable it was, with all sides plotting their war for a generation. Dizzyingly comprehensive and spectacularly portrayed with her famous talent for evoking the characters of the war’s key players, Tuchman’s magnum opus is a classic for the ages.', '13.99', 7, '2023-07-26 10:00:00'),
    ('9781476728742','The Wright Brothers', 'David McCullough', 'wright_brothers.jpg', 'On a winter day in 1903, in the Outer Banks of North Carolina, two brothers—bicycle mechanics from Dayton, Ohio—changed history. But it would take the world some time to believe that the age of flight had begun, with the first powered machine carrying a pilot.
Orville and Wilbur Wright were men of exceptional courage and determination, and of far-ranging intellectual interests and ceaseless curiosity. When they worked together, no problem seemed to be insurmountable. Wilbur was unquestionably a genius. Orville had such mechanical ingenuity as few had ever seen. That they had no more than a public high school education and little money never stopped them in their mission to take to the air. Nothing did, not even the self-evident reality that every time they took off, they risked being killed.', '12.99', 7, '2023-07-26 10:00:00');

CREATE TABLE `users` (
                         `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
                         `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
                         `name` varchar(60) COLLATE latin1_general_ci NOT NULL,
                         `address` varchar(80) COLLATE latin1_general_ci NOT NULL,
                         `city` varchar(30) COLLATE latin1_general_ci NOT NULL,
                         `zip_code` varchar(10) COLLATE latin1_general_ci NOT NULL,
                         `country` varchar(60) COLLATE latin1_general_ci NOT NULL,
                         `email` varchar(21) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `orders` (
                          `order_id` int(10) UNSIGNED NOT NULL,
                          `user_id` int(10) UNSIGNED NOT NULL,
                          `amount` decimal(6,2) DEFAULT NULL,
                          `created_at` datetime NOT NULL DEFAULT current_timestamp()
                          `date` timestamp NOT NULL DEFAULT current_timestamp(),
                          `ship_name` char(60) COLLATE latin1_general_ci NOT NULL,
                          `ship_address` char(80) COLLATE latin1_general_ci NOT NULL,
                          `ship_city` char(30) COLLATE latin1_general_ci NOT NULL,
                          `ship_zip_code` char(10) COLLATE latin1_general_ci NOT NULL,
                          `ship_country` char(20) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `order_items` (
                               `order_id` int(10) UNSIGNED NOT NULL,
                               `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
                               `item_price` decimal(6,2) NOT NULL,
                               `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

CREATE TABLE `genre` (
                         `genre_id` int(10) UNSIGNED NOT NULL,
                         `genre_name` varchar(60) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `genre` (`genre_id`, `genre_name`) VALUES
                                       (1, 'Fiction'),
                                       (2, 'Non-Fiction'),
                                       (3, 'Mystery'),
                                       (4, 'Romance'),
                                       (5, 'Science Fiction'),
                                       (6, 'Biography'),
                                       (7,'History');


ALTER TABLE `admin`
    ADD PRIMARY KEY (`name`,`pass`);

ALTER TABLE `orders`
    ADD PRIMARY KEY (`order_id`);

ALTER TABLE `genre`
    ADD PRIMARY KEY (`genre_id`);

ALTER TABLE `orders`
    MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `genre`
    MODIFY `genre_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;