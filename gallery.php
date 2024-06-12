<?php
	
	
	print '
	<style>
         .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }
        .gallery-item {
            max-width: 23%; 
            box-sizing: border-box;
            text-align: center;
        }
        .gallery img {
            width: 100%; 
            height: auto;
            border: 2px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .gallery img:hover {
            transform: scale(1.05);
        }
    </style>
	
	<h1 style="text-align: center;">Galerija Pasa</h1>
    <div class="gallery">';
	
        
        $images = [
            'gallery/dog-1.jpg',
            'gallery/dog-2.jpg',
            'gallery/dog-3.jpg',
            'gallery/dog-4.jpg',
            'gallery/dog-5.jpg',
            'gallery/dog-6.jpg',
            'gallery/dog-7.jpg',
            'gallery/dog-8.jpg',
            'gallery/dog-9.jpg',
            'gallery/dog-10.jpg',
        ];

       
        $texts = [
            'Ovaj pas voli duge šetnje.',
            'Ovaj pas obožava igru s loptom.',
            'Ovaj pas je veliki ljubitelj maženja.',
            'Ovaj pas je vrlo energičan i zaigran.',
            'Ovaj pas uživa u plivanju.',
            'Ovaj pas je vrlo poslušan i pametan.',
            'Ovaj pas voli društvo drugih pasa.',
            'Ovaj pas je veliki avanturist.',
            'Ovaj pas je vrlo zaštitnički nastrojen.',
            'Ovaj pas je pravi obiteljski ljubimac.',
        ];

        
        foreach ($images as $index => $image) {
            echo '<div class="gallery-item">';
            echo '<img src="' . $image . '" alt="Pas ' . ($index + 1) . '">';
            echo '<p>' . $texts[$index] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
	
	
	
	