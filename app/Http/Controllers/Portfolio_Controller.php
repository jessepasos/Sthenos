<?php

namespace App\Http\Controllers;

class Portfolio_Controller extends Controller
{

    static $objPortfolio;

    public function __construct()
    {

        static::$objPortfolio = Self::portfolioItems();

    }

    public static function index($strType = null)
    {

        if (!$strType) {
            return view('home');
        }

        return view('portfolio/' . $strType . '/index')
            ->with('arrData', Self::portfolio($strType));
    }

    public static function portfolioItems()
    {

        $objItems = (object) array();

        $objItems->sketch = array(
            'label'   => 'Sketch',
            'info'    => 'A sketch-pad built using the HTML canvas element. The user can select brush colour and sizes, and download their finished image.',
            'repo'    => 'https://github.com/jessepasos/Sketch',
            'options' => array(
                'colours' => array(
                    '#ea5151' => 'Light Red',
                    '#E10707' => 'Red',
                    '#9d0404' => 'Dark Red',
                    '#7fff7f' => 'Light Green',
                    '#00FF00' => 'Green',
                    '#009900' => 'Dark Green',
                    '#7f7fff' => 'Light Blue',
                    '#0000FF' => 'Blue',
                    '#000066' => 'Dark Blue',
                    '#f8f5ab' => 'Light Yellow',
                    '#EEE62D' => 'Yellow',
                    '#a6a11f' => 'Dark Yellow',
                    '#FFFFFF' => 'White',
                    '#999999' => 'Grey',
                    '#000000' => 'Black',
                ),
                'sizes'   => array(
                    '1'  => 'XS',
                    '3'  => 'SM',
                    '5'  => 'MD',
                    '7'  => 'LG',
                    '10' => 'XL',
                ),
            ),
        );

        $objItems->show_tell = array(
            'label' => 'Show and Tell',
            'info'  => 'An social image uploader built in Laravel. Show and Tell lets up share your images with other users, and give and receive comments.',
            'repo'  => 'http://www.sthenos.net/show_tell',
        );

        $objItems->stopwatch = array(
            'label' => 'Stopwatch',
            'info'  => 'A stopwatch application built with Java.',
            'repo'  => 'https://github.com/jessepasos/Stopwatch',
        );

        // $objItems->converter = array(
        //     'label' => 'Unit Converter',
        //     'info'  => 'A unit-converter application built with Java.',
        //     'repo'  => 'https://github.com/jessepasos/Converter',
        // );

        // $objItems->sthenos = array(
        //     'label' => 'Sthenos',
        //     'info'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        //     'repo'  => false,
        //     'image' => 'http://placehold.it/500x500',
        //     'tools' => array('a', ' b', 'c', 'd'),
        // );

        return $objItems;
    }

    public static function portfolio($strItemName)
    {

        return static::$objPortfolio->$strItemName;
    }
}
