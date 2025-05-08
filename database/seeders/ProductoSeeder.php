<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        Producto::insert([
            [
                'nombre' => 'Zapatillas de Correr',
                'precio' => 50,
                'imagen' => 'https://th.bing.com/th/id/OIP.6K4gg5JrOzH9LlK9xqC1zAHaF-?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Balón de Fútbol',
                'precio' => 30,
                'imagen' => 'https://dojiw2m9tvv09.cloudfront.net/14107/product/balonmundialcmp-63112069.jpg?109',
            ],
            [
                'nombre' => 'Raqueta de Tenis',
                'precio' => 70,
                'imagen' => 'https://th.bing.com/th/id/OIP.stKgQIm5zy6_NCGCYiCcDAHaHa?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Bicicleta de Montaña',
                'precio' => 300,
                'imagen' => 'https://cdn1.coppel.com/images/catalog/mkp/2502/3000/25021400-1.jpg',
            ],
            [
                'nombre' => 'Pelota de Baloncesto',
                'precio' => 25,
                'imagen' => 'https://sialdeporte.com/wp-content/uploads/2018/02/Bal%C3%B3n-de-Basquetbol-6.jpg',
            ],
            [
                'nombre' => 'Equipo de Yoga',
                'precio' => 40,
                'imagen' => 'https://th.bing.com/th/id/OIP.-5YOSV9tXVr9lC_Bk1h8swHaHa?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Ropa de Ciclismo',
                'precio' => 60,
                'imagen' => 'https://th.bing.com/th/id/OIP.xrHRpFdcLFt5XP2SdeGUWgHaHa?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Botella de Agua',
                'precio' => 15,
                'imagen' => 'https://th.bing.com/th/id/OIP.fLKURoXEvbgH8SVNcyu3ngHaHa?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Mancuernas',
                'precio' => 45,
                'imagen' => 'https://th.bing.com/th/id/OIP.vQkd9F4MpNImWGt68JBKtgHaF7?rs=1&pid=ImgDetMain',
            ],
            [
                'nombre' => 'Cinta de Correr',
                'precio' => 500,
                'imagen' => 'https://sgfm.elcorteingles.es/SGFM/dctm/MEDIA03/202006/10/00108446503891____1__1200x1200.jpg',
            ],
        ]);
    }
}
