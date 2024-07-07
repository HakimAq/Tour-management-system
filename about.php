<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style2.css">
    <style>
.heading{
    background-size: cover !important;
    background-position: cover !important;
    padding-top: 7rem;
    padding-bottom: 5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}   
.heading h1{
    font-size: 6rem;
    text-transform: uppercase;
    color: var(--light-bg);
    text-shadow: var(--text-shadow);
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
.about{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 3rem;
} 
.about .image{
    flex: 1 1 41rem;
}
.about .image img{
    width: 100%;
}
.about .content{
    flex:1 1 41rem ;
    text-align: center;
}
.about .content h3{
    font-size: 3rem;
    color: var(--black);
}
.about .content p{
    font-size: 1.5rem;
    color: var(--light-black);
    line-height: 2;
    padding: 1rem 0;
}
.about .content .icons-container{
    margin-top: 2rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: flex-end;
}
.about .content .icons-container .icons{
    background: var(--light-bg);
    padding: 2rem;
    flex: 1 1 16rem;
}
.about .content .icons-container .icons i{
    font-size: 4rem;
    margin-bottom: 3rem;
    color: var(--main-color);
}
.about .content .icons-container .icons span{
    font-size: 1.5rem;
    color: var(--light-black);
    display: block;
}

.reviews{
    background: var(--light-bg);
}
.reviews .slide{
    display:grid;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 1rem 2rem rgb(0, 0, 0, .1);
    border-radius: .5rem;
}
.reviews .slide .stars{
    padding-bottom: .5rem;
}
.reviews .slide .stars i{
    font-size: 1.7rem;
    color: var(--main-color);
}
.reviews .slide p{
    font-size: 1.5rem;
    color: var(--light-black);
    line-height: 2;
    padding: 1.5rem 0;
}
.reviews .slide h3{
    font-size: 2rem;
    color: #333;
}
.reviews .slide span{
    font-size: 1.5rem;
    color: var(--main-color);
    display: block;
}
.reviews .slide img{
    height: 13rem;
    width: 13rem;
    border-radius: 50%;
    object-fit: cover;
    margin-top: 1rem;
}

    </style>
</head>
<body>
<section class="header">
    <a href="home.php" class="logo"><h3>TOURMANDU</h3></a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="package.php">Package</a>
        <a href="book.php">Book</a>
    </nav>
    <div class="icons">
        <a href="login.php"><i class="fas fa-user-circle"></i>Login</a>  
    </div>

    <div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="heading" style="background:url(https://hips.hearstapps.com/hmg-prod/images/autumn-leaves-fallen-in-forest-royalty-free-image-1628717422.jpg?crop=1xw:0.84375xh;center,top) no-repeat">
   <h1>about us</h1>
</div>

<section class="about">
    <div class="image">
        <img src="https://english.pardafas.com/wp-content/uploads/2023/07/Tourist-Nepal.jpg" alt="">
    </div>
    <div class="content">
        <h3> why choose us?</h3>
        <p>Choose us for your travel needs because we offer personalized service, exclusive deals,
             and 24/7 support. With years of expertise, wide-ranging options, and a commitment to safety,
              we ensure unforgettable experiences tailored just for you. Book now for peace of mind and unbeatable adventures!</p>
              <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-map"></i>
                    <span>top destinations</span>
                </div>
                <div class="icons">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>affordable price</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 guide service</span>
                </div>
              </div>
</div>
</section>

<section class="reviews">
<h1 class="heading-title">client review</h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            
        <div class="swiper-slider slide">
           
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div> 
            <p>I had an incredible experience booking my vacation through this tour website. 
                The attention to detail and personalized recommendations made my trip unforgettable. Highly recommend!</p>
                <h3>Rajesh Hamal</h3>
                <span>actor</span>
                <img src="https://i0.wp.com/english.khabarhub.com/wp-content/uploads/2020/07/Rajesh-Hamal.jpg?fit=960%2C640&ssl=1" alt="">
      

            
            
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>I loved using this tour website for my recent trip. 
                The curated experiences and insider tips made all the difference. 
                Can’t wait to plan my next adventure with them!</p>
            <h3>Dayahang Rai</h3>
            <span>actor</span>
            <img src="https://www.imnepal.com/wp-content/uploads/2017/09/dayahang-rai.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>This tour company exceeded all my expectations. Their professional team ensured 
                everything was smooth and memorable. A must-try for any traveler looking for a premium experience.</p>
            <h3>Keki Adhikari</h3>
            <span>actress</span>
            <img src="https://sumitsharmasameer.com/wp-content/uploads/2023/11/keki-adhikari-1.jpeg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>Traveling with this tour service was a game-changer. They handle all the details so you can focus
                 on enjoying your trip. Highly recommend for anyone looking to elevate their travel experience.</p>
            <h3>Sandeep Lamichhane</h3>
            <span>cricketer</span>
            <img src="https://web.nepalnews.com/storage/story/1024/viber_image_2023_04_28_07_31_57_4131682646467_1024.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>From start to finish, this tour website was incredible. The unique experiences and flawless 
                organization made it a trip to remember. Can't wait to book again!</p>
            <h3>Gagan Thapa</h3>
            <span>politician</span>
            <img src="https://assets-cdn.kathmandupost.com/uploads/source/news/2022/news/gaganthapaTKP-1669096736.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>This tour company is the real deal. Everything was perfectly organized and the
                 tours were truly immersive. An excellent choice for any traveler.</p>
            <h3>Anjan Bista</h3>
            <span>footballer</span>
            <img src="https://pbs.twimg.com/media/FdqUUsWaMAAdbUo.jpg" alt="">
        </div>
        <div class="swiper-slider slide">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>Booking with this tour service was a breeze. The user-friendly website and 
                fantastic customer service made it a joy to plan my trip. Five stars all the way!</p>
            <h3>Prakash Saput</h3>
            <span>Singer</span>
            <img src="https://images.genius.com/ffba7bd6069f67436542f5621888f096.698x698x1.jpg" alt="">
        </div>
        
        </div>
    </div>
</section>



<section class="footer">
    <div class="box-container">
    <div class="box">
        <h3>quick links</h3>
        <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
        <a href="package.php"><i class="fas fa-angle-right"></i> Package</a>
        <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
    </div>
    <div class="box">
        <h3>extra links</h3>
        <a href="#"><i class="fas fa-angle-right"></i> ask questtions</a>
        <a href="#"><i class="fas fa-angle-right"></i> about us</a>
        <a href="#"><i class="fas fa-angle-right"></i> privacy policy</a>
        <a href="#"><i class="fas fa-angle-right"></i> terms of use</a>
    </div>
    <div class="box">
        <h3>contact info</h3>
        <a href="#"><i class="fas fa-phone"></i> +977 9849426293</a>
        <a href="#"><i class="fas fa-envelope"></i> stharajesh662@gmail.com</a>
        <a href="#"><i class="fas fa-map"></i> Bagmati Province, Kathmandu, Nepal</a>
    </div>

    <div class="box">
        <h3>follow us</h3>
        <a href="#"><i class="fab fa-facebook-f"></i> facebook</a>
        <a href="#"><i class="fab fa-twitter"></i> twitter</a>
        <a href="#"><i class="fab fa-instagram"></i> instagram</a>
        <a href="#"><i class="fab fa-linkedin"></i> linkedin</a>
    </div>

    </div>

    <div class="credit">created by <span>mr. amir shrestha</span> | all right reserved!</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- <script src="script.js"></script> -->
    

    
</body>
</html>