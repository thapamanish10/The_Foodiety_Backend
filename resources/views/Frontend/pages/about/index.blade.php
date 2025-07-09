<artical class="about-artical">
    <section class="about-articel-section about-article-section-img-div">
        <img class="about-article-section-img" src="https://images.pexels.com/photos/3747434/pexels-photo-3747434.jpeg"
            alt="">
    </section>
    <section class="about-articel-section">
        <h1>OUR STORY</h1>
        <p class="about-articel-section-desc">Foodiety was born out of a shared love for all things delicious. We are a
            team of food enthusiasts,
            chefs, and
            culinary explorers dedicated to bringing you the best in recipes, restaurant reviews, food travel
            guides, and
            cooking tips. What started as a small blog has grown into a vibrant community where food lovers from all
            walks
            of life can share their experiences and discoveries.</p>
        <p>We aim to inspire our readers to try new recipes, visit new restaurants, and explore the diverse world of
            food.
            We believe that every meal is an opportunity to create memories, and we're here to make those moments as
            delicious as possible.</p>
        <p><strong>More About Us</strong></p>
    </section>
</artical>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

    .about-artical {
        max-width: 65%;
        margin: 2rem auto;
        display: flex;
        gap: 3rem;
        max-height: 450px;
        padding: 5px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .about-artical .about-articel-section,
    .about-article-section-img-div {
        flex-basis: 50%;
        height: 100%;
        overflow: hidden;
    }

    .about-artical .about-articel-section .about-article-section-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    h1 {
        font-size: 36px;
        margin-bottom: 30px;
        font-weight: bold;
        font-family: "Playfair Display", serif;
    }

    .about-articel-section-desc {
        font-size: 16px;
        margin-bottom: 20px;
        text-align: justify;
        font-family: "Playfair Display", serif;
        font-weight: 400;
        color: #5f5f5f;
        display: -webkit-box;
        -webkit-line-clamp: 8;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        max-height: calc(1.5em * 8);
        position: relative;
    }

    strong {
        font-weight: bold;
        font-family: "Playfair Display", serif;
    }

    .about-articel-section-desc::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1.5em;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
        z-index: 1;
    }
</style>
