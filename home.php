<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   
    <style>
        

.home-packages {
    background: var(--light-bg);
}

.home-packages .box-container{
    display: flex;
    grid-template-columns: repeat(auto-fit, minmax(27rem,3fr));
    gap: 5rem;
    
}
.home-packages .box-container .image{
    height: 30rem;
    width: 40rem;
    overflow: hidden;
}
.home-packages .box-container .box {
    border: var(--boader);
    box-shadow: var(--box-shadow);
    background: var(--white);
    
}
.home-packages .box-container .box:hover .image img{
    transform: scale(1.2);
}
.home-packages .box-container .box .image img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: .2s linear;
}
.home-packages .box-container .box .content{
    padding: 2rem;
    text-align: center;

}
.home-packages .box-container .box .content h3{
    font-size: 2.5rem;
    color: var(--black);
}
.home-packages .box-container .box .content p{
    font-size: 1.5rem;
    color: var(--light-black);
    line-height: 2;
    padding: 1.5rem 0;
}
.home-packages .load-more{
    text-align: center;
    margin-top: 2rem;
}
.header .icons a{
    font-size: 1.7rem;
    color: #fff;
    cursor: pointer;
    margin-right: 1.5rem;
}
.header .icons a:hover{
    color: var(--main-color);
}
    </style>
    
</head>
<body>
    
<?php
include 'header.php';
?>


<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide" style="background:url(https://www.traveltalktours.com/wp-content/uploads/2017/01/Photo-Nepal-Essential.jpg) no-repeat">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>travel around the world</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>

                
            <div class="swiper-slide slide" style="background:url(https://www.outlooktravelmag.com/media/RFqCz9uB1611926508-1-1611926508.4x-jpg.webp) no-repeat">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>discover the new places</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background:url(https://www.natureloverstrek.com/pagegallery/everything-you-need-to-know-about-khaptad-national-park-%7C-interesting-things-about-khaptad-national-park16.jpg) no-repeat">
                <div class="content">
                    <span>explore, discover, travel</span>
                    <h3>make your tour worthwhile</h3>
                    <a href="package.php" class="btn">discover more</a>
                </div>
            </div>


        </div>
        <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>


    </div>
</section>

<section class="home-about">
    <div class="image">
          <img src="https://english.pardafas.com/wp-content/uploads/2023/07/Tourist-Nepal.jpg" alt="">
    </div>
    <div class="content">
        <h3>about us</h3>
        <p> Welcome to TOURMANDU, your gateway to extraordinary adventures and unforgettable experiences.
        At Tour&Travel, we're passionate about travel. Our mission is to inspire, empower, and connect travelers 
            to the world through immersive journeys that go beyond the ordinary.
        
        </p>
        <a href="about.php" class="btn">read more</a>

    </div>

</section>

<section class="home-packages">
    <h1 class="heading-title">our packages</h1>
    <div class="box-container">
        <div class="box">
            <div class="image">
                <img src="https://www.travelandtourworld.com/wp-content/uploads/2022/07/Nepal.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Swayambhunath is an ancient religious complex atop a hill in the Kathmandu city.</p>
                <a href="book.php" class="btn">book now</a>
            </div>
        </div><br>
        <div class="box">
            <div class="image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Pashupatinath_Temple-2020.jpg/1200px-Pashupatinath_Temple-2020.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>The Pashupatinath Temple is a Hindu temple located in Kathmandu, Nepal .</p>
                <a href="book.php" class="btn">book now</a>
            </div>

        </div><br>
        <div class="box">
            <div class="image">
                <img src="https://media.tacdn.com/media/attractions-splice-spp-674x446/06/e6/b3/0e.jpg" alt="">
            </div>
            <div class="content">
                <h3>adventure & tour</h3>
                <p>Pokhara is a city on Phewa Lake, in central Nepal.</p>
                <a href="book.php" class="btn">book now</a>
            </div>

        </div>
       
    </div>
    <div class="load-more"> <a href="package.php"  class="btn">load more</a></div>

</section>

<section class="home-offer">
    <div class="content">
        <h3>upto 50% off</h3>
        <p>this offer is valid upto 30th january on the occesion of new year.
        </p>
        <a href="book.php" class="btn">book now</a>
    </div>
</section>


<section class="services">
    <h1 class="heading-title">our services</h1>
    <div class="box-container">
        <div class="box">
            <img src="https://english.onlinekhabar.com/wp-content/uploads/2023/08/adventure-tourism-activities.png" alt="">
            <h3>adventure</h3>
        </div>
        <div class="box">
            <img src="https://travelumpire.com/wp-content/uploads/2022/02/EBC-Trek-with-G.jpg" alt="">
            <h3>tour guide</h3>
        </div>
        <div class="box">
            <img src="https://www.nepaltrekkinginhimalaya.com/images/articles/PXRP3-doga-yuruyusunde-bilinmesi-gerekenler.jpg" alt="">
            <h3>trekking</h3>
        </div>
        <div class="box">
            <img src="https://static.vecteezy.com/system/resources/previews/027/104/762/large_2x/nepal-s-traditional-method-of-cooking-using-wood-fire-free-photo.jpg" alt="">
            <h3>camp fire</h3>
        </div>
        <div class="box">
            <img src="https://www.trekkingtrail.com/uploads/articles/images/self-drive-road-trip-upper-mustang-nepal.jpg" alt="">
            <h3>off road</h3>
        </div>
        <div class="box">
            <img src="https://himalayantrekkers.com/uploads/trips/March2021/EBC-north-base-camp-trek.jpg" alt="">
            <h3>camping</h3>
        </div>
    </div>

</section>



<?php
include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>
    

    
</body>
</html>