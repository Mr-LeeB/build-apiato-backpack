<?php

namespace App\Containers\Vessel\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Storage;
use DB;
use Image;


class VesselDDSeeder extends Seeder
{
  protected $users = [
    'ijn' => [
      'name' => 'Imperial Japanese Navy',
      'email' => 'ijn@gmail.com',
      'birth' => '1868-03-04',
    ],
    'usn' => [
      'name' => 'United States Navy',
      'email' => 'usn@gmail.com',
      'birth' => '1798-04-01'
    ]
  ];

  protected $dataSet = [
    'tachibana' => [
      'name' => 'Tachibana',
      'description' => 'Tachibana (橘) was a Sakura-class destroyer of the IJN. Sister ship Sakura at Sasebo, 1918.',
      'brand' => 'Sasebo',
      'quantity' => '2',
      'price' => '90',
      'userId' => '2',
      'image' => ['Ship_PJSD001_Tachibana_1912.png', 'Ship_PJSD014_Tachibana_1912_Asus.png']
    ],
    'umikaze' => [
      'name' => 'Umikaze-class',
      'description' => 'The Umikaze-class destroyers (海風型駆逐艦) were a class of 2 destroyers of the IJN, the first large destroyers designed for open ocean service to be built in Japan.',
      'brand' => 'Maizuru',
      'quantity' => '2',
      'price' => '60',
      'userId' => '2',
      'image' => ['Ship_PJSD002_Umikaze_1925.png']
    ],
    'mutsuki' => [
      'name' => 'Mutsuki-class',
      'description' => 'The Mutsuki-class destroyers (睦月型駆逐艦) were a class of 12 destroyers of the IJN, all were named after Calendar Months. Some consider this was the extension of Minekaze-class.',
      'brand' => 'Sasebo',
      'quantity' => '12',
      'price' => '1380',
      'userId' => '2',
      'image' => ['Ship_PJSD105_Mutsuki.png']
    ],
    'kamikaze' => [
      'name' => 'Kamikaze',
      'description' => 'The Japanese destroyer Kamikaze (神風, "Divine Wind" or "Spirit Wind") was the lead ship of nine Kamikaze-class destroyers built for the IJN during the 1920s.',
      'brand' => 'Mitsubishi',
      'quantity' => '4',
      'price' => '2070',
      'userId' => '2',
      'image' => ['Ship_PJSD017_Kamikaze_1930.png', 'Ship_PJSD025_True_Kamikaze.png', 'Ship_PJSD026_Camo_Kamikaze.png']
    ],
    'fubuki' => [
      'name' => 'Fubuki-class',
      'description' => 'The Fubuki-class destroyers (吹雪型駆逐艦) were a class of 24 destroyers of the IJN. Was considered world first modern destroyers.',
      'brand' => 'Maizuru',
      'quantity' => '24',
      'price' => '2950',
      'userId' => '2',
      'image' => ['Ship_PJSD106_Fubuki.png']
    ],
    'shiratsuyu' => [
      'name' => 'Shiratsuyu-class',
      'description' => 'The Shiratsuyu-class destroyers (白露型駆逐艦) were a class of 10 1st Class destroyers of the IJN in service before and during World War II, during which all were sunk.',
      'brand' => 'Sasebo',
      'quantity' => '10',
      'price' => '5100',
      'userId' => '2',
      'image' => ['Ship_PJSD207_Shiratsuyu.png', 'Ship_PJSD507_Yudachi.png'],
    ],
    'kagero' => [
      'name' => 'Kagero-class',
      'description' => 'The Kagerō-class destroyers were a class of 19 1st Class destroyers built for the IJN during the 1930s, and operated by them during the Pacific War, only 1 survived.',
      'brand' => 'Kure',
      'quantity' => '19',
      'price' => '9100',
      'userId' => '2',
      'image' => ['Ship_PJSD208_Kagero.png', 'Ship_PJSD708_HSF_Harekaze.png', 'Ship_PJSD718_AZUR_Yukikaze.png', 'Ship_PJSD528_Harekaze_2.png'],
    ],
    'yugumo' => [
      'name' => 'Yugumo-class',
      'description' => 'The Yugumo-class destroyers (夕雲型駆逐艦) were a group of 19 destroyers built for the IJN during World War II.',
      'brand' => 'Maizuru',
      'quantity' => '19',
      'price' => '13200',
      'userId' => '2',
      'image' => ['Ship_PJSD209_Yugumo.png'],
    ],
    'shimakaze' => [
      'name' => 'Shimakaze',
      'description' => 'Shimakaze (島風, "Island Wind") was an experimental destroyer of the IJN during World War II, and intended as the lead ship in a projected new "Type C" of destroyers.',
      'brand' => 'Maizuru',
      'quantity' => '1',
      'price' => '19300',
      'userId' => '2',
      'image' => ['Ship_PJSD012_Shimakaze_1943.png'],
    ],
    'smith' => [
      'name' => 'Smith-class',
      'description' => 'The Smith-class destroyers were the first ocean-going torpedo-boat destroyers in the United States Navy, and the first to be driven by steam turbines',
      'brand' => 'WC & Son',
      'quantity' => '5',
      'price' => '90',
      'userId' => '3',
      'image' => ['Ship_PASD502_Smith.png'],
    ],
    'sampson' => [
      'name' => 'Sampson-class',
      'description' => 'The Sampson-class destroyers served in the United States Navy during World War I, commissioned in 1916 and 1917.',
      'brand' => 'Fore River',
      'quantity' => '6',
      'price' => '60',
      'userId' => '3',
      'image' => ['Ship_PASD002_Sampson_1917.png'],
    ],
    'clemson' => [
      'name' => 'Clemson-class',
      'description' => 'The Clemson-class was a series of 156 destroyers which served with the United States Navy from after World War I through World War II.',
      'brand' => 'Newport News',
      'quantity' => '156',
      'price' => '720',
      'userId' => '3',
      'image' => ['Ship_PASD019_Clemson_1920.png'],
    ],
    'farragut' => [
      'name' => 'Farragut-class',
      'description' => 'The Farragut-class destroyers were a class of 8 destroyers in the United States Navy and the first US destroyers of post-World War I design.',
      'brand' => 'Newport News',
      'quantity' => '8',
      'price' => '3120',
      'userId' => '3',
      'image' => ['Ship_PASD005_Farragut_1944.png', 'Ship_PASD506_Monaghan.png'],
    ],
    'mahan' => [
      'name' => 'Mahan-class',
      'description' => 'Mahan-class destroyers of the United States Navy were a series of 18 destroyers of which the first 16 were laid down in 1934.',
      'brand' => 'United',
      'quantity' => '18',
      'price' => '5350',
      'userId' => '3',
      'image' => ['Ship_PASD006_Mahan_1936.png'],
    ],
    'benson' => [
      'name' => 'Benson-class',
      'description' => 'The Benson-class was a class of destroyers of the USN built 1939~1943. The 30 1,620-ton Benson-class destroyers were built in 2 groups. ',
      'brand' => 'Fore River',
      'quantity' => '30',
      'price' => '9040',
      'userId' => '3',
      'image' => ['Ship_PASD008_Benson_1945.png'],
    ],
    'fletcher' => [
      'name' => 'Fletcher-class',
      'description' => 'Fletcher-class was a class of destroyers built by the USN during World War II. Designed in 1939 as a result of dissatisfaction with the earlier destroyer leader types',
      'brand' => 'Bethlehem',
      'quantity' => '175',
      'price' => '12850',
      'userId' => '3',
      'image' => ['Ship_PASD021_Fletcher_1943.png','Ship_PASD508_Kidd.png', 'Ship_PASD709_Black.png']
    ],
  ];

  public function run()
  {
    //Update user 1
    DB::table('users')->where('id', 1)->update([
      'name' => 'Lieutenant Colonel',
      'birth' => '2000-03-28',
      'gender' => 'Male',
    ]);

    //Seed users
    $inputBig = $this->users;
    foreach ($inputBig as $key => $input) {
      //Insert to user table
      DB::table('users')->where('id', $key == 'ijn' ? 2 : 3)->update([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => bcrypt('12345'),
        'birth' => $input['birth'],
        'confirmed' => 1,
      ]);
    }

    for ($i=1; $i <= 3; $i++) {
      $imageOriginal = new UploadedFile(storage_path('app/public/seeder/user-avatar/' . $i . '.png'), $i . '.png');
      $canvas = Image::canvas(245, 245);
      $image = Image::make($imageOriginal)->resize(245, 245, function ($constraint) {
        $constraint->aspectRatio();
      });

      $filename = $i . '-' . time() . '.png';

      $canvas->insert($image, 'center')->encode('png', 100);

      Storage::disk('public')->put('uploads/photos/' . $filename, $canvas);
      DB::table('users')->where('id', $i)->update(['social_avatar' => $filename]);
    }


    //Seed products
    $inputBig = $this->dataSet;

    foreach ($inputBig as $key => $input) {
      $photo = new Collection;

      $location = 'app/public/seeder/ijn-dd/';

      switch (User::find($input['userId'])->name) {
        case 'Imperial Japanese Navy':
          $location = 'app/public/seeder/ijn-dd/';
          break;
        case 'United States Navy':
          $location = 'app/public/seeder/usn-dd/';
          break;
        default:
          $location = 'app/public/seeder/ijn-dd/';
      }

      foreach ($input['image'] as $key => $image) {


        $imageOriginal = new UploadedFile(storage_path($location . $image), $image);
        $canvas = Apiato::call('Vessel@ImageProcessingTask', [$imageOriginal]);

        //Get canvas extension
        $extension = '.' . substr($canvas->mime, strpos($canvas->mime, '/') + 1);
        //Name = time() + extension
        $time = time();
        $name = $input['userId'] . '_' . $time . '_' . $key . '.' . $extension;
        while (Storage::exists('public/uploads/vessel_images/' . $name)) {
          $time = $time - 1;
          $name = $input['userId'] . '_' . $time . '_' . $key . '.' . $extension;
        }


        Storage::disk('public')->put('/uploads/vessel_images/' . $name, $canvas);
        $photo->push($name);
      }

      Apiato::call('Vessel@AddVesselToUserAction', [
        new DataTransporter($input),
        $photo,
      ]);
    }

  }
}
