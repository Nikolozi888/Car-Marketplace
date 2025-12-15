<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('format_price')) {
    function format_price($amount)
    {
        return number_format($amount, 2) . ' $';
    }
}

if (! function_exists('car_image')) {
    function car_image($car)
    {
        if ($car->images->isNotEmpty()) {
            return asset('storage/' . $car->images->first()->path);
        }

        return 'https://via.placeholder.com/1200x600.png?text=No+Image';
    }
}

if (! function_exists('car_title')) {
    function car_title($car)
    {
        return "{$car->make} {$car->model}";
    }
}

if (! function_exists('pagination_links')) {
    function pagination_links($paginator)
    {
        return $paginator->appends(request()->query())->links();
    }
}


if (! function_exists('get_old_selected_center')) {
    function get_old_selected_center($car, $center)
    {
        return $car->center->id == $center->id ? 'selected' : '';
    }
}

if (! function_exists('is_notifications')) {
    function is_notifications()
    {
        return Auth::user()->unreadNotifications->count() > 0;
    }
}

if (! function_exists('count_notifications')) {
    function count_notifications()
    {
        return Auth::user()->unreadNotifications->count();
    }
}

if (! function_exists('current_user')) {
    function current_user()
    {
        return Auth::user();
    }
}



