<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ResetController extends Controller
{
    public function reset()
    {
        Artisan::call('migrate:fresh --seed');

        foreach(['products', 'categories'] as $folder) {

            Storage::deleteDirectory($folder);
            Storage::makeDirectory($folder);

            // Получаем массив с путями файла из папки resources/images вида
            // 0 => "categories/appliance.jpg"
            // 1 => "categories/mobile.jpg"
            // 2 => "categories/portable.jpg
            $files = Storage::disk('reset')->files($folder);

            // Копируем по указаным путям наши файлы в storage
            foreach ($files as $file) {
                Storage::put($file, Storage::disk('reset')->get($file));
            }

        }


        session()->flash('success', 'Проект был сброшен в начальное состояние');
        return redirect()->route('index');
    }
}
