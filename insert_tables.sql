INSERT INTO
    recipes (
        user_id,
        title,
        description,
        cover_img_src,
        cuisine_type,
        dietary_preference,
        difficulty,
        is_featured
    )
VALUES
    (
        1,
        'Spicy Thai Noodles',
        'A quick and flavorful noodle dish with a spicy kick.',
        './assets/images/recipe_thai_noodles.jpg',
        'Thai',
        'Vegetarian',
        'Medium',
        1
    ),
    (
        2,
        'Classic Lasagna',
        'Rich layers of pasta, beef, and cheese baked to perfection.',
        './assets/images/recipe_lasagna.jpeg',
        'Italian',
        'Non-Vegetarian',
        'Hard',
        1
    ),
    (
        1,
        'Avocado Toast',
        'Simple yet delicious breakfast option with fresh avocado.',
        './assets/images/recipe_avocado_toast.jpeg',
        'American',
        'Vegan',
        'Easy',
        0
    );

INSERT INTO
    recipes (
        user_id,
        title,
        description,
        cover_img_src,
        cuisine_type,
        dietary_preference,
        difficulty,
        is_featured
    )
VALUES
    (
        1,
        'Grilled Veggie Panini',
        'A warm sandwich loaded with grilled vegetables, melted cheese, and fresh herbs.',
        './assets/images/recipe_veggie_panini.jpeg',
        'Italian',
        'Vegetarian',
        'Easy',
        0
    );

INSERT INTO
    events (
        title,
        description,
        event_date,
        cover_img_src,
        location,
        created_by
    )
VALUES
    (
        'Italian Cooking Workshop',
        'Learn to make fresh pasta and sauces like a pro.',
        '2025-10-05 18:00:00',
        './assets/images/event_italian_workshop.jpeg',
        'Culinary Studio, NYC',
        1
    ),
    (
        'Vegan Baking Class',
        'Delicious plant-based desserts and breads.',
        '2025-10-12 15:00:00',
        './assets/images/event_vegan_baking.jpeg',
        'Green Kitchen, LA',
        2
    ),
    (
        'Sushi Making Night',
        'Master the art of sushi rolling with our chef.',
        '2025-10-15 17:00:00',
        './assets/images/event_sushi_making.jpeg',
        'Sushi Bar, SF',
        1
    ),
    (
        'French Pastry Workshop',
        'Learn to bake croissants, eclairs, and more.',
        '2025-10-20 16:00:00',
        './assets/images/event_french_pastry.jpeg',
        "Baker\'s Studio, Boston",
        2
    ),
    (
        'Mediterranean Feast',
        'Hands-on cooking class featuring Mediterranean cuisine.',
        '2025-10-25 18:30:00',
        './assets/images/event_mediterranean.jpeg',
        'Culinary Center, Miami',
        1
    ),
    (
        'Chocolate & Dessert Masterclass',
        'Explore advanced chocolate and dessert techniques.',
        '2025-10-30 14:00:00',
        './assets/images/event_chocolate.jpeg',
        'Sweet Lab, Chicago',
        2
    );

INSERT INTO
    resources (title, resource_type, file_url)
VALUES
    -- 📄 Recipe Cards
    (
        'Lasagna Recipe Card',
        'RecipeCard',
        './assets/resources/culinary/LASAGNA-recipe-card.pdf'
    ),
    (
        'Vegetarian Stir-Fry Recipe Card',
        'RecipeCard',
        './assets/resources/culinary/veg_stir_fry.pdf'
    ),
    (
        'Spaghetti Recipe Card',
        'RecipeCard',
        './assets/resources/culinary/spaghetti.pdf'
    ),
    (
        'Pasta Recipe Card',
        'RecipeCard',
        './assets/resources/culinary/pasta.pdf'
    ),
    (
        'Hamburger Recipe',
        'RecipeCard',
        './assets/resources/culinary/hamburger.pdf'
    ),
    -- 📚 Tutorials
    (
        'Mastering Knife Skills',
        'Tutorial',
        './assets/resources/culinary/mastering_knife_skills.pdf'
    ),
    (
        'Cooking Basics',
        'Tutorial',
        './assets/resources/culinary/cooking_basics.pdf'
    ),
    (
        'Fundamentals of Cooking',
        'Tutorial',
        './assets/resources/culinary/fundamentals_of_cooking.pdf'
    ),
    (
        'Cooking Demonstration Guide',
        'Tutorial',
        './assets/resources/culinary/cooking_demonstration_guide.pdf'
    ),
    -- 🖼️ Infographics
    (
        'Herbs & Spices Info',
        'Infographic',
        './assets/resources/culinary/herbs_spice_info.jpeg'
    ),
    (
        'Spice Elements Set',
        'Infographic',
        './assets/resources/culinary/spice_elements_set.jpeg'
    ),
    (
        'Beef Temperature Chart',
        'Infographic',
        './assets/resources/culinary/beef_temp_chart.jpeg'
    ),
    (
        'Internal Temperature for Meat',
        'Infographic',
        './assets/resources/culinary/internal_temp_for_meat.jpeg'
    ),
    (
        'Safe Internal Temperature Guide',
        'Infographic',
        './assets/resources/culinary/safe_internal_temp.pdf'
    ),
    -- 🎥 Videos
    (
        'How to Make Sushi at Home',
        'Video',
        'https://www.youtube.com/embed/joweUxpHaqc?si=x48ZqUpp-WC31bh7'
    ),
    (
        'Kitchen Hacks You Must Know! 16 Quick & Brilliant Tricks That Work Like Magic',
        'Video',
        'https://www.youtube.com/embed/-X4TEu5Jb84?si=fRlcJig_HTSJng1r'
    ),
    (
        'Japanese egg soft-boiled omelette rice (omurice) Japanese Street Food in Korea / Korean Street Food',
        'Video',
        'https://www.youtube.com/embed/jdK9i6kzbfY?si=r88_LzG0-kUUJWO0'
    ),
    (
        'Every Way To Cook Eggs',
        'Video',
        'https://www.youtube.com/embed/b52h7kraC3A?si=cq9VCcnmTcuNGW4e'
    );

INSERT INTO
    resources (title, resource_type, file_url, category)
VALUES
    -- ☀️ Solar Energy
    (
        'Introduction to Solar Power',
        'Tutorial',
        './assets/resources/educational/basic_solar_energy.pdf',
        'Educational'
    ),
    (
        'Solar Panel Installation Guide',
        'RecipeCard',
        './assets/resources/educational/solar_installation_guide.pdf',
        'Educational'
    ),
    (
        'How Solar Panels Work',
        'Video',
        'https://www.youtube.com/embed/xKxrkht7CpY?si=rIReUuuKV98hE5IA',
        'Educational'
    ),
    -- 🌬️ Wind Energy
    (
        'Wind Energy Explained',
        'Tutorial',
        './assets/resources/educational/wind_energy_explained.pdf',
        'Educational'
    ),
    (
        'Wind Turbine Diagram',
        'Infographic',
        './assets/resources/educational/wind_turbine_infographic.jpeg',
        'Educational'
    ),
    (
        'How Do Wind Turbines Work?',
        'Video',
        'https://www.youtube.com/embed/xy9nj94xvKA?si=3UaPJINSoM7bPaxn',
        'Educational'
    ),
    -- 💧 Hydropower
    (
        'Hydropower Basics',
        'Tutorial',
        './assets/resources/educational/hydropower_basics.pdf',
        'Educational'
    ),
    (
        'Hydropower Plant Process',
        'Infographic',
        './assets/resources/educational/hydropower_process.jpeg',
        'Educational'
    ),
    (
        'Hydropower 101',
        'Video',
        'https://www.youtube.com/embed/q8HmRLCgDAI?si=Cl1iAK_Gqbqf32V5',
        'Educational'
    ),
    -- 🌍 Geothermal
    (
        'Geothermal Energy Overview',
        'Tutorial',
        './assets/resources/educational/geothermal_overview.pdf',
        'Educational'
    ),
    (
        'Geothermal Plant Layout',
        'Infographic',
        './assets/resources/educational/geothermal_plant.jpeg',
        'Educational'
    );

INSERT INTO
    culinary_trends (title, description, cover_img_src)
VALUES
    (
        'Plant-Based Revolution',
        'More chefs are embracing plant-based ingredients to create delicious, sustainable meals.',
        './assets/images/trend_plantbased.jpeg'
    ),
    (
        'Zero-Waste Cooking',
        'Creative ways to minimize food waste are becoming mainstream in home and professional kitchens.',
        './assets/images/trend_zerowaste.jpeg'
    ),
    (
        'Global Fusion Flavors',
        'Chefs are blending cuisines from around the world, creating unique flavor combinations.',
        './assets/images/trend_fusion.jpeg'
    );

INSERT INTO
    culinary_trends (title, description, cover_img_src)
VALUES
    (
        'Fermentation Revival',
        'Fermented foods like kimchi, kombucha, and sourdough are gaining popularity for their flavors and health benefits.',
        './assets/images/trend_fermentation.jpeg'
    ),
    (
        'Comfort Food Reinvented',
        'Classic comfort dishes are being modernized with gourmet techniques and global influences.',
        './assets/images/trend_comfortfood.jpeg'
    ),
    (
        'Tech-Driven Kitchens',
        'Smart appliances and AI-driven cooking tools are transforming how chefs and home cooks prepare meals.',
        './assets/images/trend_techkitchen.jpeg'
    );

INSERT INTO
    community_cookbook (
        user_id,
        title,
        cuisine_type,
        content,
        image_url,
        claps
    )
VALUES
   
    (
        1,
        'Classic Lasagna',
        'Italian',
        'Layers of pasta, rich meat sauce, and creamy cheese baked to perfection.',
        './assets/images/recipe_lasagna.jpeg',
        20
    ),
    (
        1,
        'Thai Noodles',
        'Thai',
        'Stir-fried noodles with vegetables, peanuts, and authentic Thai spices.',
        './assets/images/recipe_thai_noodles.jpg',
        18
    ),
    (
        1,
        'Veggie Panini',
        'Mediterranean',
        'Grilled panini filled with roasted vegetables and mozzarella cheese.',
        './assets/images/recipe_veggie_panini.jpeg',
        10
    ),
    (
        1,
        'Quinoa Salad',
        'Fusion',
        'A refreshing quinoa salad with cherry tomatoes, cucumber, and feta.',
        './assets/images/recipe_quoina.jpg',
        15
    ),
    (
        1,
        'Chocolate Lava Cake',
        'French',
        'Warm chocolate cake with a gooey molten center, served with ice cream.',
        './assets/images/lava_cake.jpg',
        25
    );