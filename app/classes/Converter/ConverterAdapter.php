<?php
namespace KCMS\Converter;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConverterAdapter
 * @package KCMS\Converter
 */
class ConverterAdapter extends AbstractConverter
{
    /**
     * @param $id
     * @return object
     */
    public function convertFromId($id)
    {
        return null;
    }

    /**
     * @param         $null
     * @param Request $request
     * @return object
     */
    public function convertFromRequestBody($null, Request $request)
    {
        return null;
    }
}
