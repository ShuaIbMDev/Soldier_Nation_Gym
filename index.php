<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">
    <title>Swoldier Nation Gym</title>
    <link
        rel="stylesheet"
        href="CSS/style.css">
</head>

<body>
    <nav class="navbar">
        <div class="nav-logo">
            <img
                src="Swoldier_Nation.jpg"
                alt="Swoldier Nation Logo">
            <span>SWOLDIER NATION</span>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#about">About</a>
            <a href="#equipment">Equipment</a>
            <a href="#membership">Membership</a>
            <a href="#features">Features</a>
            <a href="login.php">Login</a>
            <a
                href="register.php"
                class="nav-register">
                Join Now
            </a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <p class="hero-small">
                SWOLDIER NATION GYM
            </p>
            <h1>
                BUILD<br>
                YOUR<br>
                STRENGTH
            </h1>
            <p class="hero-description">
                A dedicated training environment for people
                who want to improve their strength, fitness
                and overall performance.
            </p>

            <div class="hero-buttons">
                <a
                    href="register.php"
                    class="primary-button">
                    Join Now
                </a>
                <a
                    href="#about"
                    class="secondary-button">
                    Discover More
                </a>
            </div>
        </div>
    </section>

    <section class="intro-section">
        <div class="intro-content">
            <p class="section-label">
                WELCOME TO SWOLDIER NATION
            </p>
            <h2>
                Train Hard. Stay Consistent.
            </h2>
            <p>
                Swoldier Nation is a local gym focused on helping
                members develop strength, fitness and discipline
                through consistent training.
            </p>
        </div>
    </section>

    <section
        class="section about"
        id="about">
        <div class="about-container">
            <div class="about-image">
                <img
                    src="Swoldier_Nation.jpg"
                    alt="Swoldier Nation Gym">
            </div>

            <div class="section-content">
                <p class="section-label">
                    ABOUT US
                </p>
                <h2>
                    More Than Just A Gym
                </h2>
                <p>
                    Swoldier Nation provides a practical training
                    environment where members can work towards
                    their fitness and strength goals.
                </p>
                <p>
                    Whether you are starting your fitness journey
                    or looking to improve your performance, our
                    gym provides the equipment and space needed
                    for effective training.
                </p>
                <a
                    href="register.php"
                    class="primary-button">
                    Become A Member
                </a>
            </div>
        </div>
    </section>

    <section
        class="equipment"
        id="equipment">
        <p class="section-label">
            OUR EQUIPMENT
        </p>
        <h2>
            Train With The Right Equipment
        </h2>
        <p class="equipment-intro">
            Quality equipment to support your strength and
            fitness goals.
        </p>

        <div class="slideshow">
            <div class="slide">
                <img
                    src="Equipment_1.png"
                    alt="Swoldier Nation gym equipment">
            </div>

            <div class="slide">
                <img
                    src="Equipment_2.png"
                    alt="Swoldier Nation gym equipment">
            </div>

            <div class="slide">
                <img
                    src="Equipment_3.png"
                    alt="Swoldier Nation gym equipment">
            </div>

            <div class="slide">
                <img
                    src="Equipment_4.png"
                    alt="Swoldier Nation gym equipment">
            </div>

            <div class="slide">
                <img
                    src="Equipment_5.png"
                    alt="Swoldier Nation gym equipment">
            </div>
            <button
                class="slide-button previous"
                onclick="changeSlide(-1)">
                &#10094;
            </button>

            <button
                class="slide-button next"
                onclick="changeSlide(1)">
                &#10095;
            </button>
        </div>

        <div class="slide-dots">
            <span
                class="dot"
                onclick="showSlide(1)">
            </span>
            <span
                class="dot"
                onclick="showSlide(2)">
            </span>
            <span
                class="dot"
                onclick="showSlide(3)">
            </span>
            <span
                class="dot"
                onclick="showSlide(4)">
            </span>
            <span
                class="dot"
                onclick="showSlide(5)">
            </span>
        </div>
    </section>

    <section
        class="section membership"
        id="membership">
        <p class="section-label">
            MEMBERSHIP
        </p>
        <h2>
            Choose Your Membership
        </h2>
        <p>
            Simple membership options to fit your training needs.
        </p>

        <div class="membership-container">
            <div class="membership-card">
                <h3>
                    Monthly
                </h3>
                <p class="price">
                    Rs 1,500
                </p>
                <p>
                    Flexible monthly gym membership.
                </p>
                <a href="register.php">
                    Join Now
                </a>
            </div>

            <div class="membership-card featured">
                <span class="popular-label">
                    POPULAR
                </span>
                <h3>
                    3 Months
                </h>
                <p class="price">
                    Rs 4,000
                </p>
                <p>
                    A longer membership for consistent training.
                </p>
                <a href="register.php">
                    Join Now
                </a>
            </div>

            <div class="membership-card">
                <h3>
                    6 Months
                </h3>
                <p class="price">
                    Rs 7,500
                </p>
                <p>
                    Ideal for long-term fitness commitment.
                </p>
                <a href="register.php">
                    Join Now
                </a>
            </div>
        </div>
        <p class="entry-fee">
            One-time entry fee: Rs 1,000
        </p>
    </section>

    <section
        class="section features"
        id="features">
        <p class="section-label">
            WHY SWOLDIER NATION
        </p>
        <h2>
            Built For Your Progress
        </h2>

        <div class="features-container">
            <div class="feature-card">
                <div class="feature-number">
                    01
                </div>
                <h3>
                    Quality Equipment
                </h3>
                <p>
                    Train with equipment designed to support
                    different strength and fitness exercises.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-number">
                    02
                </div>
                <h3>
                    Flexible Training
                </h3>
                <p>
                    Train at your own pace and work towards
                    your personal fitness goals.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-number">
                    03
                </div>
                <h3>
                    Supportive Environment
                </h3>
                <p>
                    A focused training environment that
                    encourages consistency and progress.
                </p>
            </div>
        </div>
    </section>

    <section class="member-access">
        <div>
            <p class="section-label">
                MEMBER AREA
            </p>
            <h2>
                Manage Your Gym Membership
            </h2>
            <p>
                Registered members can access their account,
                view their membership information, book sessions
                and manage their gym activities.
            </p>
            <a
                href="login.php"
                class="primary-button">
                Member Login
            </a>
        </div>
    </section>

    <section class="cta">
        <p class="section-label">
            START TODAY
        </p>
        <h2>
            Ready To Build Your Strength?
        </h2>
        <p>
            Join Swoldier Nation and take the next step
            towards your fitness goals.
        </p>

        <div class="cta-buttons">
            <a
                href="register.php"
                class="primary-button">
                Join Swoldier Nation
            </a>
            <a
                href="login.php"
                class="secondary-button">
                Member Login
            </a>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <h3>
                SWOLDIER NATION
            </h3>
            <p>
                Strength. Discipline. Progress.
            </p>
            <div class="footer-links">
                <a href="index.php">
                    Home
                </a>
                <a href="#about">
                    About
                </a>
                <a href="#equipment">
                    Equipment
                </a>
                <a href="#membership">
                    Membership
                </a>
                <a href="login.php">
                    Login
                </a>
                <a href="register.php">
                    Join Now
                </a>
            </div>
            <p>
                &copy; 2026 Swoldier Nation Gym. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        let slideNumber = 1;
        function showSlide(number) {
            let slides =
                document.getElementsByClassName("slide");
            let dots =
                document.getElementsByClassName("dot");
            if (number > slides.length) {
                slideNumber = 1;
            }
            if (number < 1) {
                slideNumber = slides.length;
            }

            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (let i = 0; i < dots.length; i++) {
                dots[i].classList.remove("active");
            }
            slides[slideNumber - 1].style.display = "block";
            dots[slideNumber - 1].classList.add("active");
        }

        function changeSlide(number) {
            slideNumber = slideNumber + number;
            showSlide(slideNumber);
        }
        showSlide(slideNumber);
        setInterval(function() {
            changeSlide(1);
        }, 4000);
    </script>
</body>
</html>