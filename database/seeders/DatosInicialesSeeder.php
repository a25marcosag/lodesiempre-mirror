<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatosInicialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            ['nombre' => 'marcos', 'contrasena' => 'Abc123..', 'tipo' => 'admin', 'email' => null],
            ['nombre' => 'Noa', 'contrasena' => 'Abc123...', 'tipo' => 'admin', 'email' => 'noa@lodesiempre.com'],
            ['nombre' => 'Juan', 'contrasena' => 'Abc123....', 'tipo' => 'admin', 'email' => 'juan@lodesiempre.com'],
            ['nombre' => 'Carmen', 'contrasena' => 'Tenda123.', 'tipo' => 'vendedor', 'email' => 'lola@tendacarmen.com'],
            ['nombre' => 'Manuel', 'contrasena' => 'Forno123.', 'tipo' => 'vendedor', 'email' => 'manuel@ofornovello.com'],
            ['nombre' => 'Rosalía','contrasena' => 'Flor123.', 'tipo' => 'vendedor', 'email' => 'rosalia@floristeriarosalia.com'],
            ['nombre' => 'Xurxo', 'contrasena' => 'Neboa123.', 'tipo' => 'vendedor', 'email' => 'xurxo@librerianeboa.com'],
            ['nombre' => 'Inés', 'contrasena' => 'Castro123.', 'tipo' => 'vendedor', 'email' => 'ines@castroartesania.com'],
            ['nombre' => 'Jorge', 'contrasena' => 'Abc123....', 'tipo' => 'consumidor','email' => 'jorgeds87@gmail.com'],
            ['nombre' => 'Gabriela','contrasena'=> 'Abc123....', 'tipo' => 'consumidor','email' => 'gabrielaa1976@gmail.com'],
        ]);

        DB::table('tiendas')->insert([
            ['nombre' => 'A Tenda de Carmen', 'provincia' => 'A Coruña', 'descripcion' => 'Ultramarinos de barrio con productos frescos y pan del día.', 'icono' => null, 'verif' => true, 'usuario_id' => 4],
            ['nombre' => 'O Forno Vello', 'provincia' => 'Pontevedra', 'descripcion' => 'Panadería artesanal desde 1982.', 'icono' => 'panes.jpg', 'verif' => false, 'usuario_id' => 5],
            ['nombre' => 'Floristería Rosalía', 'provincia' => 'A Coruña', 'descripcion' => 'Flores y plantas de todos los colores y gustos.', 'icono' => 'ramoflores.jpg', 'verif' => false, 'usuario_id' => 6],
            ['nombre' => 'Librería Néboa', 'provincia' => 'Pontevedra', 'descripcion' => 'Librería independiente centrada en literatura gallega.', 'icono' => 'libros.jpg', 'verif' => true, 'usuario_id' => 7],
            ['nombre' => 'Castro Artesanía', 'provincia' => 'A Coruña', 'descripcion' => 'Tienda familiar de artesanía en cerámica y cuero.', 'icono' => null, 'verif' => true, 'usuario_id' => 8],
        ]);

        DB::table('productos')->insert([
            ['nombre' => 'Pan de centeno', 'precio' => 1.20, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 1],
            ['nombre' => 'Leche semidesnatada', 'precio' => 0.95, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 1],
            ['nombre' => 'Queso de cabra', 'precio' => 3.50, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 1],
            ['nombre' => 'Chorizo casero', 'precio' => 4.20, 'descripcion' => 'Elaborado con carne de cerdo gallego y especias tradicionales.', 'imagen' => null, 'tienda_id' => 1],
            ['nombre' => 'Miel artesanal', 'precio' => 6.80, 'descripcion' => 'Producida por apicultores locales en A Coruña.', 'imagen' => null, 'tienda_id' => 1],

            ['nombre' => 'Pan de bola', 'precio' => 1.00, 'descripcion' => null, 'imagen' => 'bola.jpg', 'tienda_id' => 2],
            ['nombre' => 'Empanada de atún', 'precio' => 2.80, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 2],
            ['nombre' => 'Croissant de mantequilla', 'precio' => 1.10, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 2],
            ['nombre' => 'Bica artesana', 'precio' => 5.00, 'descripcion' => 'Bizcocho tradicional gallego hecho en horno de leña.', 'imagen' => null, 'tienda_id' => 2],
            ['nombre' => 'Rosca de Pascua', 'precio' => 4.50, 'descripcion' => 'Postre típico de Semana Santa hecho a mano.', 'imagen' => null, 'tienda_id' => 2],

            ['nombre' => 'Ramo de rosas', 'precio' => 15.00, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 3],
            ['nombre' => 'Maceta de suculentas', 'precio' => 8.50, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 3],
            ['nombre' => 'Claveles variados', 'precio' => 10.00, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 3],
            ['nombre' => 'Centro floral', 'precio' => 25.00, 'descripcion' => 'Decoración floral personalizada para eventos.', 'imagen' => null, 'tienda_id' => 3],
            ['nombre' => 'Orquídea blanca', 'precio' => 18.00, 'descripcion' => 'Planta ornamental tropical en maceta.', 'imagen' => null, 'tienda_id' => 3],

            ['nombre' => 'Cantares Gallegos', 'precio' => 12.00, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 4],
            ['nombre' => 'Memorias dun neno labrego', 'precio' => 10.50, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 4],
            ['nombre' => 'O lapis do carpinteiro', 'precio' => 11.80, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 4],
            ['nombre' => 'Atlas das árbores de Galicia', 'precio' => 22.00, 'descripcion' => 'Edición ilustrada sobre flora autóctona gallega.', 'imagen' => null, 'tienda_id' => 4],
            ['nombre' => 'Contos da néboa', 'precio' => 14.50, 'descripcion' => 'Recopilación de relatos breves contemporáneos.', 'imagen' => null, 'tienda_id' => 4],

            ['nombre' => 'Taza de barro', 'precio' => 6.00, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 5],
            ['nombre' => 'Cesta de mimbre', 'precio' => 12.50, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 5],
            ['nombre' => 'Pulsera de cuero', 'precio' => 8.00, 'descripcion' => null, 'imagen' => null, 'tienda_id' => 5],
            ['nombre' => 'Jarra pintada', 'precio' => 18.00, 'descripcion' => 'Hecha a mano con motivos celtas.', 'imagen' => null, 'tienda_id' => 5],
            ['nombre' => 'Manta artesanal', 'precio' => 28.00, 'descripcion' => 'Confeccionada en telar tradicional.', 'imagen' => null, 'tienda_id' => 5],
        ]);
    }
}

