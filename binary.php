<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $userName, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Accept search query from both GET and POST
    $search = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['query'])) {
        $search = trim($_POST['query']);
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['query'])) {
        $search = trim($_GET['query']);
    }

    if (!empty($search)) {
        // Fetch packages matching the search term
        $stmt = $pdo->prepare("SELECT * FROM package WHERE location LIKE :search OR duration LIKE :search");
        $stmt->execute(['search' => "%$search%"]);
        $packages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Search Results for "<?php echo htmlspecialchars($search); ?>"</title>

            <!-- CSS -->
            <link rel="stylesheet" href="style2.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

            <style>
                .box-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 2rem;
                    justify-content: center;
                    padding: 2rem 1rem;
                }
                .box {
                    background: #fff;
                    border-radius: 20px;
                    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
                    overflow: hidden;
                    width: 320px;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    display: flex;
                    flex-direction: column;
                }
                .box:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 20px 30px rgba(0,0,0,0.15);
                }
                .box .image img {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }
                .box .content {
                    padding: 1.5rem;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    flex-grow: 1;
                }
                .box .content h3 {
                    font-size: 1.8rem;
                    margin-bottom: 0.6rem;
                    color: #b22222;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .box .content h3 i {
                    font-size: 1.3rem;
                }
                .box .content .price {
                    font-size: 1.5rem;
                    font-weight: 700;
                    margin: 0.5rem 0;
                    color: #222;
                }
                .box .content h4 {
                    font-size: 1.2rem;
                    color: #555;
                    margin-bottom: 1rem;
                }
                .box .content .btn {
                    background-color: #b22222;
                    color: white;
                    padding: 0.8rem 1.2rem;
                    border-radius: 8px;
                    text-align: center;
                    text-decoration: none;
                    font-weight: 600;
                }
                .box .content .btn:hover {
                    background-color: #3b099dff;
                }
                .heading {
                    background-size: cover !important;
                    background-position: center !important;
                    padding: 7rem 0 5rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
                }
                .heading h1 {
                    font-size: 4rem;
                    text-transform: uppercase;
                }
                body {
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f9f9f9;
                    margin: 0;
                }
                /* Modal */
                .modal {
                    display: none;
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.6);
                    justify-content: center;
                    align-items: center;
                }
                .modal-content {
                    background-color: #fff;
                    padding: 2rem 3rem;
                    border-radius: 15px;
                    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
                    max-width: 400px;
                    text-align: center;
                }
                .modal-content h2 {
                    color: #b22222;
                    margin-bottom: 1rem;
                }
                .modal-content a.btn-close {
                    background-color: #b22222;
                    color: white;
                    padding: 0.7rem 1.5rem;
                    border-radius: 8px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-block;
                }
                .modal-content a.btn-close:hover {
                    background-color: #7a1414;
                }
            </style>
        </head>
        <body>

        <?php include 'header.php'; ?>

        <div class="heading" style="background:url('https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg') no-repeat">
            <h1>Search Results</h1>
        </div>

        <section class="packages">
            <h1 class="heading-title" style="text-align:center; margin-bottom: 1.5rem;">
                Packages matching "<?php echo htmlspecialchars($search); ?>"
            </h1>
            <div class="box-container">
                <?php if (count($packages) > 0): ?>
                    <?php foreach ($packages as $row): ?>
                        <div class="box">
                            <div class="image">
                                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Package Image">
                            </div>
                            <div class="content">
                                <h3><i class="fa fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></h3>
                                <div class="price">Rs.<?php echo htmlspecialchars($row['price']); ?> (per person)</div>
                                <h4><?php echo htmlspecialchars($row['duration']); ?></h4>

                                <?php if (isset($_SESSION['customer_id'])): ?>
                                    <!-- Logged in user -->
                                    <a href="book.php?id=<?php echo $row['package_id']; ?>" class="btn">Book Now</a>
                                <?php else: ?>
                                    <!-- Guest user -->
                                    <a href="login.php" class="btn">Book Now</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Modal -->
        <?php if (count($packages) === 0): ?>
            <div id="noPackageModal" class="modal">
                <div class="modal-content">
                    <h2>No Packages Found</h2>
                    <p>Sorry, no packages found for '<?php echo htmlspecialchars($search); ?>'.</p>
                    <a href="package.php" class="btn-close">Go Back</a>
                </div>
            </div>
        <?php endif; ?>

        <script>
            <?php if (count($packages) === 0): ?>
                const modal = document.getElementById('noPackageModal');
                modal.style.display = 'flex';
                document.querySelector('.btn-close').addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = "package.php";
                });
                window.onclick = function(event) {
                    if (event.target === modal) {
                        window.location.href = "package.php";
                    }
                };
            <?php endif; ?>
        </script>

        <?php include 'footer.php'; ?>
        </body>
        </html>
        <?php
    } else {
        // If no query entered
        header("Location: package.php");
        exit;
    }
} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center; margin-top: 2rem;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
