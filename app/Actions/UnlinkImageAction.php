<?php

namespace App\Actions;

class UnlinkImageAction
{
    public function handle($model)
    {
        if ($model->image && file_exists(storage_path('app/public/' . $model->image))) {
            unlink(storage_path('app/public/' . $model->image));
        }
    }
}