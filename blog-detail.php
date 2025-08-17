<?php
// Ambil ID blog dari URL
$blogId = isset($_GET['id']) ? $_GET['id'] : 1;

// Data dummy untuk blog detail
$blogs = [
    1 => ["title" => "How to Travel Cheap: 16 Ways to Travel for Cheap or Free", "img" => "img/chuttersnap-aEnH4hJ_Mrs-unsplash.jpg", "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."],
    2 => ["title" => "12 Ways to Avoid Staying in a Bad Hostel", "img" => "img/bad-hostel.jpg", "content" => "Lorem ipsum dolor sit amet..."],
    3 => ["title" => "9 Destinations Under $50 A Day", "img" => "img/cheap-destination.jpg", "content" => "Lorem ipsum dolor sit amet..."],
    4 => ["title" => "How to Eat Cheap Around the World", "img" => "img/eat-cheap.jpg", "content" => "Lorem ipsum dolor sit amet..."],
    5 => ["title" => "The Secret to Long Term Traveling", "img" => "img/long-term-travel.jpg", "content" => "Lorem ipsum dolor sit amet..."],
    6 => ["title" => "Get Our Travel Journal to Record Your Travels!", "img" => "img/travel-journal.jpg", "content" => "Lorem ipsum dolor sit amet..."]
];

$blog = $blogs[$blogId];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog['title']; ?> - Eventastic</title>
    <link rel="stylesheet" href="css/blog-style.css">
    <link rel="stylesheet" href="css/font-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <div class="row">
        <!-- Sidebar Rekomendasi Blog -->
        <aside class="col-md-3">
            <h4>Related Posts</h4>
            <ul class="list-unstyled">
                <?php
                foreach ($blogs as $id => $related) {
                    if ($id != $blogId) {
                        echo '<li><a href="blog-detail.php?id=' . $id . '" class="text-decoration-none d-block">' . $related['title'] . '</a></li>';
                    }
                }
                ?>
            </ul>
        </aside>

        <!-- Konten Blog -->
        <article class="col-md-9">
            <img src="<?php echo $blog['img']; ?>" class="img-fluid rounded mb-4" alt="Blog Image">
            <h1><?php echo $blog['title']; ?></h1>
            <p><?php echo $blog['content']; ?></p>
        </article>
    </div>
</div>

</body>
</html>
