```bash
php artisan make:model Product -mfcs --resource
```
```bash
php artisan migrate:fresh --seed
```
# Masuk ke dalam vscode
# src->app->http->ProductController.php
```bash
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::connection('mysql')->table('products')->get();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'=> 'required|string'
        ]);

        $product = [
            'name' => $request->input('name'),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ];

        $id = DB::connection('mysql')->table('products')->insertGetid($product);
        $data = DB::connection('mysql')->table('products')->where('id', $id)->first();

        $response = [
            'success' => 'true',
            'message' => 'Product Created',
            'data' => $product
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Product::find($id);
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data Retrieve',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Parameter Not Found',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = Product::find($id);
        if($data) {
            $data->name = $request->input('name');
            $data->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Update',
                        'data' => $data
                    ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Error Updated',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Product::find($id);
        if($data) {
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Di Hapus',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Parameter Not Found',

            ]);
        }
    }
}
```
# src->Models->Product.php
```bash
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'products';
}

```
# src->database->Tahun_Bulan_Tanggal_Id_create_product_table.php
```bash
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
```
# src->database->seeders->DatabaseSeeders.php
```bash
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
```
# src->databash->seeders->ProductSeeders.php
```bash
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $timestamp = \Carbon\Carbon::now()->toDateTimeString();

        DB::table('products')->insert([
            'name' => 'buku',
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);
    }
}
```
# src->routes->web.php
```bash
<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// $router->group(['prefix' => 'api/v1/user'],function () use ($router) {
//     $router->get('/', ['uses' => 'UserController@index']);
// });

$router->group(['prefix' => 'api/v1/user', 'middleware' => 'auth'],function () use ($router) {
    $router->get('/',['uses' => 'UserController@index']);
});

$router->group(['prefix' => 'api/v1/product', 'middleware' => 'auth'],function () use ($router) {
    $router->get('/',['uses' => 'ProductController@index']);
    $router->post('/', ['uses' => 'ProductController@store']);
    $router->delete('/{id}', ['uses' => 'ProductController@destroy']);
    $router->get('/{id}', ['uses' => 'ProductController@show']);
    $router->put('/{id}', ['uses' => 'ProductController@edit']);
});
```