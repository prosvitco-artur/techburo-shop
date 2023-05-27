<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'product_code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'product_code',
        'position_name',
        'position_name_ukr',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make(__('Product Code'), 'product_code')
                ->sortable()
                ->rules('required', 'max:255'),
            Text::make(__('Position Name'), 'position_name')
                ->sortable()
                ->rules('required', 'max:255')->hideFromIndex(),
            Text::make(__('Position Name'), 'position_name', function ($value) {
                if (mb_strlen($value) > 50) {
                    return mb_substr($value, 0, 50) . '...';
                }
                return $value;
            })
                ->sortable()
                ->onlyOnIndex(),
            Text::make(__('Position Name Ukr'), 'position_name_ukr')
                ->rules('required', 'max:255')
                ->hideFromIndex(),
            Textarea::make(__('Search Queries Ukr'), 'search_queries_ukr'),
            Textarea::make(__('Search Queries'), 'search_queries'),
            Textarea::make(__('Description'), 'description'),
            Textarea::make(__('Description Ukr'), 'description_ukr'),
            Number::make(__('Price'), 'price')
                ->sortable(),
            Boolean::make(__('Availability'), 'availability'),
            Number::make(__('Quantity'), 'quantity')
                ->sortable(),


        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
